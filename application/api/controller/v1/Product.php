<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 19:32
 */
namespace app\api\controller\v1;
use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePostiveint;
use app\lib\exception\ProductException;
class Product
{
    /**
     * 获取最新新品接口
     * @param int $count 默认15条
     */
    public function getRecent($count=15)
    {
        (new Count())->goCheck();
         $products = ProductModel::getMostRecent($count);
         if($products->isEmpty())
         {
             throw new ProductException();
         }
         //TODO:临时隐藏summary字段
         $products = $products->hidden(['summary']);
         return $products;
    }

    public function getAllInCategory($id)
    {
        (new IDMustBePostiveint())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if($products->isEmpty())
        {
            throw new ProductException();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }
}