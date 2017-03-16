Anchcloud SDK for PHP
=====================

**SDK 处于开发阶段，请勿用于生产环境！！**

首先在云平台获取 Client Key 和秘钥 [https://console.51idc.com/user/apikeypair/](https://console.51idc.com/user/apikeypair/)

## Use Composer

```
composer require 51idc/anchcloud-sdk-php
```

## Single File

```
# Clone source code
git clone https://github.com/51idc/anchcloud-sdk-php.git
```

```php
require __SDK_DIR__ . '/vendor/autoload.php';
```

## Usage

```php
// require __DIR__ . '/vendor/autoload.php';

$instanceClient = new InstancesClient($clientId, $secretKey, [
    'timeout' => 3,
    //'proxy'   => 'socks5://127.0.0.1:1080',
]);


// 查询主机列表
$data = $instanceClient->describeInstances(\Anchcloud\Iaas\Constants::ZONE_AC1);
var_dump($data);


// 开通主机
$job = $instanceClient->runInstances(\Anchcloud\Iaas\Constants::ZONE_AC1, [
    'instance' => [
        "image_id"       => "centos65x64e",
        "instance_type"  => \Anchcloud\Iaas\Instances\Constants::PERFORMANCE_INSTANCE,
        "cpu"            => 1,
        "memory"         => 1024,
        "count"          => 1,
        "instance_name"  => "Test-INSTANCE",
        "login_mode"     => \Anchcloud\Iaas\Instances\Constants::LOGIN_MODE_KEYPAIR,
        "login_keypair"  => "kp-E850VXZN",
        "security_group" => "sg-TS5D1JXN",
    ],
    "order"    => [
        "payment_type" => "POSTPAY"
    ],
]);

var_dump($job);
```



## Run test case

```shell
clientId=your_client_id \
clientSecret=your_client_secret \
phpunit --bootstrap vendor/autoload.php tests/
```

## License

This project is licensed under the Apache License, Version 2.0.