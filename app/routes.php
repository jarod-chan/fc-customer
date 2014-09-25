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
