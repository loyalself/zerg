<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 11:09
 */
return [
    'app_id' => 'wxb4458adbae51a1da',
    'app_secret' => '59583ea9ae87ecdd55b86c76da381654',
    // 微信使用code换取用户openid及session_key的url地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?".
    "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
];