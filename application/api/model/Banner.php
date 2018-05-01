<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/30
 * Time: 15:42
 */
namespace app\api\model;
use think\Db;
class Banner extends BaseModel
{
    protected $hidden = ['delete_time','update_time'];

    /**
     * 一个banner位对应多张banner_item
     * @return \think\model\relation\HasMany
     */
    public function items()
    {
        //关联模型名 关联的外键 当前模型的主键
        return $this->hasMany('BannerItem','banner_id','id');
    }
    /**
     * 根据banner Id号获取banner信息
     * @param $id
     */
    public static function getBannerByID($id)
    {
        /*try
        {
            1/0;
        }catch (\Exception $ex)
        {
            //TODO:可以记录日志
            throw $ex;
        }
        return 'this is banner info';*/
       /* $result = Db::table('banner_item')
                    ->where('banner_id',$id)
                    ->select();     //select 查询满足条件的所有,find 查询一个*/
        $banner = self::with(['items','items.img'])
                    ->find($id);
        return $banner;
    }
}