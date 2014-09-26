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

//添加客户
Route::get('customer/add','CustomerController@toAdd');
Route::post('customer/save','CustomerController@save');
Route::get('customer/{id}/edit','CustomerController@toEdit');

//意向客户
Route::get('customer/purpose','CPurposeController@index');
//签约客户
Route::get('customer/sign','CSignController@index');
//公共客户
Route::get('customer/public','CPublicController@index');

//客户意向
Route::get('customer/{customer_id}/purpose/list','PurposeController@toList');
Route::get('customer/{customer_id}/purpose/add','PurposeController@toAdd');
Route::get('customer/{customer_id}/purpose/{id}/edit','PurposeController@toEdit');
Route::post('customer/{customer_id}/purpose/save','PurposeController@save');
Route::post('customer/{customer_id}/purpose/{id}/delete','PurposeController@delete');

//跟进记录
Route::get('customer/{customer_id}/inrecord/list','InrecordController@toList');
Route::get('customer/{customer_id}/inrecord/add','InrecordController@toAdd');
Route::get('customer/{customer_id}/inrecord/{id}/edit','InrecordController@toEdit');
Route::post('customer/{customer_id}/inrecord/save','InrecordController@save');
Route::post('customer/{customer_id}/inrecord/{id}/delete','InrecordController@delete');

Route::group(array('prefix' => 'customer/{customer_id}'), function()
{
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


//
Route::get('curl',function (){
	$url="http://172.22.1.30/fc-customer/public/menu?openid=a1";

	//  Initiate curl
	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);

	// Will dump a beauty json :3
	$x=json_decode($result, true);
	d($x);
	d($x["result"]);
	return ;
});
