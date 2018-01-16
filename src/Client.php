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
     * 接口请求方式[GET/POST]
     * @var string
     */
    protected $httpMethod = 'POST';

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
        $pubParams = $this->getPublicParams();

        $params = array_merge(
            $pubParams,
            ['Action' => $action],
            $reqParams
        );


        // 签名
        $params['Signature'] = $this->generateSign($params);

        // 请求数据
        $resp = $this->curl(
            $this->api_uri,
            $params
        );

        return json_decode($resp);
    }

    /**
     * 生成签名
     * @param  array  $params 待签参数
     * @return string         
     */
    protected function generateSign($params = [])
    {
        ksort($params);  // 排序

        $arr = [];
        foreach ($params as $k => $v) {
            $arr[] = $this->percentEncode($k) . '=' . $this->percentEncode($v);
        }
        
        $queryStr = implode('&', $arr);
        $strToSign = $this->httpMethod . '&%2F&' . $this->percentEncode($queryStr);

        return base64_encode(hash_hmac('sha1', $strToSign, $this->config['accessKeySecret'] . '&', true));
    }

    /**
     * 签名拼接转码
     * @param  string $str 转码前字符串
     * @return string      
     */
    protected function percentEncode($str)
    {
        $res = urlencode($str);
        $res = preg_replace('/\+/', '%20', $res);
        $res = preg_replace('/\*/', '%2A', $res);
        $res = preg_replace('/%7E/', '~', $res);

        return $res;
    }

    /**
     * 公共返回参数
     * @return array 
     */
    protected function getPublicParams()
    {
        return [
            'AccessKeyId'      => $this->config['accessKeyId'],
            'Timestamp'        => $this->getTimestamp(),
            'Format'           => $this->format,
            'SignatureMethod'  => $this->signatureMethod,
            'SignatureVersion' => '1.0',
            'SignatureNonce'   => uniqid(),
            'Version'          => '2017-05-25',
            'RegionId'         => 'cn-hangzhou',
        ];
    }

    /**
     * 返回时间格式
     * @return string 
     */
    protected function getTimestamp()
    {
        $timezone = date_default_timezone_get();
        date_default_timezone_set('GMT');
        $timestamp = date('Y-m-d\TH:i:s\Z');
        date_default_timezone_set($timezone);

        return $timestamp;
    }

    /**
     * curl请求
     * @param  string $url        string
     * @param  array|null $postFields 请求参数
     * @return [type]             [description]
     */
    protected function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_array($postFields) && 0 < count($postFields)) {
            $postBodyString = "";
            foreach ($postFields as $k => $v) {
                $postBodyString .= "$k=" . urlencode($v) . "&"; 
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            $header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
        }
        $reponse = curl_exec($ch);
        return $reponse;
    }
}