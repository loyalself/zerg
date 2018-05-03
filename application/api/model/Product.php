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
     * 一个商品的详情对应着多张图片,这是一个很明显的一对多的关系
     */
    public function imgs()
    {
       return $this->hasMany('ProductImage','product_id','id');
    }

    /**
     * 一个商品可以有很多属性,这也是一个一对多的关系
     */
    public function properties()
    {
        return $this->hasMany('ProductProperty','product_id','id');
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

    public static function getProductDetail($id)
    {
        //$product = self::with('imgs.imgUrl,properties')->find($id);
        $product = self::with([
            'imgs' => function($query){
                $query->with(['imgUrl'])
                      ->order('order','asc');
            }
        ])
            ->with(['properties'])
            ->find($id);
        return $product;
    }
}