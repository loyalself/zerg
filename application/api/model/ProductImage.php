<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 15:44
 */
namespace app\api\model;
class ProductImage extends BaseModel
{
    protected $hidden = ['img_id','delete_time','product_id'];

    /**
     * 一对一的关系
     * @return \think\model\relation\BelongsTo
     */
    public function imgUrl()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}