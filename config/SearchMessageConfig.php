<?php

namespace config;
class SearchMessageConfig
{
    const TEACHER_TABLE     = 'teacher';               //老师表
    const PATENT_TABLE      = 'patent';                //专利表
    const OPUS_TABLE        = 'opus';                  //著作表
    const HOLD_MEET_TABLE   = 'holdmeet';              //举行会议表
    const JOIN_MEET_TABLE   = 'joinmeet';              //参加会议表
    const LECTURE_TABLE     = 'lecture';               //讲学表
    const DUTIES_TABLE      = 'duties';                //担任职务表
    const SCHOOL_FILE_TABLE = 'schoolfile';            //校发文件文件表
    const AWARD_TABLE       = 'award';                 //获奖表
    const ARTICAL_TABLE     = 'artical';               //论文表
    const APPRAISAL_TABLE   = 'appraisal';             //成果鉴定表
    const AGREEMENT_TABLE   = 'agreement';             //合作协议表
    const PROJECT_TABLE     = 'project';               //项目表
    const AGREE_TIME        = 'agree_time';            //合作协议时间字段
    const AP_TIME           = 'ap_time';               //成果鉴定时间字段
    const ART_TIME          = 'art_time';              //文章的时间字段
    const AW_GRANT_TIME     = 'aw_grant_time';         //获奖的时间字段
    const HO_TIME           = 'ho_time';               //举办会议时间字段
    const JO_TIME           = 'jo_time';               //参加会议时间字段
    const LE_TIME           = 'le_time';               //讲学会议字段
    const OP_PUBLISH_TIME   = 'op_publish_time';       //著作出版时间字段
    const AUTHOR_NOTIC_DAY  = 'author_notic_day';      //专利受理时间字段
    const PROJECT_YEAR      = 'project_year';          //项目年份字段
    const SCHFILE_DOWN_TIME = 'schfile_down_time';     //校发文件日期字段

    const TEACHER_NAME              = 'name';               //老师姓名
    const TEACHER_ADMIN_DUTIES      = 'admin_duties';       //老师行政职务
    const TEACHER_TE_RE_DEPARTMENT  = 'te_re_department';   //老师所属教研室和实验室
    const TEACHER_POST_CATEGORY     = 'post_category';      //老师岗位类别
    const TEACHER_JOB_LEVEL         = 'job_level';          //老师职务级别
    const TEACHER_WORK_MAJOR        = 'work_major';         //老师现从事专业
    const TEACHER_MOST_ACADEMIC     = 'most_academic';      //老师最高学历学位
    const TEACHER_ACADEMIC_TITLE    = 'academic_title';     //老师职称
    const TEACHER_EDU_SCHOOL        = 'edu_school';         //老师学缘
    const ARTICAL_AUTHOR            = 'author';             //论文第一作者字段
    const ARTICAL_PUBLICATION_NAME  = 'publication_name';   //论文发表刊物名称
    const ARTICAL_PERCAL_CATE       = 'percal_cate';        //论文期刊级别
    const ARTICAL_BELONG_PROJECT    = 'belong_project';     //论文所属项目
    const ARTICAL_ART_CATE_RESEARCH = 'art_cate_research';  //论文研究类别
    const ARTICAL_ART_SUB_CATEGORY  = 'art_sub_category';   //论文学科门类
    const ARTICAL_SCH_PERCAL_CATE   = 'sch_percal_cate';    //论文学校认证期刊级别
    const PROJECT_PRO_HOST          = 'pro_host';           //项目主持人
    const PROJECT_PROJECT_CATEGORY  = 'project_category';   //项目类别
    const PROJECT_PRO_CATE_RESEARCH = 'pro_cate_research';  //项目研究类别
    const PROJECT_PRO_SUB_CATEGORY  = 'pro_sub_category';   //项目学科门类
    const PROJECT_APPROVAL_UNIT     = 'approval_unit';      //项目批准单位
    const OPUS_OP_FIRST_AUTHOR      = 'op_first_author';    //著作第一作者
    const OPUS_OP_NAME              = 'op_name';            //著作名称
    const OPUS_OP_CATE_WORK         = 'op_cate_work';       //著作类别
    const OPUS_OP_FORM_WRITE        = 'op_form_write';      //著作编著形式
    const OPUS_OP_CATE_RESEARCH     = 'op_cate_research';   //著作研究类别
    const OPUS_OP_SUB_CATEGORY      = 'op_sub_category';    //著作学科门类
    const AWARD_AW_FIRST_AUTHOR     = 'aw_first_author';    //获奖第一获奖人
    const AWARD_AWARD_NAME          = 'award_name';         //获奖奖励名称
    const AWARD_AW_GRANT_UNIT       = 'aw_grant_unit';      //获奖授予单位
    const AWARD_PRIZE_WIN_NAME      = 'prize_win_name';     //获奖成果名称
    const AWARD_AW_LEVEL            = 'aw_level';           //获奖奖励级别
    const AWARD_AW_SCH_RANK         = 'aw_sch_rank';        //获奖校级名次
    const PATEN_FIRST_INVENTOR      = 'first_inventor';     //专利第一发明人
    const PATENT_PA_TYPE            = 'pa_type';            //专利类型
    const PATENT_PA_IMPLE_SITU      = 'pa_imple_situ';      //专利实施情况
    const PATENT_PA_NAME            = 'pa_name';            //专利名称
    const APPRAISAL_AP_FIRST_AUTHOR = 'ap_first_author';    //鉴定第一作者
    const APPRAISAL_AP_RES_NAME     = 'ap_res_name';        //专利名称
    const APPRAISAL_AP_FORM         = 'ap_form';            //鉴定形式
    const APPRAISAL_AP_CONCLUSION   = 'ap_conclusion';      //鉴定结论
    const APPRAISAL_AP_LEVEL        = 'ap_level';           //鉴定级别
    const HOLDMEET_HO_NAME          = 'ho_name';            //举行会议名称
    const HOLDMEET_HO_LEVEL         = 'ho_level';           //举行会议级别
    const JOINMEET_JO_NAME          = 'jo_name';            //参加会议名称
    const JOINMEET_JO_LEVEL         = 'jo_level';           //参加会议等级
    const LECTURE_LE_EXPERT_NAME    = 'le_expert_name';     //专家讲学名字
    const LECTURE_LE_EXPERT_LEVEL   = 'le_expert_level';    //专家讲学级别
    const LECTURE_LE_INVITE_UNIT    = 'le_invite_unit';     //邀请单位
    const SCHOOLFILE_SCHFILE_NAME   = 'schfile_name';       //校发文件名称
    const AGREEMENT_AGREE_NAME      = 'agree_name';         //合作协议名称
    const DUTIES_DU_NAME            = 'du_name';            //担任学术团体名称
    const DUTIES_TEACHER_NAME       = 'teacher_name';       //担任学术团体老师名字


    /**
     * 下拉框配置信息
     */
    //老师
    const SEX_DATAS                = ['男','女'];
    const TEACHER_DEPARTMENT_DATAS = ['生工','生物技术系','农学系','领导行政政工'];
    const TEACHER_JOB_LEVEL_DATAS  = ['正处','副处','正科','副科','其他'];
    const TEACHER_TECHNICAL_DATAS  = ['教授','副教授','讲师','助教','实验师','助理实验师','高级实验师'];

}