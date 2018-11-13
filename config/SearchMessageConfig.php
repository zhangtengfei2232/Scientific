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
    const IMAGE_TABLE       = 'image';                 //图片表
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
    const GRA_CERT_ROAD             = 'gra_cert_road';      //老师毕业证书
    const EDU_CERT_ROAD             = 'edu_cert_road';      //老师学位证书
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
    const PRO_ROAD                  = 'pro_road';           //项目图片路径
    const PROJECT_APPROVAL_UNIT     = 'approval_unit';      //项目批准单位
    const OPUS_OP_FIRST_AUTHOR      = 'op_first_author';    //著作第一作者
    const OPUS_OP_NAME              = 'op_name';            //著作名称
    const OPUS_OP_CATE_WORK         = 'op_cate_work';       //著作类别
    const OPUS_OP_FORM_WRITE        = 'op_form_write';      //著作编著形式
    const OPUS_OP_CATE_RESEARCH     = 'op_cate_research';   //著作研究类别
    const OPUS_OP_SUB_CATEGORY      = 'op_sub_category';    //著作学科门类
    const OP_COVER_ROAD             = 'op_cover_road';      //著作封面路径
    const OP_CORIGHT_ROAD           = 'op_coright_road';    //著作版权路劲
    const AWARD_AW_FIRST_AUTHOR     = 'aw_first_author';    //获奖第一获奖人
    const AWARD_AWARD_NAME          = 'award_name';         //获奖奖励名称
    const AWARD_AW_GRANT_UNIT       = 'aw_grant_unit';      //获奖授予单位
    const AWARD_PRIZE_WIN_NAME      = 'prize_win_name';     //获奖成果名称
    const AWARD_AW_LEVEL            = 'aw_level';           //获奖奖励级别
    const AWARD_AW_SCH_RANK         = 'aw_sch_rank';        //获奖校级名次
    const AW_ROAD                   = 'aw_road';            //获奖路径
    const AW_FORM_ACHIEVEMENT       = 'form_achievement';   //获奖成果形式
    const PATEN_FIRST_INVENTOR      = 'first_inventor';     //专利第一发明人
    const PATENT_PA_TYPE            = 'pa_type';            //专利类型
    const PATENT_PA_IMPLE_SITU      = 'pa_imple_situ';      //专利实施情况
    const PATENT_PA_NAME            = 'pa_name';            //专利名称
    const PA_ROAD                   = 'pa_road';            //专利路径
    const APPRAISAL_AP_FIRST_AUTHOR = 'ap_first_author';    //鉴定第一作者
    const APPRAISAL_AP_RES_NAME     = 'ap_res_name';        //专利名称
    const APPRAISAL_AP_FORM         = 'ap_form';            //鉴定形式
    const APPRAISAL_AP_CONCLUSION   = 'ap_conclusion';      //鉴定结论
    const APPRAISAL_AP_LEVEL        = 'ap_level';           //鉴定级别
    const AP_ROAD                   = 'ap_road';            //鉴定路径
    const AP_COVER_ROAD             = 'ap_cover_road';      //鉴定封面路径
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
    const DU_ROAD                   = 'du_road';            //担任团体证书路径
    const DUTIES_TEACHER_NAME       = 'teacher_name';       //担任学术团体老师名字

    /**
     * 每个表的ID字段
     */
    const ACADEMIC_ID               = 'academic_id';
    const AGREEMENT_ID              = 'agree_id';
    const APPRAISAL_ID              = 'ap_id';
    const ARTICAL_ID                = 'art_id';
    const AWARD_ID                  = 'aw_id';
    const DUTIES_ID                 = 'du_id';
    const HOLDMEET_ID               = 'ho_id';
    const IMAGE_ID                  = 'im_id';
    const JOINMEET_ID               = 'jo_id';
    const LECTURE_ID                = 'le_id';
    const OPUS_ID                   = 'op_id';
    const PATENT                    = 'pa_id';
    const PROJECT_ID                = 'pro_id';
    const SCHOOLFILE_ID             = 'schfile_id';
    const TEACHER_ID                = 'teacher_id';

    /**
     * 分组查询，每个字段的情况个数
     */
    const TEA_ACADEMIC_TITLE_NUM  = 7;
    const TEA_MOST_ACADEMIC_NUM   = 3;
    const ARTICAL_PERCAL_CATE_NUM = 11;
    const PRO_CATE_RESEARCH_NUM   = 3;
    const PRO_SUB_CATEGORY_NUM    = 3;
    const OP_FORM_WRITE_NUM       = 5;
    const OP_CATE_WORK_NUM        = 5;
    const AW_FORM_ACHIEVEMENT_NUM = 11;
    const AW_LEVEL_NUM            = 5;
    const PA_TYPE_NUM             = 3;
    const AP_LEVEL_NUM            = 4;

    /**
     * 导出EXCEL表格配置文件
     */
    const SUB_CATEGORY_DATAS  = ['理学','工学','农学','医学','管理学','马克思主义','哲学','逻辑学','宗教学','语言学',
        '中国文学','外国文学','艺术学','历史学','考古学','经济学','政治学','法学'];
    const CATE_RESEARCH_DATAS = ['基础研究','应用研究'];
    const MEETING_LEVEL_DATAS = ['省级','大区级','国家级','国际会议'];
    const ACADEMIC_DATAS      = ['教授','副教授','讲师','助教','高级实验师','实验师','助理实验师'];
    //老师
    const SEX_DATAS                = ['男','女'];
    const TEA_POLIT_OUTLOOK_DATAS  = ['积极分子','发展对象','预备党员','党员'];
    const TEA_JOB_LEVEL_DATAS      = ['正处','副处','正科','副科','其他'];
    const TEA_ACADEMIC_TITLE_DATAS = ['初级','中级','副高','正高'];
    const TEA_POST_CATEGORY_DATAS  = ['正处','副处','正科','副科','其他'];
    //论文
    const ARTI_PERCAL_CATE_DATAS  = ['SCI一区','SCI二区','SCI三区','SCI四区','EI','SSCI','CN','CSSCI核心库','中文核心','CSCD核心库','河南科技学院期刊'];
    //项目
    const PRO_PRO_CATE_RESEARCH_DATAS = ['基础研究','实验与发展','应用研究'];
    const PRO_FORM_COOPERATE_DATAS    = ['与境外机构合作','与国内高校合作','与国内独立研究机构合作','与境外注册外商独资企业合作','与境内注册其他企业合作','其他'];
    //著作
    const OP_FORM_WRITE_DATAS         = ['主编','副主编','参编','编著','其他'];
    const OP_CATE_WORK_DATAS          = ['专著','教科书','译著','编著','其他'];
    //获奖
    const AW_FORM_ACHIEVEMENT_DATAS   = ['论文','研究报告','新技术','新工艺','课件','新产品','专著','编著','计算机软件','教材','其他'];
    const AW_GRADE_DATAS              = ['一等奖','二等奖','三等奖'];
    const AW_LEVEL_DATAS              = ['国家级','省部级','厅局级','校级','其他'];
    //专利
    const PA_TYPE_DATAS               = ['发明专利','实用新型专利','外观设计专利'];
    const PA_IMPLE_SITU_DATAS         = ['授权','受理'];
    //成果鉴定
    const AP_LEVEL_DATAS              = ['国家级','省级','厅级','校级'];
    //举办会议
    const HO_ART_STATUS_DATAS         = ['有','无'];
    //参加会议
    const JO_IS_INVITE                = ['是','否'];
    //专家讲学
    const LE_EXPERT_LEVEL_DATAS       = ['院士','博导','国务院学位委员会委员','教授','其他'];
    const LE_INVITE_STATUS_DATAS      = ['邀请','未邀请'];
    //担任团体职务
    const DU_EDUCATION_DATAS          = ['大专','研究生','本科'];
    const DU_DEGREE_DATAS             = ['硕士','博士','学士'];
}