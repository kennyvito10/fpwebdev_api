<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth/allproducts','AuthController@allproducts');
Route::get('/auth/apple','AuthController@apple');
Route::get('/auth/samsung','AuthController@samsung');
Route::get('/auth/oppo','AuthController@oppo');
Route::get('/auth/xiaomi','AuthController@xiaomi');
Route::get('/auth/product','AuthController@product');
Route::post('/auth/addtocart','AuthController@addtocart');
Route::get('/auth/seecart','AuthController@seecart');
Route::get('/auth/seecheckout','AuthController@seecheckout');
Route::patch('/auth/checkoutorder','AuthController@checkoutorder');
Route::delete('/auth/deleteproductcart',  'AuthController@deleteproductcart');
Route::get('/auth/deletecart', 'AuthController@deleteallproductcart');
Route::get('/auth/vieworder', 'AuthController@vieworder');
Route::get('/auth/showhistory', 'AuthController@showhistory');
Route::get('/auth/getbrand', 'AuthController@getbrand');
Route::post('/auth/adminaddproduct','AuthController@adminaddproduct');
Route::patch('/auth/updateadminstatusdelivered','AuthController@updateadminstatusdelivered');
Route::patch('/auth/updateadminstatusfinished','AuthController@updateadminstatusfinished');
Route::get('/auth/adminvieworder', 'AuthController@adminvieworder');
Route::get('/auth/getproduct', 'AuthController@getproduct');
Route::delete('/auth/deletep',  'AuthController@deletep');
Route::get('/auth/getproductbyid', 'AuthController@getproductbyid');
Route::patch('/auth/admineditproduct','AuthController@admineditproduct');

