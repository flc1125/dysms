<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

$config = [
    'accessKeyId'    => 'LTAIbVA2LRQ1tULr',
    'accessKeySecret' => 'ocS48RUuyBPpQHsfoWokCuz8ZQbGxl',
];

$client  = new Client($config);
$sendSms = new SendSms;
$sendSms->setPhoneNumbers('18825277676');
$sendSms->setSignName('叶子坑');
$sendSms->setTemplateCode('SMS_77670013');
$sendSms->setTemplateParam(['code' => rand(100000, 999999)]);
$sendSms->setOutId('demo');

print_r($client->execute($sendSms));