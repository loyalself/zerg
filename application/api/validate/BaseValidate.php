<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/30
 * Time: 14:34
 */
namespace app\api\validate;
use app\lib\exception\ParameterException;
use think\Exception;
use think\facade\Request;
use think\Validate;
class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http传入的参数,对这些参数做校验
        //下面这个方法是tp5.0里面的,致命错误: Call to undefined method think\Request::instance()
        //$request = Request::instance();
        $params = Request::param();
        $result = $this->batch()->check($params);
        if(!$result)
        {
            //这个叫初始化赋值,符合面向对象,然后可以去书写它的构造函数
            $e = new ParameterException([
                'msg'  => $this->error,
            ]);
         /*  $e->msg = $this->error; //这个也是自动去获取tp自带的报错信息
           $e->errorCode = 10002;*/
            throw $e;
           /* //$error = $this->error;
            //throw new Exception($error);  //这是tp自带的异常*/
        }else{
            return true;
        }
    }
    /**
     * 这是我自己定义的验证规则,就是tp5没有的规则
     * @param $value
     * @param string $rule
     * @param string $data
     * @param string $field
     */
    protected function isPositiveInteger($value,$rule='',$data='',$field='')
    {
        //  +0的操作可以避免$value="1"的情况。
        if(is_numeric($value) && is_int($value+0) && ($value+0)>0)
        {
            return true;
        }else
        {
            return false;
            //return $field.'必须是整数';
        }
    }

    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule,$value);
        if($result)
        {
            return true;
        }else{
            return false;
        }
    }

    protected function isNotEmpty($value,$rule='',$data='',$field='')
    {
      if(empty($value))
      {
         return false;
      }else{
          return true;
      }
    }

    public function getDataByRule($arrays)
    {
       if(array_key_exists('user_id',$arrays) |
           array_key_exists('uid',$arrays)) {
           //不允许包含user_id或者uid,防止恶意覆盖掉user_id外键
           throw new ParameterException([
               'msg' => '参数中包含有非法的参数名user_id或者uid'
           ]);
       }
           //保存我们指定的参数的值
           $newArray = [];
           foreach ($this->rule as $key=>$value)
           {
               $newArray[$key] = $arrays[$key];
           }
           return $newArray;
    }


}