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
     * 开通主机实例
     *
     * @param $zone
     * @param array $params
     * @return bool|mixed|string
     */
    public function modifyInstances($zone, array $params = [])
    {
        return $this->send('PUT', "/v2/zone/{$zone}/instances", ['json' => $params]);
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


    /**
     * 启动主机
     *
     * @param $zone
     * @param array $instances
     * @return bool|mixed|string
     */
    public function startInstances($zone, array $instances)
    {
        return $this->send('POST', "/v2/zone/{$zone}/instances/start", ['json' => [
            'instances' => $instances,
        ]]);
    }

    /**
     * 关闭主机
     *
     * @param $zone
     * @param array $instances
     * @return bool|mixed|string
     */
    public function stopInstances($zone, array $instances)
    {
        return $this->send('POST', "/v2/zone/{$zone}/instances/stop", ['json' => [
            'instances' => $instances,
        ]]);
    }

    /**
     * 重启主机
     *
     * @param $zone
     * @param array $instances
     * @return bool|mixed|string
     */
    public function restartInstances($zone, array $instances)
    {
        return $this->send('POST', "/v2/zone/{$zone}/instances/restart", ['json' => [
            'instances' => $instances,
        ]]);
    }

    /**
     * 主机重置初始状态
     *
     * @param $zone
     * @param array $params
     * @return bool|mixed|string
     */
    public function resetInstances($zone, array $params)
    {
        return $this->send('POST', "/v2/zone/{$zone}/instances/reset", ['json' => $params]);
    }

    /**
     * 调整主机配置
     *
     * @param $zone
     * @param array $params
     * @return bool|mixed|string
     */
    public function resizeInstances($zone, array $params)
    {
        return $this->send('POST', "/v2/zone/{$zone}/instances/resize", ['json' => $params]);
    }

    /**
     * 重置登录密码
     *
     * @param $zone
     * @param array $instances
     * @param $password
     * @return bool|mixed|string
     */
    public function resetPassword($zone, array $instances, $password)
    {
        return $this->send('POST', "/v2/zone/{$zone}/instances/reset_password", ['json' => [
            'instances'    => $instances,
            'login_passwd' => $password,
        ]]);
    }

    /**
     * 销毁主机
     *
     * @param $zone
     * @param $insId
     * @return bool|mixed|string
     */
    public function terminateInstances($zone, $insId)
    {
        $insId = strval($insId);
        return $this->send('DELETE', "/v2/zone/{$zone}/instances/{$insId}");
    }

    /**
     *  获取 Brokers 信息
     *  用于 Websocket 远程连接
     *
     * @param $zone
     * @param $insId
     * @return bool|mixed|string
     */
    public function getBrokers($zone, $insId)
    {
        $insId = strval($insId);
        return $this->send('GET', "/v2/zone/{$zone}/instances/{$insId}/brokers");
    }

}