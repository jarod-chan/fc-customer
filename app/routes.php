<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//id 匹配模式
Route::pattern('id', '[0-9]+');

//微信获得菜单
Route::get('menu','MenuController@index');
Route::get('menu/to','MenuController@to');

Route::group(array('before' => 'ismobile'), function()
{
	//添加客户
	Route::get('customer/add','CustomerController@toAdd');
	Route::post('customer/save','CustomerController@save');
	Route::get('customer/{id}/edit','CustomerController@toEdit');
	Route::get('customer/{state}','CustomerController@index');



	//佣金结算
	Route::get('commission','CommissionController@index');
	Route::get('commission/query','CommissionController@query');
	Route::get('commission/{dr_id}/deal','CommissionController@toDeal');
	Route::post('commission/{dr_id}/save','CommissionController@save');
});


Route::group(array('before' => 'ismobile','prefix' => 'customer/{customer_id}'), function()
{
	//客户意向
	Route::get('purpose/list','PurposeController@toList');
	Route::get('purpose/add','PurposeController@toAdd');
	Route::get('purpose/{id}/edit','PurposeController@toEdit');
	Route::post('purpose/save','PurposeController@save');
	Route::post('purpose/{id}/delete','PurposeController@delete');

	//跟进记录
	Route::get('inrecord/list','InrecordController@toList');
	Route::get('inrecord/add','InrecordController@toAdd');
	Route::get('inrecord/{id}/edit','InrecordController@toEdit');
	Route::post('inrecord/save','InrecordController@save');
	Route::post('inrecord/{id}/delete','InrecordController@delete');

	//意向房源
	Route::get('purposeroom/list','PurposeroomController@toList');
	Route::get('purposeroom/add','PurposeroomController@toAdd');
	Route::get('purposeroom/{id}/edit','PurposeroomController@toEdit');
	Route::post('purposeroom/save','PurposeroomController@save');
	Route::post('purposeroom/{id}/delete','PurposeroomController@delete');

	//成交记录
	Route::get('dealrecord/list','DealrecordController@toList');
	Route::get('dealrecord/add','DealrecordController@toAdd');
	Route::get('dealrecord/{id}/edit','DealrecordController@toEdit');
	Route::post('dealrecord/save','DealrecordController@save');
	Route::post('dealrecord/{id}/delete','DealrecordController@delete');

});


//房间查询
Route::get('selroom/sellproject','SelRoomController@sellproject');
Route::get('selroom/building','SelRoomController@building');
Route::get('selroom/buildingunit','SelRoomController@buildingunit');
Route::get('selroom/room','SelRoomController@room');

//用户登录
Route::get('','LoginController@index');
Route::get('login','LoginController@login');
Route::post('login','LoginController@loginPost');
Route::post('logout','LoginController@logout');

Route::group(array('before' => 'islogin'), function()
{
	//销售顾问
	Route::get('counselor/list','CounselorController@toList');
	Route::get('counselor/add','CounselorController@toAdd');
	Route::get('counselor/{id}/edit','CounselorController@toEdit');
	Route::post('counselor/save','CounselorController@save');

	//配置选项
	Route::get('syenum/list','SyenumController@toList');
	Route::get('syenum/vals/{type}','SyenumController@toVals');
	Route::post('syenum/vals/{type}','SyenumController@saveVal');

	//配置选项
	Route::get('projectpct/list','PorjectpctController@toList');
	Route::get('projectpct/edit','PorjectpctController@toEdit');
	Route::post('projectpct/save','PorjectpctController@save');

	//全局参数
	Route::get('sysparam/list','SysparamController@toList');
	Route::get('sysparam/edit/{key}','SysparamController@toEdit');
	Route::post('sysparam/save','SysparamController@save');
});

//号码查询
Route::get('query','QueryController@query');

//号码校验
Route::get('verify','VerifyController@verify');

//失效访问页面
Route::get('fail/mobile','FailController@mobile');


