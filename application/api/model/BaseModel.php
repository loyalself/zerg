<?php
namespace app\api\model;
use think\Model;
class BaseModel extends Model
{
    /**
     * 定义图片url读取器 这个get和Attr是固定的
     * 不用自己去拼接url
     */
    protected function prefixImgUrl($value,$data)
    {
        //dump($value);exit;  返回url相对路径
        $finalUrl = $value;
        if($data['from'] == 1)
        {
            $finalUrl =  config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
