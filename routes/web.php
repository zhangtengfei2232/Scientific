<?php

Route::get('/', function () {
    return view('index');
});

//老师登录
Route::group(['namespace' => 'Login'], function (){
    Route::post('login','LoginController@selectUserLogin');
});


Route::group(['namespace' => 'Scientific','middleware' => ['validate']], function (){
    //老师对信息的操作
    Route::post('addteacher', 'InformationController@addTeacher');
    Route::get('deleteteacher', 'InformationController@deleteTeacher');
    Route::get('selectteacher', 'InformationController@selectTeacher');
    Route::post('updateteacher', 'InformationController@updateTeacher');


    //老师对论文的操作
    Route::post('addartical', 'ArticalController@addArtical');
    Route::post('deleteartical', 'ArticalController@deleteArtical');
    Route::post('selectartical', 'ArticalController@selectArtical');
    Route::post('updateartical', 'ArticalController@updateArtical');


});

