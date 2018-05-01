<?php
namespace app\api\controller\v1;
use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostiveint;
use app\lib\exception\ThemeException;
class Theme
{
    /**
     * 获取专题
     * @http GET
     * @url /theme?ids=id1,id2,id3,...
     * @return  一组theme模型
     */
    public function getSimpleList($ids='')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',',$ids);
        $result = ThemeModel::with('topicImg,headImg')
                  ->select($ids);
        if($result->isEmpty())
        {
            throw new ThemeException();
        }
        return $result;
    }

    /**
     * 获取某个专题下的详情
     * @url theme/:id
     * @param $id
     */
    public function getComplexOne($id)
    {
        (new IDMustBePostiveint())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if(!$theme)
        {
            throw new ThemeException();
        }
        return $theme;
    }
}