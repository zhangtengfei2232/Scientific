<?php

Route::get('/', function () {
    return view('index');
});

//老师登录
Route::group(['namespace' => 'Login'], function (){
    Route::post('login','LoginController@selectUserLogin');
});

//老师对自己信息的操作
Route::group(['namespace' => 'Scientific','middleware' => ['validate']], function (){
    Route::post('test','ArticalController@seartical');
});
