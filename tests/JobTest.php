<?php

/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 15/03/2017 17:21
 */
namespace Anchcloud\Tests;

final class JobTest extends BaseTestCase
{

    public function testGetJob()
    {
        $jobClient = new \Anchcloud\Iaas\Job\JobClient(
            $this->getClientId(),
            $this->getClientSecret(),
            [
                'timeout' => 3,
                'proxy'   => 'socks5://127.0.0.1:1080',
            ]
        );

        $jobId = 'd396b46a-0579-474a-99fa-e282b40def75';
        $job = $jobClient->describeJob($jobId);

        $this->assertArrayHasKey('job_id', $job);
        $this->assertEquals($jobId, $job['job_id']);
    }

}