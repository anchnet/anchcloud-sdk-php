<?php
/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 03/03/2017 14:36
 */

namespace Anchcloud\Iaas\Instances;

use Anchcloud\Iaas\IaasClient;

/**
 * Class InstancesClient
 *
 * @
 * @package Anchcloud\Iaas\Instances
 */
class InstancesClient extends IaasClient
{

    public function runInstances($zone, array $params = [])
    {
        return $this->send('POST', "/v2/zone/{$zone}/instances", ['json' => $params]);
    }

    public function describeInstances($zone, array $params = [])
    {
        return $this->send('GET', "/v2/zone/{$zone}/instances", ['query' => $params]);
    }

}