<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/30
 * Time: 16:53
 */
namespace app\lib\exception;
use think\Exception;
class BaseException extends Exception
{
    // Http状态码:200 400 404
    public $code = 400;

    //错误信息
    public $msg = '参数错误';

    //自定义的错误码
    public $errorCode = 10000;

    public function __construct($params = [])
    {
        if(!is_array($params))
        {
            return ; //使用return是因为我认为这不是一个错误
            //throw new Exception('参数必须是数组');
        }
        if(array_key_exists('code',$params))
        {
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params))
        {
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params))
        {
            $this->code = $params['errorCode'];
        }
    }
}