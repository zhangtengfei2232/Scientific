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
    Route::post('updateCertificate', 'InformationController@updateCertificate');//修改老师证书信息



    //老师对论文的操作
    Route::post('addartical', 'ArticalController@addArtical');              //添加论文
    Route::get('deleteartical', 'ArticalController@deleteArtical');         //删除论文
    Route::get('selectartical', 'ArticalController@selectArtical');         //查询单个论文
    Route::get('selectallattical', 'ArticalController@selectAllAttical');   //查询全部论文
    Route::get('dateSelectArtical', 'ArticalController@dateSelectArtical'); //根据时间查找
    Route::get('dateselectartical', 'ArticalController@dateSelectArtical'); //根据日期查找论文
    Route::post('updateartical', 'ArticalController@updateArtical');        //修改论文
    Route::get('exportartical', 'ArticalController@exportArtical');         //导出一篇论文
    Route::get('exportallartical', 'ArticalController@exportAllArtical');   //导出多个论文，取第一页

    //老师对成果鉴定的操作
    Route::post('addappraisal', 'AppraisalController@addAppraisal');//添加成功鉴定信息
    Route::get('deleteappraisal', 'AppraisalController@deleteAppraisal');//删除单个成功鉴定信息
    Route::get('deleteallappraisal', 'AppraisalController@deleteAllAppraisal');//删除全部成功鉴定信息
    Route::get('selectappraisal', 'AppraisalController@selectAppraisal');//查询单个成果鉴定信息
    Route::get('selectallappraisal', 'AppraisalController@selectAllAppraisal');//查询全部成功鉴定信息
    Route::post('updateappraisal', 'AppraisalController@updateAppraisal');//修改成功鉴定信息

    //老师对获奖的操作
    Route::post('addaward', 'AwardController@addAward');//添加获奖信息
    Route::get('deleteaward', 'AwardController@deleteAward');//删除单个获奖信息
    Route::get('deleteAllAward', 'AwardController@deleteAllAward');//删除多个获奖信息
    Route::get('selectAward', 'AwardController@selectAward');//查询单个获奖信息
    Route::get('selectallaward', 'AwardController@selectAllAward');//查询全部获奖信息
    Route::post('updateAward', 'AwardController@updateAward');//修改获奖信息

    //老师对学术团体职务的操作
    Route::post('addduties', 'DutiesController@addDuties');//添加学术团体职务信息
    Route::get('deleteduties', 'DutiesController@deleteDuties');//删除学术团体职务信息
    Route::get('deleteallduties', 'DutiesController@deleteAllDuties');//删除多个学术团体职务信息
    Route::get('selectduties', 'DutiesController@selectDuties');//查询学术团体职务信息
    Route::get('selectallduties', 'DutiesController@selectAllDuties');//查询全部学术团体职务
    Route::post('updateduties', 'DutiesController@updateDuties');//修改学术团体职务信息

    //老师对举行会议的操作
    Route::post('addholdmeet', 'HoldmeetController@addHoldmeet');//添加举行会议信息
    Route::post('addholdmeetimages', 'HoldmeetController@addHoldmeetImages');//添加举行会议图片
    Route::post('addholdmeetinjection', 'HoldmeetController@addHoldmeetInjection');//举行会议图注
    Route::get('deleteholdmeet', 'HoldmeetController@deleteHoldmeet');//删除举行会议会议
    Route::get('deleteholdimages', 'HoldmeetController@deleteHoldImages');//删除举行会议图片
    Route::post('deleteallholdmeet', 'HoldmeetController@deleteAllHoldmeet');//删除全部举行会议会议
    Route::get('selectholdmeet', 'HoldmeetController@selectHoldmeet');//
    Route::get('selectallholdmeet', 'HoldmeetController@selectAllHoldmeet');//
    Route::post('updateholdmeet', 'HoldmeetController@updateHoldmeet');//
    Route::post('updateholdmeetinject', 'HoldmeetController@updateHoldmeetInject');//

    //老师对参加会议的操作
    Route::post('addjoinmeet', 'JoinmeetController@addJoinmeet');//
    Route::get('addjoinmeetinject', 'JoinmeetController@addJoinmeetInject');//
    Route::get('addjoinmeetimage', 'JoinmeetController@addJoinmeetImage');//
    Route::get('deletejoinmeet', 'JoinmeetController@addJoinmeetImage');//
    Route::get('deletejoinmeetimage', 'JoinmeetController@deleteJoinmeetImage');//
    Route::get('deletealljoinmeet', 'JoinmeetController@deleteAllJoinmeet');//
    Route::get('selectjoinmeet', 'JoinmeetController@selectJoinmeet');//
    Route::get('selectalljoinmeet', 'JoinmeetController@selectAllJoinmeet');//
    Route::post('updatejoinmeet', 'JoinmeetController@updateJoinmeet');//
    Route::post('updatejoinmeetimage', 'JoinmeetController@updateJoinmeetImage');//

    //老师对专家讲学的操作
    Route::post('addLecture', 'LectureController@addLecture');//
    Route::post('addlectureinject', 'LectureController@addLectureInject');//
    Route::post('addLectureImages', 'LectureController@addLectureImages');//
    Route::get('deletelecture', 'LectureController@deleteLecture');//
    Route::post('deletealllecture', 'LectureController@deleteAllLecture');//
    Route::post('deletelectureimages', 'LectureController@deleteLectureImages');//
    Route::get('selectlecture', 'LectureController@selectLecture');//
    Route::post('selectalllecture', 'LectureController@selectAllLecture');//
    Route::post('updatelecture', 'LectureController@updateLecture');//
    Route::post('updatelectureinject', 'LectureController@updateLectureInject');//

    //老师对著作的操作
    Route::post('addopus', 'OpusController@addOpus');//
    Route::post('addopusimage', 'OpusController@addOpusImage');//
    Route::get('deleteopus', 'OpusController@deleteOpus');//
    Route::post('deleteallopus', 'OpusController@deleteAllOpus');//
    Route::get('selectopus', 'OpusController@selectOpus');//
    Route::get('selectallOpus', 'OpusController@selectAllOpus');//
    Route::post('updateopus', 'OpusController@updateOpus');//
    Route::post('updateopusimage', 'OpusController@updateOpusImage');//

    //老师对专利的操作
    Route::post('addpatent', 'PatentController@addPatent');//
    Route::get('deletepatent', 'PatentController@deletePatent');//
    Route::post('deleteallpatent', 'PatentController@deleteAllPatent');//
    Route::get('selectpatent', 'PatentController@selectPatent');//
    Route::post('updatepatent', 'PatentController@updatePatent');//
    Route::post('updatepatent', 'PatentController@updatePatent');//

    //老师对项目的操作
    Route::post('addproject', 'ProjectController@addProject');//
    Route::get('deleteproject', 'ProjectController@deleteProject');//
    Route::get('selectproject', 'ProjectController@selectProject');//
    Route::get('selectallproject', 'ProjectController@selectAllProject');//
    Route::post('updateproject', 'ProjectController@updateProject');//
    Route::post('deleteallproject', 'ProjectController@deleteAllProject');//

    //老师对教学科研合作协议的操作
    Route::post('addagreement','AgreementController@addAgreement');//
    Route::get('deleteagreement','AgreementController@deleteAgreement');//
    Route::get('deleteallagreement','AgreementController@deleteAllAgreement');//
    Route::post('updateagreement','AgreementController@updateAgreement');//
    Route::get('selectagreement','AgreementController@selectAgreement');//
    Route::get('selectallagreement','AgreementController@selectAllAgreement');//

    //老师对校发文件的操作
    Route::post('addschoolfile','SchoolfileController@addSchoolfile');//
    Route::post('deleteschoolfile','SchoolfileController@deleteSchoolfile');//
    Route::post('deleteallschoolfile','SchoolfileController@deleteAllSchoolfile');//
    Route::post('updateschoolfile','SchoolfileController@updateSchoolfile');//
    Route::post('selectschoolfile','SchoolfileController@selectSchoolfile');//
    Route::post('selectallschoolfile','SchoolfileController@selectAllSchoolfile');//
});

