<?php
namespace Flc\Dysms;

use Flc\Dysms\Request\IRequest;

/**
 * dysms客户端类
 *
 * @author Flc <2017-07-18 23:16:32>
 */
class Client
{
    /**
     * 接口地址
     * @var string
     */
    protected $api_uri = 'http://dysmsapi.aliyuncs.com/';

    /**
     * 配置项
     * @var array
     */
    protected $config = [];

    /**
     * 初始化
     * @param array $config [description]
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * 请求
     * @param  IRequest $request [description]
     * @return [type]            [description]
     */
    public function execute(IRequest $request)
    {
        return $request;
    }
}