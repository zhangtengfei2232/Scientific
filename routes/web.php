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
    Route::post('addteacher', 'InformationController@addTeacher');
    Route::get('deleteteacher', 'InformationController@deleteTeacher');
    Route::get('selectteacher', 'InformationController@selectTeacher');
    Route::post('updateteacher', 'InformationController@updateTeacher');


    //老师对论文的操作
    Route::post('addartical', 'ArticalController@addArtical');
    Route::get('deleteartical', 'ArticalController@deleteArtical');
    Route::get('selectartical', 'ArticalController@selectArtical');
    Route::post('updateartical', 'ArticalController@updateArtical');

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
    Route::post('updateopus', 'OpusController@updateOpus');

    //老师对专利的操作
    Route::post('addpatent', 'PatentController@addPatent');
    Route::get('deletepatent', 'PatentController@deletePatent');
    Route::get('selectpatent', 'PatentController@selectPatent');
    Route::post('updatepatent', 'PatentController@updatePatent');

    //老师对项目的操作
    Route::post('addproject', 'ProjectController@addProject');
    Route::get('deleteproject', 'ProjectController@deleteproject');
    Route::get('selectproject', 'ProjectController@selectproject');
    Route::post('updateproject', 'ProjectController@updateproject');
});

