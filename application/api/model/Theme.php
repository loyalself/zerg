<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 16:18
 */
namespace app\api\model;
class Theme extends BaseModel
{
    protected $hidden = ['delete_time','update_time','topic_img_id','head_img_id'];
    /**
     * 一对一的关系
     * @return \think\model\relation\BelongsTo
     */
    public function topicImg()
    {
        return $this->belongsTo('image','topic_img_id','id');
    }

    /**
     * 专题点进去头部显示的图片
     * @return \think\model\relation\BelongsTo
     */
    public function headImg()
    {
        return $this->belongsTo('image','head_img_id','id');
    }

    public function products()
    {
        //最后两个参数来自于中间表
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }

    public static function getThemeWithProducts($id)
    {
        $theme = self::with('products,topicImg,headImg')
                  ->find($id);
        return $theme;
    }
}