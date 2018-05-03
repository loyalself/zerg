<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

/*Route::rule('bbn','index/index/bbn');
//在路由路径里定义的就加冒号参数名,问号后面的参数就不需要在路径里定义,问号加上参数
Route::get('test1/:id','index/index/test1');
Route::post('test2/:id','index/index/test2');*/
//固定的三段式                     模块 +  控制器    +方法
//Route::get('api/v1/banner/:id','api/v1.Banner/getBanner');
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');

//Route::get('api/:version/product/recent','api/:version.Product/getRecent');
Route::get('api/:version/product/by_category','api/:version.Product/getAllInCategory');
//Route::get('api/:version/product/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
Route::get('api/:version/product/:id','api/:version.Product/getOne')->pattern( ['id' => '\d+']);
Route::get('api/:version/product/recent','api/:version.Product/getRecent');

/*Route::group('api/:version/product',function(){
    Route::get('/by_category','api/:version.Product/getAllInCategory');
    Route::get('/:id','api/:version.Product/getOne')->pattern(['id'=>'\d+']);
    Route::get('/recent','api/:version.Product/getRecent');
});*/


Route::get('api/:version/category/all','api/:version.Category/getAllCategories');

Route::post('api/:version/token/user','api/:version.Token/getToken');

Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');

Route::get('api/:version/second','api/:version.Address/second');
Route::get('api/:version/third','api/:version.Address/third');


return [

];
