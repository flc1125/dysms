# 阿里短信接口

> 目前仅支持短信发送；文档待整理

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