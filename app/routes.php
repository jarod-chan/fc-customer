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
Route::pattern('crid', '[0-9]+');

//微信获得菜单
Route::get('wx/menu','WxMenuController@menu');

//添加客户
Route::get('wx/{crid}/customer/add','WxCustomerController@toAdd');
Route::post('wx/{crid}/customer/save','WxCustomerController@save');
Route::get('wx/{crid}/customer/edit/{id}','WxCustomerController@toEdit');


//客户意向
Route::get('customer/{customer_id}/purpose/list','PurposeController@toList');
Route::get('customer/{customer_id}/purpose/add','PurposeController@toAdd');
Route::get('customer/{customer_id}/purpose/{id}/edit','PurposeController@toEdit');
Route::post('customer/{customer_id}/purpose/save','PurposeController@save');
Route::post('customer/{customer_id}/purpose/{id}/delete','PurposeController@delete');


