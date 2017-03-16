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

    /**
     * 开通主机实例
     *
     * @param $zone
     * @param array $params
     * @return bool|mixed|string
     */
    public function runInstances($zone, array $params = [])
    {
        return $this->send('POST', "/v2/zone/{$zone}/instances", ['json' => $params]);
    }

    /**
     * 查询主机实例列表
     *
     * @param $zone
     * @param array $params
     * @return bool|mixed|string
     */
    public function describeInstances($zone, array $params = [])
    {
        return $this->send('GET', "/v2/zone/{$zone}/instances", ['query' => $params]);
    }

}