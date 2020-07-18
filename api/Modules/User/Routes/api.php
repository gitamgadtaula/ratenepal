<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    // Route::get('me','MeController');  
});

Route::group(['prefix'=>'auth'], function(){
    Route::post('login','AuthController@loginRequest');
    // Route::post('signout','Controller');
    Route::get('me','AuthController@userInfo');
    Route::Post('register','RegisterUserController@store');    
});
