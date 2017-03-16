Anchcloud SDK for PHP
=====================

**SDK 处于开发阶段，请勿用于生产环境！！**

首先在云平台获取 Client Key 和秘钥 [https://console.51idc.com/user/apikeypair/](https://console.51idc.com/user/apikeypair/)

- [x] 基础认证
- [ ] 主机实例
- [ ] 磁盘
- [ ] 快照备份
- [ ] 公网 IP
- [ ] 私有网络
- [ ] 云路由器
- [ ] 云负载均衡器
- [ ] 云数据库
- [ ] 云防火墙
- [ ] SSH 秘钥
- [ ] 系统镜像
- [ ] 回收站
- [ ] 用户信息管理

## Use Composer
[Packagist](https://packagist.org/packages/51idc/anchcloud-sdk-php)
```
composer require 51idc/anchcloud-sdk-php:dev-master
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
