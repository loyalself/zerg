<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 14:11
 */
namespace app\api\service;
use app\lib\exception\TokenException;
use think\facade\Cache;
use think\Exception;
use think\facade\Request;
class Token
{
    /**
     * 生成Token
     * 令牌就是一组毫无意义的32个字符组成的字符串
     */
    public static function generateToken()
    {
        $randChars = getRandChar(32);
        //用三组字符串,进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //salt 盐
        $salt = config('secrue.token_salt');
        return md5($randChars.$timestamp.$salt);
    }
    public static function getCurrentTokenVar($key)
    {   //如何获取用户的token
        $token = Request::header('token');
        $vars = Cache::get($token);
        if(!$vars)
        {
            throw new TokenException();
        }else{
            if(!is_array($vars))
            {
                $vars = json_decode($vars,true);
            }
            if(array_key_exists($key,$vars))
            {
                return $vars[$key];
            }else{
                throw new Exception('尝试获取的Token变量并不存在');
            }
        }
    }
    public static function getCurrentUid()
    {
        // token
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
}