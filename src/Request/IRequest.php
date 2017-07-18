<?php
namespace Flc\Dysms\Request;

/**
 * 请求接口类
 *
 * @author Flc <2017-07-18 23:39:50>
 */
interface IRequest
{
    /**
     * 返回API接口名称
     * @return string 
     */
    public function getAction();

    /**
     * 返回接口请求参数
     * @return array 
     */
    public function getParams();
}