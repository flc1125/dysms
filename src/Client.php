<?php
namespace Flc\Dysms;

use Flc\Dysms\Request\IRequest;

use Flc\Dysms\Helper;

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
     * 回传格式
     * @var string
     */
    protected $format = 'json';

    /**
     * 签名方式
     * @var string
     */
    protected $signatureMethod = 'HMAC-SHA1';

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
        $action    = $request->getAction();
        $reqParams = $request->getParams();
        return $request;
    }

    /**
     * 公共返回参数
     * @return array 
     */
    public function getPublicParams()
    {
        return [
            'AccessKeyId'      => $this->config['accessKeyId'],
            'Timestamp'        => date('Y-m-d\TH:i:s\Z'),
            'Format'           => $this->format,
            'SignatureMethod'  => $this->signatureMethod,
            'SignatureVersion' => '1.0',
            'SignatureNonce'   => Helper::uuid(),
            'Version'          => '2017-05-25',
            'RegionId'         => 'cn-hangzhou',
        ];
    }
}