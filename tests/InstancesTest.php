<?php
/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 16/03/2017 13:52
 */

namespace Anchcloud\Tests;


use Anchcloud\Iaas\Constants;
use Anchcloud\Iaas\Instances\InstancesClient;

class InstancesTest extends BaseTestCase
{
    protected $clientClass = InstancesClient::class;

    /** @var  InstancesClient */
    protected $client;

    public function testRunInstances()
    {
        $job = $this->client->runInstances(Constants::ZONE_AC2, [
            'instance' => [
                "image_id"       => "centos65x64e",
                "instance_type"  => \Anchcloud\Iaas\Instances\Constants::PERFORMANCE_INSTANCE,
                "cpu"            => 1,
                "memory"         => 1024,
                "count"          => 1,
                "instance_name"  => "Test-INSTANCE",
                "login_mode"     => \Anchcloud\Iaas\Instances\Constants::LOGIN_MODE_PASSWORD,
                "login_passwd"  => "Test#12345!",
                //"security_group" => "sg-TS5D1JXN",
            ],
            "order"    => [
                "payment_type" => "POSTPAY"
            ],
        ]);

        $this->assertArrayHasKey('job_id', $job);
    }

    public function testDescribeInstances()
    {
        $data = $this->client->describeInstances(\Anchcloud\Iaas\Constants::ZONE_AC1);
        $this->assertArrayHasKey('total_count', $data);
    }

}