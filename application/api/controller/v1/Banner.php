<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/30
 * Time: 12:13
 */
namespace app\api\controller\v1;
use app\api\model\BannerItem;
use app\api\validate\IDMustBePostiveint;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;
use think\Exception;
use think\facade\Config;
class Banner
{
    /**
     * 获取指定id的banner信息
     * @url banner/:id
     * @http get
     * @id banner的id号
     */
    public function getBanner($id)
    {
       /* $data = ['id'=>$id];
        $validate = new IDMustBePostiveint();
        $result = $validate->batch()->check($data);
        if($result) {
        }else {}*/
       //AOP 面向切面编程
        (new IDMustBePostiveint())->goCheck();
       /* try
        {
            $banner = BannerModel::getBannerByID($id);
        }catch(Exception $ex)
        {
            $error = [
                'error_code' => 10001,
                'msg'         => $ex->getMessage()
            ];
            return json($error,400);
        };
        return $banner;*/
       //with()里可以接收数组([items1,items2]),查清多个关联
      //$banner = BannerModel::with(['items','items.img'])->find($id);  这个里有嵌套关联
        $banner = BannerModel::getBannerByID($id);
        if(!$banner)
        {
            throw new BannerMissException();
        }
        return json($banner);   //return $banner;

    }
}