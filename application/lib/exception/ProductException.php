<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 19:52
 */

namespace app\lib\exception;
class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '指定的商品不存在,请检查参数';
    public $errorCode = 20000;
}