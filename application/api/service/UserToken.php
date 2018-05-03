<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 11:00
 */
namespace app\api\service;
use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
class UserToken extends Token
{
    protected $code;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    public function __construct($code)
    {
        //拼写完整的wxLoginUrl
        $this->code = $code;
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),
            $this->wxAppId,$this->wxAppSecret,$this->code);
    }

    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult))
        {
            throw new Exception('获取session_key或者openid时异常,微信内部错误');
        }else{
            $loginFail = array_key_exists('errcode',$wxResult);
            if($loginFail)
            {
                $this->processLoginError($wxResult);
            }else{
                return $this->grantToken($wxResult);
            }
        }
    }
    private function grantToken($wxResult)
    {
        //1.拿到openid 2.去数据库看一下这个openid是否存在;如果存在就不做处理,不存在就插入
        //3.生成令牌,准备缓存数据,写入缓存,4.把令牌返回到客户端去
        //key:令牌
        //value: wxResult ,uid ,scope
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if($user)
        {
            $uid = $user->id;
        }else{
            $uid = $this->newUser($openid);
        }
        $cacheValue = $this->prepareCacheValue($wxResult,$uid);
        $token = $this->saveToCache($cacheValue);
        return $token;
    }

    private function saveToCache($cacheValue)
    {
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        $expire_in = config('setting.token_expire_in');
        $request = cache($key,$value,$expire_in);
        if(!$request)
        {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode'=> 10005
            ]);
        }
        //key就是令牌
        return $key;
    }

    /**
     * 准备缓存数据
     * @param $wxResult
     * @param $uid
     * @return mixed
     */
    private function  prepareCacheValue($wxResult,$uid)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        //代表app用户的权限数值
        //$cacheValue['scope'] = ScopeEnum::User;
        $cacheValue['scope'] = 15;
        //代表cms用户的权限数值
        //$scopeValue['scope'] = 32;
        return $cacheValue;
    }

    /**
     * 生成新的用户
     * @param $openid
     * @return mixed
     */
    private function newUser($openid)
    {
        $user = UserModel::create(['openid'=>$openid]);
        return $user->id;
    }
    private function processLoginError($wxResult)
    {
        throw new WeChatException([
            'msg'=>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode']
        ]);
    }
}