<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 17:35
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}