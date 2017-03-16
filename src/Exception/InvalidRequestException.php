<?php
/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 09/03/2017 17:20
 */

namespace Anchcloud\Exception;


use Psr\Http\Message\RequestInterface;

class InvalidRequestException extends \Exception
{
    /** @var RequestInterface  */
    protected $request;

    public function __construct($message = "", $code = "", RequestInterface $request)
    {
        $this->message = $message;
        $this->code = $code;
        $this->request = $request;
    }

}