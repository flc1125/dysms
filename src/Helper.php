<?php
namespace Flc\Dysms;

/**
 * 辅助类
 *
 * @author Flc <2017-07-19 00:26:44>
 */
class Helper
{
    /**
     * 返回唯一标识
     * @return string 
     */
    public static function uuid()
    {
        if (function_exists('com_create_guid')) {
            $uuid = com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000);
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);
            $uuid   = chr(123).
                    substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12)
                    .chr(125);// "}"
        }

        return trim(strtoupper($uuid), '{}');
    }
}