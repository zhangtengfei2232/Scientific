<?php

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Login'], function (){
    //老师登录
    Route::post('login','LoginController@selectUserLogin');
    //老师退出登录
    Route::get('leavelogin','LoginController@leaveLogin');
});

/**
 * 后台异常路由
 */
Route::group(['namespace' => 'ErrorController'],function (){
    //后台报错，404页面
    Route::post('showfourview','EmptyController@showFourView');
    //用户请求资源失败，返回资源为空页面
    Route::get('showemptyview','EmptyController@showEmptyView');
});

/**
 * 导出每个模块Excel表格
 */
Route::group(['namespace' => 'ExportController'], function (){
    /**
     * 导出EXCEL表格信息
     */
    Route::get('exportteacherexcel','ExcelController@exportTeacherExcel');        //导出老师EXCEL表格
    Route::get('exportarticalexcel','ExcelController@exportArticalExcel');        //导出论文EXCEL表格
    Route::get('exportprojectexcel','ExcelController@exportProjectExcel');        //导出项目Excel表格
    Route::get('exportopusexcel','ExcelController@exportOpusExcel');              //导出著作Excel表格
    Route::get('exportawardexcel','ExcelController@exportAwardExcel');            //导出获奖Excel表格
    Route::get('exportpatentexcel','ExcelController@exportPatentExcel');          //导出专利Excel表格
    Route::get('exportappraisalexcel','ExcelController@exportAppraisalExcel');    //导出成果鉴定Excel表格
    Route::get('exportholdmeetexcel','ExcelController@exportHoldmeetExcel');      //导出举行会议Excel表格
    Route::get('exportjoinmeetexcel','ExcelController@exportJoinmeetExcel');      //导出参加会议Excel表格
    Route::get('exportlectureexcel','ExcelController@exportLectureExcel');        //导出讲学Excel表格
    Route::get('exportdutiesexcel','ExcelController@exportDutiesExcel');          //导出担任团体职务Excel表格
    Route::get('exportschoolfileexcel','ExcelController@exportSchoolFileExcel');  //导出校发文件Excel表格
    Route::get('exportagreementexcel','ExcelController@exportAgreementExcel');    //导出合作协议Excel表格

    /**
     * 导出PDF
     */
    Route::get('exportaArticalPdfs','PdfController@exportarticalpdfs');       //导出多个论文，取第一页,合成一个新的PDF
    Route::get('exportprojectpdfs','PdfController@exportProjectPdfs');        //导出项目PDF
    Route::get('exportopuspdfs','PdfController@exportOpusPdfs');              //导出著作PDF
    Route::get('exportawardpdfs','PdfController@exportAwardPdfs');            //导出获奖PDF
    Route::get('exportpatentpdfs','PdfController@exportPatentPdfs');          //导出专利PDF
    Route::get('exportappraisalpdfs','PdfController@exportAppraisalPdfs');    //导出成果鉴定PDF

});

