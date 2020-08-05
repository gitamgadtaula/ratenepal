<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    // Route::get('me','MeController');  
});

Route::group(['prefix'=>'auth'], function(){
    Route::post('login','AuthController@loginRequest');
    Route::get('me','AuthController@userInfo');
    Route::Post('register','RegisterUserController@store'); 
    Route::post('logout','AuthController@logout'); 
    Route::get('user/{user_id}','AuthController@userInfoById');
});
