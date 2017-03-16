<?php
/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 16/03/2017 14:02
 */

namespace Anchcloud\Tests;


class AuthTest extends BaseTestCase
{

    public function testAuthWithClientCredentials()
    {
        // BasicProvider Test case
        $provider = new \Anchcloud\OAuth2\BasicProvider([
            'clientId'       => $this->getClientId(),
            'clientSecret'   => $this->getClientSecret(),
            'urlAccessToken' => 'https://openapi.51idc.com/v2/oauth2/token',
        ]);

        $accessToken = $provider->getAccessToken('client_credentials');
        $this->assertArrayHasKey('token_type', $accessToken->getValues());
        $this->assertEquals('Bearer', $accessToken->getValues()['token_type']);
    }

}