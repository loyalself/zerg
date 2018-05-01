<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 21:34
 */
namespace app\api\controller\v1;
use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;
class Category
{
    public function getAllCategories()
    {
        // CategoryModel::with()->select()等价于
        $categories = CategoryModel::all([],'img');
        if($categories->isEmpty())
        {
            throw new CategoryException();
        }
        return $categories;
    }
}