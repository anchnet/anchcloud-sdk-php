<?php
/**
 * anchcloud-sdk-php
 * User: eagle
 * Datetime: 09/03/2017 15:06
 */

require __DIR__ . '/vendor/autoload.php';

//// BasicProvider Test case
//$provider = new \Anchcloud\OAuth2\BasicProvider([
//    'clientId'       => '7713875389855318',
//    'clientSecret'   => 'TYG6hdKByYRTzK3GZHrzsb0YZswIAQGz',
//    'urlAccessToken' => 'https://openapi.51idc.com/v2/oauth2/token',
//]);
//
//try {
//
//    $accessToken = $provider->getAccessToken('client_credentials');
//    var_dump($accessToken);
//
//} catch (\Exception $e) {
//    echo $e->getMessage() . PHP_EOL;
//}

use \Anchcloud\Iaas\Instances\InstancesClient;

$clientId = "7713875389855318";
$secretKey = "TYG6hdKByYRTzK3GZHrzsb0YZswIAQGz";

$instanceClient = new InstancesClient($clientId, $secretKey, [
    'timeout' => 3,
    //'proxy'   => 'socks5://127.0.0.1:1080',
]);
//
// 开通主机
//$job = $instanceClient->runInstances(\Anchcloud\Iaas\Constants::ZONE_AC1, [
//    'instance' => [
//        "image_id"       => "centos65x64e",
//        "instance_type"  => \Anchcloud\Iaas\Instances\Constants::PERFORMANCE_INSTANCE,
//        "cpu"            => 1,
//        "memory"         => 1024,
//        "count"          => 1,
//        "instance_name"  => "Test-INSTANCE",
//        "login_mode"     => \Anchcloud\Iaas\Instances\Constants::LOGIN_MODE_KEYPAIR,
//        "login_keypair"  => "kp-E850VXZN",
//        "security_group" => "sg-TS5D1JXN",
//    ],
//    "order"    => [
//        "payment_type" => "POSTPAY"
//    ],
//]);
//
//var_dump($job);

$jobClient = new \Anchcloud\Iaas\Job\JobClient($clientId, $secretKey, [
    'timeout' => 3,
    'proxy'   => 'socks5://127.0.0.1:1080',
]);

$job = $jobClient->describeJob('d396b46a-0579-474a-99fa-e282b40def75');
var_dump($job);

// 查询主机列表
$data = $instanceClient->describeInstances(\Anchcloud\Iaas\Constants::ZONE_AC1);
var_dump($data);

