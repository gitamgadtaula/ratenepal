<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/shop', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'shop',  'middleware' => 'auth'], function()
{
    //All the routes that belongs to the group goes here
    Route::post('create','ShopController@createShop');
    
});
Route::get('shop/getall','ShopController@fetchShop');
Route::get('shop/{shop_id}','ShopController@fetchShopById');