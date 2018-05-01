<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 16:17
 */
namespace app\api\model;
class Product extends BaseModel
{
    protected $hidden = [
        'delete_time','update_time','create_time','main_img_id',
        'pivot','from','category_id',
    ];

    /**
     * 图片url获取器
     * @param $value
     * @param $data
     * @return string
     */
    public function getMainImgUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }

    /**
     * 获取最新商品
     * 指定数量,还要某个字段倒序排列
     * @param $count
     */
    public static function getMostRecent($count)
    {
        $products = self::limit($count)
                ->order('create_time desc')
                ->select();
        return $products;
    }
    /**
     * 获取某个分类下的所有商品
     */
    public static function getProductsByCategoryID($categoryID)
    {
        $products = self::where('category_id',$categoryID)
                    ->select();
        return $products;
    }
}