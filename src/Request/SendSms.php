<?php
namespace Flc\Dysms\Request;

/**
 * 短信发送API
 *
 * @author Flc <2017-07-18 23:42:12>
 * @link   https://help.aliyun.com/document_detail/55451.html?spm=5176.doc55359.6.555.9caHua
 */
class SendSms extends ARequest implements IRequest
{
    /**
     * API名称
     * @var string
     */
    protected $action = 'SendSms';

    /**
     * 设置短信接收号码
     * @param string|array $value 短信接收号码。支持以逗号分隔的形式进行批量调用，批量上限为20个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
     */
    public function setPhoneNumbers($value = '')
    {
        $this->params['PhoneNumbers'] = is_array($value) ? implode(',', $value) : $value;

        return $this;
    }

    /**
     * 设置短信签名
     * @param string $value 短信签名
     */
    public function setSignName($value)
    {
        $this->params['SignName'] = $value;

        return $this;
    }

    /**
     * 设置短信模板ID
     * @param string $value 短信模板ID
     */
    public function setTemplateCode($value)
    {
        $this->params['TemplateCode'] = $value;

        return $this;
    }

    /**
     * 设置短信模板变量
     * @param array $value 短信模板变量
     */
    public function setTemplateParam($value = [])
    {
        $this->params['TemplateParam'] = json_encode($value, JSON_FORCE_OBJECT);

        return $this;
    }

    /**
     * 设置外部流水扩展字段
     * @param string $value 外部流水扩展字段
     */
    public function setOutId($value)
    {
        $this->params['OutId'] = $value;

        return $this;
    }
}