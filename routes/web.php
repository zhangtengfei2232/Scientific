<?php

Route::get('/', function () {
    return view('welcome');
});

//老师登录
Route::group(['namespace' => 'Login'], function (){
    Route::post('login','LoginController@selectUserLogin');
});
/**
 * 导出Excel表格
 */
Route::group(['namespace' => 'ExportController'], function (){
    Route::get('exportexcel','ExcelController@exportExcel');
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
    Route::post('addteacher', 'InformationController@addTeacher');                //添加老师信息
    Route::get('deleteteacher', 'InformationController@deleteTeacher');           //删除老师信息
    Route::get('selectteacher', 'InformationController@selectTeacher');           //查询老师信息
    Route::post('updateteacher', 'InformationController@updateTeacher');          //修改老师信息
    Route::post('updateCertificate', 'InformationController@updateCertificate');  //修改老师证书信息



    //老师对论文的操作
    Route::post('addartical', 'ArticalController@addArtical');                     //添加论文
    Route::get('deleteartical', 'ArticalController@deleteArtical');                //删除论文
    Route::get('selectartical', 'ArticalController@selectArtical');                //查询单个论文
    Route::get('selectallattical', 'ArticalController@selectAllAttical');          //查询全部论文
    Route::get('timeselectattical', 'ArticalController@timeSelectAttical');        //根据时间区间查询信息
    Route::get('dateSelectartical', 'ArticalController@dateSelectArtical');        //根据时间查找
    Route::get('dateselectartical', 'ArticalController@dateSelectArtical');        //根据日期查找论文
    Route::post('updateartical', 'ArticalController@updateArtical');               //修改论文
    Route::get('exportartical', 'ArticalController@exportArtical');                //导出一篇论文
    Route::get('exportallartical', 'ArticalController@exportAllArtical');          //导出多个论文，取第一页



    //老师对成果鉴定的操作
    Route::post('addappraisal', 'AppraisalController@addAppraisal');               //添加成果鉴定信息
    Route::post('addappraisalimage', 'AppraisalController@addAppraisalImage');     //添加成果鉴定图片
    Route::get('deleteappraisal', 'AppraisalController@deleteAppraisal');          //删除单个成果鉴定信息
    Route::get('selectappraisal', 'AppraisalController@selectAppraisal');          //查询单个成果鉴定信息
    Route::get('selectallappraisal', 'AppraisalController@selectAllAppraisal');    //查询全部成功鉴定信息
    Route::get('timeselectappraisal', 'AppraisalController@timeSelectAppraisal');    //根据时间区间搜索成果鉴定
    Route::post('updateappraisal', 'AppraisalController@updateAppraisal');         //修改成果鉴定信息
    Route::post('updateappraisalimage', 'AppraisalController@updateAppraisalImage');//修改成果鉴定图片信息信息

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
    Route::get('deleteholdimages', 'HoldmeetController@deleteHoldImages');         //删除举行会议图片
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
    Route::get('deletelectureimages', 'LectureController@deleteLectureImages');    //删除专家讲学图片
    Route::get('selectlecture', 'LectureController@selectLecture');                //查询单个专家讲学信息
    Route::get('selectalllecture', 'LectureController@selectAllLecture');          //查询多个专家讲学信息
    Route::get('timeselectlecture', 'LectureController@timeSelectLecture');        //根据时间区间查询信息
    Route::post('updatelecture', 'LectureController@updateLecture');               //修改专家讲学信息


    //老师对著作的操作
    Route::post('addopus', 'OpusController@addOpus');                              //添加著作
    Route::post('addopusimage', 'OpusController@addOpusImage');                    //添加著作图片
    Route::get('deleteopus', 'OpusController@deleteOpus');                         //删除著作信息
    Route::get('selectopus', 'OpusController@selectOpus');                         //查询单个著作信息
    Route::get('selectallopus', 'OpusController@selectAllOpus');                   //查询全部著作信息
    Route::get('timeselectopus', 'OpusController@timeSelectOpus');                 //根据时间区间查询信息
    Route::post('updateopus', 'OpusController@updateOpus');                        //修改著作信息
    Route::post('updateopusimage', 'OpusController@updateOpusImage');              //修改著作图片


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
    Route::get('leaderselectallteacher','RetrievalController@leaderSelectAllTeacher');                    //查询老师全部信息
    Route::get('bynameselectteacher','RetrievalController@byNameSelectTeacher');                          //老师名字查询老师信息
    Route::get('byacademictitleselectteacher','RetrievalController@byAcademicTitleSelectTeacher');        //老师职称查询
    Route::get('byadmindutiesselectteacher','RetrievalController@byAdminDutiesSelectTeacher');            //老师行政职务查询
    Route::get('byteachresearchselectteacher','RetrievalController@byTeachResearchSelectTeacher');        //老师所属教研室和实验室查询
    Route::get('bypostcategoryselectteacher','RetrievalController@byPostCategorySelectTeacher');          //老师岗位类别查询
    Route::get('byjoblevelselectteacher','RetrievalController@byJobLevelSelectTeacher');                  //老师职务级别查询
    Route::get('byworkmajorselectteacher','RetrievalController@byWorkMajorSelectTeacher');                //老师先从事专业查询


    /**
     * 论文查询路由
     */
    Route::get('leaderselectallartical','RetrievalController@leaderSelectAllArtical');                    //查询论文全部信息
    Route::get('byauthorselectartical','RetrievalController@byAuthorSelectArtical');                      //根据论文作者模糊查询
    Route::get('bydatelineselectartical','RetrievalController@byDatelineSelectArtical');                  //发表刊物名称查询
    Route::get('byperiodicalselectartical','RetrievalController@byPeriodicalSelectArtical');              //发表日期查询
    Route::get('byjournallevelselectartical','RetrievalController@byJournalLevelSelectArtical');          //刊物级别查询
    Route::get('bybelongprojectselectartical','RetrievalController@byBelongProjectSelectArtical');        //所属项目查询
    Route::get('bysubjectcategoryselectartical','RetrievalController@bySubjectCategorySelectArtical');    //学科门类查询
    Route::get('bycategoryresearchselectartical','RetrievalController@byCategoryResearchSelectArtical');  //研究类别查询
    Route::get('byschoolaffirmlevelselectartical','RetrievalController@bySchoolaffirmLevelSelectArtical');//学校认定刊物级别查询

    /**
     * 项目查询路由
     */
    Route::get('leaderselectallproject','RetrievalController@leaderSelectAllProject');                    //查询全部项目信息
    Route::get('byhostselectproject','RetrievalController@byHostSelectProject');                          //主持人查询
    Route::get('byyearselectproject','RetrievalController@byYearSelectProject');                          //项目年份查询
    Route::get('bycategoryselectproject','RetrievalController@byCategorySelectProject');                  //项目类别查询
    Route::get('byapprovalunitaelectproject','RetrievalController@byApprovalUnitSelectProject');          //批准单位查询
    Route::get('bysubjectcategoryselectproject','RetrievalController@bySubjectCategorySelectProject');    //学科门类查询
    Route::get('bycategoryresearchselectproject','RetrievalController@byCategoryResearchSelectProject');  //项目研究类别查询

    /**
     * 著作查询路由
     */
    Route::get('leaderselecttallopus','RetrievalController@leaderSelecttAllOpus');                       //查询全部著作信息
    Route::get('bynameselectopus','RetrievalController@byNameSelectOpus');                               //著作名称查询
    Route::get('byauthorselectopus','RetrievalController@byAuthorSelectOpus');                           //第一作者查询
    Route::get('bycategoryselectopus','RetrievalController@byCategorySelectOpus');                       //著作类别查询
    Route::get('byformwritingselectopus','RetrievalController@byFormWritingSelectOpus');                 //编著形式查询
    Route::get('bysubjectcategoryselectopus','RetrievalController@bySubjectCategorySelectOpus');         //学科门类查询
    Route::get('bypublicationdateselectopus','RetrievalController@byPublicationDateSelectOpus');         //出版日期查询
    Route::get('bycategoryresearchselectopus','RetrievalController@byCategoryResearchSelectOpus');       //研究类别查询

    /**
     * 获奖查询路由
     */
    Route::get('leaderselectallaward','RetrievalController@leaderSelectAllAward');                      //查询全部获奖信息
    Route::get('byfirstwinnerselectaward','RetrievalController@byFirstWinnerSelectAward');              //第一获奖人查询
    Route::get('byawardingunitselectaward','RetrievalController@byAwardingUnitSelectAward');            //授奖单位查询
    Route::get('byawardtimeselectaward','RetrievalController@byAwardTimeSelectAward');                  //授予时间查询
    Route::get('bynameselectaward','RetrievalController@byNameSelectAward');                            //奖励名称查询
    Route::get('byresultsnameselectaward','RetrievalController@byResultsNameSelectAward');              //获奖成果名称查询
    Route::get('bywinnergradeselectaward','RetrievalController@byWinnerGradeSelectAward');              //获奖级别查询
    Route::get('byschoolrankselectaward','RetrievalController@bySchoolRankSelectAward');                //获奖级别查询

    /**
     * 专利查询路由
     */
    Route::get('leaderselectallpatent','RetrievalController@leaderSelectAllPatent');                    //查询全部专利信息
    Route::get('byfirstinventorselectpatent','RetrievalController@byFirstInventorSelectPatent');        //第一发明人查询
    Route::get('bytypeselectpatent','RetrievalController@byTypeSelectPatent');                          //专利类型查询
    Route::get('byimplementstatusselectpatent','RetrievalController@byImplementStatusSelectPatent');    //实施情况查询
    Route::get('byadmissibilitydayselectpatent','RetrievalController@byAdmissibilityDaySelectPatent');  //受理日查询
    Route::get('bynameselectpatent','RetrievalController@byNameSelectPatent');                          //专利名称查询

    /**
     * 成果鉴定查询路由
     */
    Route::get('leaderselectallappraisal','RetrievalController@leaderSelectAllAppraisal');              //查询全部鉴定成果信息
    Route::get('byhostselectappraisal','RetrievalController@byHostSelectAppraisal');                    //主持人查询
    Route::get('bynameselectappraisal','RetrievalController@byNameSelectAppraisal');                    //鉴定成果名称查询
    Route::get('byformselectappraisal','RetrievalController@byFormSelectAppraisal');                    //鉴定形式查询
    Route::get('byconclusionselectappraisal','RetrievalController@byConclusionSelectAppraisal');        //鉴定结论查询
    Route::get('bytimeselectappraisal','RetrievalController@byTimeSelectAppraisal');                    //鉴定时间查询
    Route::get('bylevelselectappraisal','RetrievalController@byLevelSelectAppraisal');                  //鉴定级别查询

    /**
     * 举办会议查询路由
     */
    Route::get('leaderselectallholdmeet','RetrievalController@leaderSelectAllHoldmeet');                //查询全部举办会议信息
    Route::get('bynameselectholdmeet','RetrievalController@byNameSelectHoldmeet');                      //举办会议名称查询
    Route::get('bylevelselectholdmeet','RetrievalController@byLevelSelectHoldmeet');                    //举办会议级别查询
    Route::get('bytimeselectholdmeet','RetrievalController@byTimeSelectHoldmeet');                      //举办会议时间查询

    /**
     * 参加会议查询路由
     */
    Route::get('leaderselectalljoinmeet','RetrievalController@leaderSelectAllJoinmeet');                //查询全部参加会议信息
    Route::get('bynameselectjoinmeet','RetrievalController@byNameSelectJoinmeet');                      //参加会议名称查询
    Route::get('bylevelselectjoinmeet','RetrievalController@byLevelSelectJoinmeet');                    //参加会议级别查询
    Route::get('bytimeselectjoinmeet','RetrievalController@byTimeSelectJoinmeet');                      //参加会议时间查询

    /**
     * 专家讲学路由
     */
    Route::get('leaderselectalllecture','RetrievalController@leaderSelectAllLecture');                  //查询全部专家讲学信息
    Route::get('bynameselectlecture','RetrievalController@byNameSelectLecture');                        //专家名字查询
    Route::get('bylevelselectlecture','RetrievalController@byLevelSelectLecture');                      //专家级别查询
    Route::get('byinviteunitselectlecture','RetrievalController@byInviteUnitSelectLecture');            //邀请单位查询
    Route::get('byinvitetimeselectlecture','RetrievalController@byInviteTimeSelectLecture');            //邀请时间查询

    /**
     * 校发文件查询路由
     */
    Route::get('leaderselectallschoolfile','RetrievalController@leaderSelectAllSchoolfile');            //查询全部校发文件信息
    Route::get('bynameselectschoofile','RetrievalController@byNameSelectSchoofile');                    //校发文件名称查询
    Route::get('bytimeselectschoofile','RetrievalController@byTimeSelectSchoofile');                    //校发时间查询

    /**
     * 合作协议查询路由
     */
    Route::get('leaderselectallagreement','RetrievalController@leaderSelectAllAgreement');              //查询全部合作协议信息
    Route::get('bynameselectagreement','RetrievalController@byNameSelectAgreement');                    //合作协议名称查询
    Route::get('bytimeselectagreement','RetrievalController@byTimeSelectAgreement');                    //协议时间查询
    /**
     * 担任团体职务查询路由
     */
    Route::get('leaderselectallduties','RetrievalController@leaderSelectAllDuties');                    //查询全部担任团体职务信息
    Route::get('bynameselectduties','RetrievalController@byNameSelectDuties');                          //担任学术团体名称查询
    Route::get('byteachernameselectduties','RetrievalController@byTeacherNameSelectDuties');            //根据老师名字查询


    /**总览数据
     * 饼图数据路由
     */

    /**
     * 师资组成数据路由
     */
    Route::get('groupbyteachereducation','RetrievalController@groupByTeacherEducation');
    Route::get('groupbyteachertechnicaltitle','RetrievalController@byLevelSelectLecture');
    Route::get('groupbyteacheracademicmargin','RetrievalController@groupByTeacherAcademicMargin');

    /**
     * 论文数据路由
     */
    Route::get('groupbyarticaljournallevel','RetrievalController@groupByArticalJournalLevel');

    /**
     * 项目数据路由
     */
    Route::get('groupbyprojectcertificatelevel','RetrievalController@groupByProjectCertificateLevel');
    /**
     * 著作数据路由
     */
    Route::get('gropubyopuscategory','RetrievalController@gropuByOpusCategory');
    /**
     * 获奖数据路由
     */
    Route::get('groupbywinlevel','RetrievalController@groupBywinLevel');
});

