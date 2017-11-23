<?php
/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 03/03/2017 14:34
 */

namespace Anchcloud\Iaas;


use Anchcloud\Exception\ServerErrorException;
use Anchcloud\Exception\UnauthorizedException;
use Anchcloud\Exception\InvalidRequestException;
use Anchcloud\OAuth2\BasicProvider;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;
use UnexpectedValueException;

class IaasClient
{

    /**
     * Your OAuth 2 client id
     *
     * @var string
     */
    protected static $clientId = "your_client_id";

    /**
     * Your OAuth 2 secret key
     *
     * @var string
     */
    protected static $clientSecret = "your_client_secret";


    /**
     * @var array
     */
    protected static $options = [];

    /** @var  BasicProvider */
    protected $basicProvider;

    public static $endpoint = 'https://openapi.anchnet.com';

    /** @var  AccessToken */
    protected $accessToken;

    /** @var int */
    protected $regenrateAccessTokenInterval = 600;

    protected $retryTimes = 3;

    public function __construct($clientId = null, $clientSecret = null, array $options = null)
    {
        if (!empty($clientId)) {
            self::$clientId = $clientId;
        }
        if (!empty($clientSecret)) {
            self::$clientSecret = $clientSecret;
        }
        if (!empty($options)) {
            self::$options = array_merge(self::$options, $options);
        }
        if (isset($options['endpoint'])) {
            self::$endpoint = $options['endpoint'];
        }

        $this->basicProvider = new BasicProvider([
                'clientId'       => $clientId,
                'clientSecret'   => $clientSecret,
                'urlAccessToken' => sprintf("%s/v2/oauth2/token", self::$endpoint),
            ] + self::$options, self::$options);
    }

    public static function setClientId($clientId)
    {
        self::$clientId = $clientId;
    }

    public static function setClientSecret($clientSecret)
    {
        self::$clientSecret = $clientSecret;
    }

    public static function setOptions(array $options)
    {
        self::$options = array_merge(self::$options, $options);
    }


    /**
     * @return AccessToken
     */
    public function getAccessToken()
    {
        if ($this->isValidAccessToken()) {
            return $this->accessToken;
        }

        $this->initAccessToken();

        return $this->accessToken;
    }

    public function initAccessToken()
    {
        $this->accessToken = $this->basicProvider->getAccessToken('client_credentials');
    }

    /**
     * @return bool
     */
    protected function isValidAccessToken()
    {
        if ($this->accessToken == null) {
            return false;
        }

        if ((time() - $this->regenrateAccessTokenInterval) > $this->accessToken->getExpires()) {
            return false;
        }

        return true;
    }


    /**
     * @param $method
     * @param $url
     * @param array $options
     * @return bool|mixed|string
     * @throws InvalidRequestException
     * @throws ServerErrorException
     * @throws UnauthorizedException
     */
    public function doHttpRequest($method, $url, array $options = [])
    {
        $provider = $this->basicProvider;

        $accessToken = $this->getAccessToken()->getToken();
        $request = $provider->getAuthenticatedRequest($method, self::$endpoint . $url, $accessToken, $options);

        $response = $provider->getHttpClient()->send($request, $options);

        $statusCode = $response->getStatusCode();

        // No Content
        if ($statusCode == 204) {
            return true;
        } else if ($statusCode == 401) {
            throw new UnauthorizedException("Unauthorized");
        }

        $data = $this->parseResponse($response);

        // 4xx Invalid Request
        if ($statusCode >= 400 && $statusCode < 500) {
            if (isset($data['code']) && isset($data['message'])) {
                throw new InvalidRequestException($data['message'], $data['code'], $request);
            } else {
                throw new InvalidRequestException("Unknown request error", 'unknown_request_error', $request);
            }
        }

        // 5xx Server Error
        if ($statusCode >= 500 && $statusCode < 505) {
            if (isset($data['code']) && isset($data['message'])) {
                throw new ServerErrorException($data['message'], $data['code'], $response);
            } else {
                throw new ServerErrorException("Unknown response error", 'unknown_response_error', $response);
            }
        }

        return $data;
    }


    public function send($method, $url, array $options = [])
    {
        for ($i = 1; $i <= $this->retryTimes; $i++) {
            try {

                return $this->doHttpRequest($method, $url, $options);

            } catch (UnauthorizedException $e) {    // 未授权  重试
                $this->initAccessToken();
            } catch (ServerErrorException $e) {     // 服务器异常 重试
                // Do nothing
            } catch (\Exception $e) {               // 其他异常 直接抛出
                throw $e;
            }
        }
    }


    /**
     * Parses the response according to its content-type header.
     *
     * @param ResponseInterface $response
     * @return mixed|string
     * @throws InvalidRequestException
     */

    function parseResponse(ResponseInterface $response)
    {
        $content = (string)$response->getBody();
        $type = $response->getHeaderLine('Content-Type');

        if (strpos($type, 'urlencoded') !== false) {
            parse_str($content, $parsed);
            return $parsed;
        }

        try {

            $content = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new UnexpectedValueException(sprintf(
                    "Failed to parse JSON response: %s",
                    json_last_error_msg()
                ));
            }

            if (isset($content['code']) && isset($content['message'])) {
                throw new InvalidRequestException($content['message'], $content['code']);
            }

            return $content;
        } catch (UnexpectedValueException $e) {
            if (strpos($type, 'json') !== false) {
                throw $e;
            }

            return $content;
        }
    }

    public static function __callStatic($method, $arguments)
    {

    }

}