Route::group(['namespace' => 'ScientificController','middleware'=>['validate']], function (){
    /**
     * 请求storage文件夹下的资源
     */
    Route::get('showfile','AccessFileController@showFile');                       //请求资源
    /**
     * 下载storage文件夹下的文件
     */
    Route::get('downloadfile','AccessFileController@downloadFile');               //下载文件


    //老师对信息的操作
    Route::get('indexpage', 'InformationController@showIndex');                   //查看老师信息页面
    Route::get('selectAllTeacherId', 'InformationController@selectAllTeacherId'); //查看已经存在的老师工号
    Route::post('addteacher', 'InformationController@addTeacher');                //添加老师信息
    Route::post('addcertificate', 'InformationController@addCertificate');        //添加老师证书信息
    Route::get('deleteteacher', 'InformationController@deleteTeacher');           //删除老师信息
    Route::get('selectteacher', 'InformationController@selectTeacher');           //查询老师信息
    Route::post('updateteacher', 'InformationController@updateTeacher');          //修改老师信息
    Route::post('updateCertificate', 'InformationController@updateCertificate');  //修改老师证书信息
    Route::post('updateteacherpostcategory', 'InformationController@updateTeacherPostCategory');  //修改老师岗位类别
    Route::post('updateteacherpassword', 'InformationController@updateTeacherPassword');          //修改老师密码
    Route::post('initializeteacherpassword', 'InformationController@initializeTeacherPassword');  //重置老师密码


    //老师对论文的操作
    Route::post('addartical', 'ArticalController@addArtical');                     //添加论文
    Route::get('deleteartical', 'ArticalController@deleteArtical');                //删除论文
    Route::get('selectartical', 'ArticalController@selectArtical');                //查询单个论文
    Route::get('selectallattical', 'ArticalController@selectAllArtical');          //查询全部论文
    Route::get('timeselectattical', 'ArticalController@timeSelectArtical');        //根据时间区间查询信息
    Route::post('updatearticalinformation', 'ArticalController@updateArticalInformation');//修改论文信息
    Route::post('updatearticalself', 'ArticalController@updateArticalSelf');       //修改论文


    //老师对成果鉴定的操作
    Route::post('addappraisal', 'AppraisalController@addAppraisal');               //添加成果鉴定信息
    Route::get('deleteappraisal', 'AppraisalController@deleteAppraisal');          //删除单个成果鉴定信息
    Route::get('selectappraisal', 'AppraisalController@selectAppraisal');          //查询单个成果鉴定信息
    Route::get('selectallappraisal', 'AppraisalController@selectAllAppraisal');    //查询全部成功鉴定信息
    Route::get('timeselectappraisal', 'AppraisalController@timeSelectAppraisal');  //根据时间区间搜索成果鉴定
    Route::post('updateappraisal', 'AppraisalController@updateAppraisal');         //修改成果鉴定信息

    //老师对获奖的操作
    Route::post('addaward', 'AwardController@addAward');                           //添加获奖信息
    Route::get('deleteaward', 'AwardController@deleteAward');                      //删除单个获奖信息
    Route::get('selectaward', 'AwardController@selectAward');                      //查询单个获奖信息
    Route::get('selectallaward', 'AwardController@selectAllAward');                //查询全部获奖信息
    Route::get('timeselectaward', 'AwardController@timeSelectAward');              //根据时间区间查询信息
    Route::post('updateAward', 'AwardController@updateAward');                     //修改获奖信息


    //老师对学术团体职务的操作
    Route::post('addduties', 'DutiesController@addDuties');                        //添加学术团体职务信息
    Route::get('deleteduties', 'DutiesController@deleteDuties');                   //删除学术团体职务信息
    Route::get('selectduties', 'DutiesController@selectDuties');                   //查询学术团体职务信息
    Route::get('selectallduties', 'DutiesController@selectAllDuties');             //查询全部学术团体职务
    Route::get('timeselectduties', 'DutiesController@timeSelectDuties');           //根据时间区间查询信息
    Route::post('updateduties', 'DutiesController@updateDuties');                  //修改学术团体职务信息



    //老师对举行会议的操作
    Route::post('addholdmeet', 'HoldmeetController@addHoldmeet');                  //添加举行会议信息
    Route::post('addholdmeetimages', 'HoldmeetController@addHoldmeetImages');      //添加举行会议图片
    Route::get('deleteholdmeet', 'HoldmeetController@deleteHoldmeet');             //删除举行会议会议
    Route::get('deleteholdmeetimage', 'HoldmeetController@deleteHoldmeetImage');   //删除举行会议图片
    Route::get('selectholdmeet', 'HoldmeetController@selectHoldmeet');             //查询单个举行会议信息
    Route::get('selectallholdmeet', 'HoldmeetController@selectAllHoldmeet');       //查询全部举行会议信息
    Route::get('timeselectholdmeet', 'HoldmeetController@timeSelectHoldmeet');     //根据时间区间查询信息
    Route::post('updateholdmeet', 'HoldmeetController@updateHoldmeet');            //修改举行会议信息



    //老师对参加会议的操作
    Route::post('addjoinmeet', 'JoinmeetController@addJoinmeet');                  //添加参加会议
    Route::post('addjoinmeetimage', 'JoinmeetController@addJoinmeetImage');        //添加参加会议图片
    Route::get('deletejoinmeet', 'JoinmeetController@deleteJoinmeet');             //删除参加会议信息
    Route::get('deletejoinmeetimage', 'JoinmeetController@deleteJoinmeetImage');   //删除参加会议图片
    Route::get('selectjoinmeet', 'JoinmeetController@selectJoinmeet');             //查询单个参加会议信息
    Route::get('selectalljoinmeet', 'JoinmeetController@selectAllJoinmeet');       //查询全部参加会议信息
    Route::get('timeselectjoinmeet', 'JoinmeetController@timeSelectJoinmeet');     //根据时间区间查询信息
    Route::post('updatejoinmeet', 'JoinmeetController@updateJoinmeet');            //修改参加会议信息


    //老师对专家讲学的操作
    Route::post('addLecture', 'LectureController@addLecture');                     //添加专家讲学信息
    Route::post('addLectureImages', 'LectureController@addLectureImages');         //添加专家讲学图片
    Route::get('deletelecture', 'LectureController@deleteLecture');                //删除专家讲学信息
    Route::get('deletelectureimage', 'LectureController@deleteLectureImage');      //删除专家讲学图片
    Route::get('selectlecture', 'LectureController@selectLecture');                //查询单个专家讲学信息
    Route::get('selectalllecture', 'LectureController@selectAllLecture');          //查询多个专家讲学信息
    Route::get('timeselectlecture', 'LectureController@timeSelectLecture');        //根据时间区间查询信息
    Route::post('updatelecture', 'LectureController@updateLecture');               //修改专家讲学信息


    //老师对著作的操作
    Route::post('addopus', 'OpusController@addOpus');                              //添加著作
    Route::get('deleteopus', 'OpusController@deleteOpus');                         //删除著作信息
    Route::get('selectopus', 'OpusController@selectOpus');                         //查询单个著作信息
    Route::get('selectallopus', 'OpusController@selectAllOpus');                   //查询全部著作信息
    Route::get('timeselectopus', 'OpusController@timeSelectOpus');                 //根据时间区间查询信息
    Route::post('updateopus', 'OpusController@updateOpus');                        //修改著作信息


    //老师对专利的操作
    Route::post('addpatent', 'PatentController@addPatent');                        //添加专利信息
    Route::get('deletepatent', 'PatentController@deletePatent');                   //删除专利信息
    Route::get('selectpatent', 'PatentController@selectPatent');                   //查询单个专利信息
    Route::get('selectallpatent', 'PatentController@selectAllPatent');             //查询全部专利信息
    Route::get('timeselectpatent', 'PatentController@timesSelectPatent');          //根据时间区间查询信息
    Route::post('updatepatent', 'PatentController@updatePatent');                  //修改专利信息


    //老师对项目的操作
    Route::post('addproject', 'ProjectController@addProject');                     //添加项目信息
    Route::get('deleteproject', 'ProjectController@deleteProject');                //删除项目信息
    Route::get('selectproject', 'ProjectController@selectProject');                //查询项目信息
    Route::get('selectallproject', 'ProjectController@selectAllProject');          //查询全部项目信息
    Route::get('timeselectproject', 'ProjectController@timeSelectProject');        //根据时间区间查询信息
    Route::post('updateproject', 'ProjectController@updateProject');               //修改项目信息


    //老师对教学科研合作协议的操作
    Route::post('addagreement','AgreementController@addAgreement');                //添加教学科研合作协议信息
    Route::get('deleteagreement','AgreementController@deleteAgreement');           //删除教学科研合作协议信息
    Route::post('updateagreement','AgreementController@updateAgreement');          //修改教学科研合作协议信息
    Route::get('selectagreement','AgreementController@selectAgreement');           //查询单个教学科研合作协议信息
    Route::get('selectallagreement','AgreementController@selectAllAgreement');     //查询全部教学科研合作协议信息
    Route::get('timeselectagreement','AgreementController@timesSelectAgreement');  //根据时间区间查询信息


    //老师对校发文件的操作
    Route::post('addschoolfile','SchoolfileController@addSchoolfile');             //添加校发文件信息
    Route::get('deleteschoolfile','SchoolfileController@deleteSchoolfile');        //删除校发文件信息
    Route::post('updateschoolfile','SchoolfileController@updateSchoolfile');       //修改校发文件信息
    Route::get('selectschoolfile','SchoolfileController@selectSchoolfile');        //查询单个校发文件信息
    Route::get('selectallschoolfile','SchoolfileController@selectAllSchoolfile');  //查询全部校发文件信息
    Route::get('timeselectschoolfile','SchoolfileController@timeSelectSchoolfile');//根据时间区间查询信息



    /**
     * 1.秘书、院长的特殊功能======>检索所有信息功能的路由
     * 2.生成=======>师资组成(学历，职称，学缘)，论文(期刊级别)，
     * 项目(证书级别)，著作(著作类别)，获奖(获奖级别)的路由
     */
    /**
     * 老师查询路由
     */
    Route::get('byfieldselectteacher','RetrievalController@byFieldSelectTeacher');                          //老师名字查询老师信息

    /**
     * 论文查询路由
     */
    Route::get('byfieldselectartical','RetrievalController@byFieldSelectArtical');
    /**
     * 项目查询路由
     */
    Route::get('byfieldselectproject','RetrievalController@byFieldSelectProject');
    /**
     * 著作查询路由
     */
    Route::get('byfieldselectopus','RetrievalController@byFieldSelectOpus');
    /**
     * 获奖查询路由
     */
    Route::get('byfieldselectaward','RetrievalController@byFieldSelectAward');
    /**
     * 专利查询路由
     */
    Route::get('byfieldselectpatent','RetrievalController@byFieldSelectPatent');

    /**
     * 成果鉴定查询路由
     */
    Route::get('byfieldselectappraisal','RetrievalController@byFieldSelectAppraisal');
    /**
     * 举办会议查询路由
     */
    Route::get('byfieldselectholdmeet','RetrievalController@byFieldSelectHoldmeet');

    /**
     * 参加会议查询路由
     */
    Route::get('byfieldselectjoinmeet','RetrievalController@byFieldSelectJoinmeet');
    /**
     * 专家讲学路由
     */
    Route::get('byFieldSelectLecture','RetrievalController@byFieldSelectLecture');
    /**
     * 校发文件查询路由
     */
    Route::get('byfieldselectschoofile','RetrievalController@byFieldSelectSchoofile');
    /**
     * 合作协议查询路由
     */
    Route::get('byfieldselectagreement','RetrievalController@byFieldSelectAgreement');
    /**
     * 担任团体职务查询路由
     */
    Route::get('byfieldselectduties','RetrievalController@byFieldSelectDuties');


    /**总览数据
     * 饼图数据路由
     */

    /**
     * 师资组成数据路由
     */
    Route::get('groupbyteachereducation','RetrievalController@groupByTeacherEducation');             //按老师学历学位分组查询数据
    Route::get('groupbyteachertechnicaltitle','RetrievalController@groupByTeacherTechnicalTitle');   //按老师职称分组查询数据
    /**
     * 论文数据路由
     */
    Route::get('groupbyarticaljournallevel','RetrievalController@groupByArticalJournalLevel');       //按照论文期刊级别分组查询

    /**
     * 项目数据路由
     */
    Route::get('groupbyprojectcertificatelevel','RetrievalController@groupByProjectCertificateLevel');//按照项目学科门类分组查询
    Route::get('groupbyprojetcateresearch','RetrievalController@groupByProjetCateResearch');          //按照项目研究类别分组查询
    Route::get('groupbyprojectlevel','RetrievalController@groupByProjectLevel');                      //项目级别查询
    /**
     * 著作数据路由
     */
    Route::get('gropubyopuscategory','RetrievalController@gropuByOpusCategory');                      //按照著作类别查询分组查询
    Route::get('groupbyopusformwrite','RetrievalController@groupByOpusFormWrite');                    //按照著作编著形式分组查询
    /**
     * 获奖数据路由
     */
    Route::get('groupbywinlevel','RetrievalController@groupBywinLevel');                              //按照获奖级别分组查询
    Route::get('groupbyformachievement','RetrievalController@groupByFormAchievement');                //按照获奖成果形式分组查询
    /**
     * 专利数据路由
     */
    Route::get('groupbypatenttype','RetrievalController@groupByPatentType');                          //按照专利类型分组查询
    /**
     * 成果鉴定
     */
    Route::get('groupbyappraisallevel','RetrievalController@groupByAppraisalLevel');                  //按照鉴定类别分组查询


    /**
     * 每个模块的数据总和
     */
    Route::get('counteverymodular','RetrievalController@countEveryModular');

});

