<?php

Route::get('/', function () {
    return view('welcome');
});

//老师登录
Route::group(['namespace' => 'Login'], function (){
    Route::post('login','LoginController@selectUserLogin');
});

Route::group(['namespace' => 'ScientificController','middleware'=>['validate']], function (){
    Route::get('indexpage', 'InformationController@showIndex');
    //老师对信息的操作
    Route::post('addteacher', 'InformationController@addTeacher');          //添加老师信息
    Route::get('deleteteacher', 'InformationController@deleteTeacher');     //删除老师信息
    Route::get('selectteacher', 'InformationController@selectTeacher');     //查询老师信息
    Route::post('updateteacher', 'InformationController@updateTeacher');    //修改老师信息

    //老师对论文的操作
    Route::post('addartical', 'ArticalController@addArtical');              //添加论文
    Route::get('deleteartical', 'ArticalController@deleteArtical');         //删除论文
    Route::get('selectartical', 'ArticalController@selectArtical');         //查询单个论文
    Route::get('dateselectartical', 'ArticalController@dateSelectArtical'); //根据日期查找论文
    Route::post('updateartical', 'ArticalController@updateArtical');        //修改论文
    Route::get('selectallattical', 'ArticalController@selectAllAttical');   //查询全部论文
    Route::get('exportartical', 'ArticalController@exportArtical');         //导出一篇论文
    Route::get('exportsomeartical', 'ArticalController@exportSomeArtical'); //导出多个论文，取第一页

    //老师对成果鉴定的操作
    Route::post('addappraisal', 'AppraisalController@addAppraisal');
    Route::get('deleteappraisal', 'AppraisalController@deleteAppraisal');
    Route::get('selectappraisal', 'AppraisalController@selectAppraisal');
    Route::post('updateappraisal', 'AppraisalController@updateAppraisal');


    //老师对获奖的操作
    Route::post('addaward', 'AwardController@addAward');
    Route::get('deleteaward', 'AwardController@deleteAward');
    Route::get('selectAward', 'AwardController@selectAward');
    Route::post('updateAward', 'AwardController@updateAward');

    //老师对学术团体职务的操作
    Route::post('addduties', 'DutiesController@addDuties');
    Route::get('deleteduties', 'DutiesController@deleteDuties');
    Route::get('selectduties', 'DutiesController@selectDuties');
    Route::post('updateduties', 'DutiesController@updateDuties');

    //老师对举行会议的操作
    Route::post('addholdmeet', 'HoldmeetController@addHoldmeet');
    Route::get('deleteholdmeet', 'HoldmeetController@deleteHoldmeet');
    Route::get('selectholdmeet', 'HoldmeetController@selectHoldmeet');
    Route::post('updateholdmeet', 'HoldmeetController@updateHoldmeet');

    //老师对参加会议的操作
    Route::post('addjoinmeet', 'JoinmeetController@addJoinmeet');
    Route::get('deletejoinmeet', 'JoinmeetController@deleteJoinmeet');
    Route::get('selectjoinmeet', 'JoinmeetController@selectJoinmeet');
    Route::post('updatejoinmeet', 'JoinmeetController@updateJoinmeet');


    //老师对专家讲学的操作
    Route::post('addLecture', 'LectureController@addLecture');
    Route::get('deletelecture', 'LectureController@deleteLecture');
    Route::get('selectlecture', 'LectureController@selectLecture');
    Route::post('updatelecture', 'LectureController@updateLecture');

    //老师对著作的操作
    Route::post('addopus', 'OpusController@addOpus');
    Route::get('deleteopus', 'OpusController@deleteOpus');
    Route::get('selectopus', 'OpusController@selectOpus');
    Route::get('selectallOpus', 'OpusController@selectAllOpus');
    Route::post('updateopus', 'OpusController@updateOpus');

    //老师对专利的操作
    Route::post('addpatent', 'PatentController@addPatent');
    Route::get('deletepatent', 'PatentController@deletePatent');
    Route::get('selectpatent', 'PatentController@selectPatent');
    Route::post('updatepatent', 'PatentController@updatePatent');

    //老师对项目的操作
    Route::post('addproject', 'ProjectController@addProject');
    Route::get('deleteproject', 'ProjectController@deleteProject');
    Route::get('selectproject', 'ProjectController@selectProject');
    Route::get('selectallproject', 'ProjectController@selectAllProject');
    Route::post('updateproject', 'ProjectController@updateProject');
});

