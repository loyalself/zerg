<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 10:49
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        //require并不能检测是否为空
        'code' => 'require|isNotEmpty'
    ];

    protected $message = [
        'code' => '没有code还想获取Token,做梦哦'
    ];
}