<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/30
 * Time: 12:13
 */
namespace app\api\controller\v2;
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
        return 'this is a v2';
    }
}