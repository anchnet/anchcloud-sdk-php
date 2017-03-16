<?php

/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 16/03/2017 11:28
 */
namespace Anchcloud\Tests;

use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{

    /** @var  String */
    protected $clientClass;

    /** @var  Object */
    protected $client;

    protected $options = [
        'timeout' => 5,
        //'proxy'   => 'socks5://127.0.0.1:1080',
    ];

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        if (class_exists($this->clientClass)) {
            $this->client = new $this->clientClass($this->getClientId(), $this->getClientSecret(), $this->options);
        }
    }


    /**
     * @return string
     */
    protected function getClientId()
    {
        return (string)getenv('clientId');
    }

    /**
     * @return string
     */
    protected function getClientSecret()
    {
        return (string)getenv('clientSecret');
    }

}