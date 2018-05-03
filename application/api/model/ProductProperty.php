<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 15:47
 */
namespace app\api\model;
class ProductProperty extends BaseModel
{
    protected $hidden = ['product_id','delete_time','id'];
}