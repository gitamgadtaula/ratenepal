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


Route::group(['middleware' => 'auth'], function () {
    Route::post('rating/post/{shop_id}', 'RatingController@postRating');
    Route::post('comment/post/{shop_id}', 'CommentController@postComment');
});
Route::get('rating/get/{shop_id}', 'RatingController@getAllRatingOfShop');
Route::get('rating/getuserrating/{shop_id}', 'RatingController@getUserRatingOnShop');
Route::get('comment/get/{shop_id}', 'CommentController@getAllCommentsOnShop');
