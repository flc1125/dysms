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
$sendSms->setPhoneNumbers('15000000000');
$sendSms->setSignName('叶子坑');
// $sendSms->setTemplateCode('SMS_77665019');
// $sendSms->setTemplateParam(['username' => 'demo', 'time' => date('Y-m-d')]);
$sendSms->setTemplateCode('SMS_85540016');
// $sendSms->setTemplateParam(['username' => 'demo', 'time' => date('Y-m-d')]);
$sendSms->setOutId('demo');

print_r($client->execute($sendSms));