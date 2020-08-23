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
    Route::post('reply/post/{comment_id}', 'FeedbackController@postReply');
    Route::delete('comment/delete/{comment_id}','CommentController@deleteComment');
});
Route::get('rating/get/{shop_id}', 'RatingController@getAllRatingOfShop');
Route::get('rating/getuserrating/{shop_id}', 'RatingController@getUserRatingOnShop');
Route::get('comment/get/{shop_id}', 'CommentController@getAllCommentsOnShop');
Route::get('rating/getuserrating/{shop_id}/{user_id}', 'RatingController@getRatingByUserId');
Route::get('reply/getall/{comment_id}', 'FeedbackController@getAllReplies');
