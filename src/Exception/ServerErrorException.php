<?php
/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 09/03/2017 17:20
 */

namespace Anchcloud\Exception;


use Psr\Http\Message\ResponseInterface;

class ServerErrorException extends \Exception
{

    /** @var ResponseInterface */
    protected $response;


    public function __construct($message, $code, ResponseInterface $response)
    {
        $this->message = $message;
        $this->code = $code;
        $this->response = $response;
    }


    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }


    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getBody()
    {
        return $this->response->getBody();
    }

}