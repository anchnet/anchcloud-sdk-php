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