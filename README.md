# 阿里短信接口

[![Latest Stable Version](https://poser.pugx.org/flc/dysms/v/stable)](https://packagist.org/packages/flc/dysms)
[![Total Downloads](https://poser.pugx.org/flc/dysms/downloads)](https://packagist.org/packages/flc/dysms)
![php>=5.4](https://img.shields.io/badge/php->%3D5.4-orange.svg?maxAge=2592000)
[![License](https://poser.pugx.org/flc/dysms/license)](https://packagist.org/packages/flc/dysms)

> PS：**阿里大于** [https://github.com/flc1125/alidayu](https://github.com/flc1125/alidayu)

## 安装

```shell
composer require flc/dysms
```

## 使用

```php
<?php
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

$config = [
    'accessKeyId'    => 'LTAIbVA2LRQ1tULr',
    'accessKeySecret' => 'ocS48RUuyBPpQHsfoWokCuz8ZQbGxl',
];

$client  = new Client($config);
$sendSms = new SendSms;
$sendSms->setPhoneNumbers('1500000000');
$sendSms->setSignName('叶子坑');
$sendSms->setTemplateCode('SMS_77670013');
$sendSms->setTemplateParam(['code' => rand(100000, 999999)]);
$sendSms->setOutId('demo');

print_r($client->execute($sendSms));
```

## 支持

- 官方网址： https://www.aliyun.com/product/sms?spm=5176.8142029.388261.339.WL7atM
- 官方API文档： https://help.aliyun.com/document_detail/55451.html?spm=5176.doc55289.6.556.pMlBIe
- composer： https://getcomposer.org/

## License

MIT
