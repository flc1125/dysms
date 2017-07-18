<?php
namespace Flc\Dysms\Request;

/**
 * 抽象类
 *
 * @author Flc <2017-07-18 23:44:17>
 */
abstract class ARequest implements IRequest
{   
    /**
     * API接口名称
     * @var string
     */
    protected $action;

    /**
     * 接口请求参数
     * @var array
     */
    protected $params = [];

    /**
     * 返回API名称
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * 接口请求参数
     * @return array 
     */
    public function getParams()
    {
        return $this->params;
    }
}