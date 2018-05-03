<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/3
 * Time: 16:48
 */
namespace app\api\controller\v1;
use app\api\model\User as UserModel;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;
class Address extends Controller
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only'=>'createOrUpdateAddress']
    ];

    //验证初级权限的作用域
    protected function checkPrimaryScope()
    {
        $scope = TokenService::getCurrentTokenVar('scope');
        if($scope)
        {
            if($scope >= ScopeEnum::User)
            {
                return true;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }

    }
    /*protected $beforeActionList = [
        //只有执行这个second.third方法才可以执行first前置操作
        'first' => ['only' => 'second,third']
    ];
    public function first()
    {
        echo 'first';
    }
    //API接口
    public function second()
    {
        echo 'second';
    }
    public function third()
    {
        echo 'third';
    }*/

    public function createOrUpdateAddress()
    {
        $validate = new AddressNew();
        $validate->goCheck();
        //1.根据Token获取用户的uid
        //2.根据uid获取用户数据,判断用户是否存在,如果不存在抛出异常
        //3.获取用户从客户端传来的地址信息
        //4.根据用户信息是否存在从而判断是添加地址还是更新地址
        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user)
        {
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if(!$userAddress){
            $user->address()->save($dataArray);
        }else{
            $user->address->save($dataArray);
        }
        return json(new SuccessMessage(),201);
    }
}