<?php

namespace app\api\model;
class BannerItem extends BaseModel
{
    protected $hidden = ['delete_time','update_time','id','img_id'];
    /**
     * @return \think\model\relation\BelongsTo
     */
    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }

}
