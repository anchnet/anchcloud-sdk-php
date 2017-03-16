<?php

/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 15/03/2017 17:21
 */
namespace Anchcloud\Tests;

use Anchcloud\Iaas\Job\JobClient;

final class JobTest extends BaseTestCase
{

    protected $clientClass = JobClient::class;

    /** @var  JobClient */
    protected $client;

    public function testGetJob()
    {
        $jobId = 'd396b46a-0579-474a-99fa-e282b40def75';
        $job = $this->client->describeJob($jobId);

        $this->assertArrayHasKey('job_id', $job);
        $this->assertEquals($jobId, $job['job_id']);
    }

}