<?php

/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 15/03/2017 17:12
 */
namespace Anchcloud\Iaas\Job;

use Anchcloud\Iaas\IaasClient;

class JobClient extends IaasClient
{

    /**
     * @param $jobId
     * @return bool|mixed|string
     */
    public function describeJob($jobId)
    {
        // Hask! zone 参数无用
        return $this->send('GET', "/v2/zone/ac1/job/{$jobId}");
    }

}