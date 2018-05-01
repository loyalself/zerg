<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 16:38
 */
namespace app\api\validate;
class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids参数必须是以逗号分隔的多个正整数'
    ];
    /**
     * @param $value就是客户端传进来的id1,id2,id3.....
     */
    protected function checkIDs($value)
    {
        $values = explode(',',$value);
        if(empty($values))
        {
            return false;
        }
        foreach ($values as $id)
        {
            if(!$this->isPositiveInteger($id))
            {
                return false;
            }
        }
        return true;

    }
}