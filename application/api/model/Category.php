<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/1
 * Time: 21:35
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden = [
        'delete_time','update_time','create_time'
    ];

    public function Img()
   {
       return $this->belongsTo('Image','topic_img_id','id');
   }
}