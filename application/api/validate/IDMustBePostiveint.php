<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/30
 * Time: 14:07
 */
namespace app\api\validate;
class IDMustBePostiveint extends BaseValidate
{
    protected $rule = [
        'id'=>'require|isPositiveInteger',
        //'num'=>'in:1,2,3'
    ];

    protected $message = [
        'id' => 'id必须是正整数'
    ];

}