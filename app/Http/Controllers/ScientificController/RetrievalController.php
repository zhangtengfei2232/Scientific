<?php
namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use config\SearchMessageConfig;
use Illuminate\Http\Request;
class RetrievalController extends Controller
{
    /**
     * 1.秘书、院长的特殊功能======>检索所有信息功能
     * 2.生成=======>师资组成(最高学历，职称，学缘)，论文(期刊级别)，
     * 项目(证书级别)，著作(著作类别)，获奖(获奖级别)
     */
    /**
     *检索功能
     */
    /**
     * 老师检索
     */
    //查询老师全部信息
    public function leaderSelectAllTeacher(){
        $table_name = SearchMessageConfig::TEACHER_TABLE;
        return ModelDatabase::selectAllDatas($table_name,'');
    }
    //老师名字查询老师信息
    public function byNameSelectTeacher(Request $request){
        $table_name = SearchMessageConfig::TEACHER_TABLE;
        $name_field = SearchMessageConfig::TEACHER_NAME;
        $teacher_name = $request->teacher_name;
        return ModelDatabase::byNameSelectDatas($table_name,$name_field,$teacher_name,'');
    }
    //老师职称查询
    public function byAcademicTitleSelectTeacher(Request $request){
        $table_name = SearchMessageConfig::TEACHER_TABLE;
        $academic_title_field = SearchMessageConfig::TEACHER_ACADEMIC_TITLE;
        $academic_title       = $request->academic_title;
        return ModelDatabase::categorySelectInformation($table_name,$academic_title_field,$academic_title,'');
    }
    //老师行政职务查询
    public function byAdminDutiesSelectTeacher(Request $request){
        $table_name = SearchMessageConfig::TEACHER_TABLE;
        $admin_duties_field = SearchMessageConfig::TEACHER_ADMIN_DUTIES;
        $admin_duties       = $request->admin_duties;
        return ModelDatabase::byNameSelectDatas($table_name,$admin_duties_field,$admin_duties,'');
    }
    //老师所属教研室和实验室查询
    public function byTeachResearchSelectTeacher(Request $request){
        $table_name = SearchMessageConfig::TEACHER_TABLE;
        $te_re_department_field = SearchMessageConfig::TEACHER_TE_RE_DEPARTMENT;
        $te_re_department       = $request->te_re_department;
        return ModelDatabase::byNameSelectDatas($table_name,$te_re_department_field,$te_re_department,'');
    }
    //老师岗位类别查询
    public function byPostCategorySelectTeacher(Request $request){
        $table_name = SearchMessageConfig::TEACHER_TABLE;
        $post_category_field = SearchMessageConfig::TEACHER_POST_CATEGORY;
        $post_category       = $request->post_category;
        return ModelDatabase::categorySelectInformation($table_name,$post_category_field,$post_category,'');
    }
    //老师职务级别查询
    public function byJobLevelSelectTeacher(Request $request){
        $table_name = SearchMessageConfig::TEACHER_TABLE;
        $job_level_field = SearchMessageConfig::TEACHER_JOB_LEVEL;
        $job_level       = $request->job_level;
        return ModelDatabase::categorySelectInformation($table_name,$job_level_field,$job_level,'');
    }
    //老师先从事专业查询
    public function byWorkMajorSelectTeacher(Request $request){
        $table_name = SearchMessageConfig::TEACHER_TABLE;
        $work_major_filed = SearchMessageConfig::TEACHER_WORK_MAJOR;
        $work_major       = $request->work_major;
        return ModelDatabase::byNameSelectDatas($table_name,$work_major_filed,$work_major,'');
    }

    /**
     * 论文检索
     */
    public function leaderSelectAllArtical(){
        $table_name = SearchMessageConfig::ARTICAL_TABLE;
        $time_field = SearchMessageConfig::ART_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //根据论文作者模糊查询
    public function byAuthorSelectArtical(Request $request){
        $table_name       = SearchMessageConfig::ARTICAL_TABLE;
        $time_field       = SearchMessageConfig::ART_TIME;
        $art_author_field = SearchMessageConfig::ARTICAL_AUTHOR;
        $art_author       = $request->author;
        return ModelDatabase::byNameSelectDatas($table_name,$art_author_field,$art_author,$time_field);
    }
    //发表刊物名称查询
    public function byDatelineSelectArtical(Request $request){
        $table_name             = SearchMessageConfig::ARTICAL_TABLE;
        $time_field             = SearchMessageConfig::ART_TIME;
        $publication_name_field = SearchMessageConfig::ARTICAL_PUBLICATION_NAME;
        $publication_name       = $request->publication_name;
        return ModelDatabase::byNameSelectDatas($table_name,$publication_name_field,$publication_name,$time_field);
    }
    //发表日期查询
    public function byPeriodicalSelectArtical(Request $request){
        $table_name = SearchMessageConfig::ARTICAL_TABLE;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $field      = SearchMessageConfig::ART_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$field);
    }
    //刊物级别查询
    public function byJournalLevelSelectArtical(Request $request){
        $journal_level       = $request->percal_cate;
        $time_field          = SearchMessageConfig::ART_TIME;
        $table_name          = SearchMessageConfig::ARTICAL_TABLE;
        $journal_level_field = SearchMessageConfig::ARTICAL_PERCAL_CATE;
        return ModelDatabase::categorySelectInformation($table_name,$journal_level_field,$journal_level,$time_field);
    }
    //所属项目查询
    public function byBelongProjectSelectArtical(Request $request){
        $belong_project       = $request->belong_project;
        $time_field           = SearchMessageConfig::ART_TIME;
        $table_name           = SearchMessageConfig::ARTICAL_TABLE;
        $belong_project_field = SearchMessageConfig::ARTICAL_BELONG_PROJECT;
        return ModelDatabase::byNameSelectDatas($table_name,$belong_project_field,$belong_project,$time_field);
    }
    //学科门类查询
    public function bySubjectCategorySelectArtical(Request $request){
        $table_name             = SearchMessageConfig::ARTICAL_TABLE;
        $time_field             = SearchMessageConfig::ART_TIME;
        $subject_category_field = SearchMessageConfig::ARTICAL_ART_SUB_CATEGORY;
        $subject_category       = $request->art_sub_category;
        return ModelDatabase::categorySelectInformation($table_name,$subject_category_field,$subject_category,$time_field);
    }
    //研究类别查询
    public function byCategoryResearchSelectArtical(Request $request){
        $table_name              = SearchMessageConfig::ARTICAL_TABLE;
        $time_field              = SearchMessageConfig::ART_TIME;
        $category_research_field = SearchMessageConfig::ARTICAL_ART_CATE_RESEARCH;
        $category_research       = $request->category_research;
        return ModelDatabase::categorySelectInformation($table_name,$category_research_field,$category_research,$time_field);
    }
    //学校认定刊物级别查询
    public function bySchoolaffirmLevelSelectArtical(Request $request){
        $table_name             = SearchMessageConfig::ARTICAL_TABLE;
        $time_field             = SearchMessageConfig::ART_TIME;
        $sch_percal_cate_field  = SearchMessageConfig::ARTICAL_PERCAL_CATE;
        $sch_percal_cate        = $request->sch_percal_cate;
        return ModelDatabase::categorySelectInformation($table_name,$sch_percal_cate_field,$sch_percal_cate,$time_field);
    }

    /**
     * 项目检索
     */
    //查询全部项目信息
    public function leaderSelectAllProject(){
        $table_name     = SearchMessageConfig::PROJECT_TABLE;
        $time_field     = SearchMessageConfig::PROJECT_YEAR;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //主持人查询
    public function byHostSelectProject(Request $request){
        $table_name     = SearchMessageConfig::PROJECT_TABLE;
        $time_field     = SearchMessageConfig::PROJECT_YEAR;
        $pro_host_field = SearchMessageConfig::PROJECT_PRO_HOST;
        $pro_host       = $request->pro_host;
        return ModelDatabase::byNameSelectDatas($table_name,$time_field,$pro_host_field,$pro_host);
    }
    //项目年份查询
    public function byYearSelectProject(Request $request){
        $table_name = SearchMessageConfig::PROJECT_TABLE;
        $time_field = SearchMessageConfig::PROJECT_YEAR;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //项目类别查询
    public function byCategorySelectProject(Request $request){
        $table_name             = SearchMessageConfig::PROJECT_TABLE;
        $time_field             = SearchMessageConfig::PROJECT_YEAR;
        $project_category_field = SearchMessageConfig::PROJECT_PROJECT_CATEGORY;
        $project_category       = $request->project_category;
        return ModelDatabase::categorySelectInformation($table_name,$project_category_field,$project_category,$time_field);
    }
    //批准单位查询
    public function byApprovalUnitSelectProject(Request $request){
        $table_name          = SearchMessageConfig::PROJECT_TABLE;
        $time_field          = SearchMessageConfig::PROJECT_YEAR;
        $approval_unit_field = SearchMessageConfig::PROJECT_APPROVAL_UNIT;
        $approval_unit       = $request->approval_unit;
        return ModelDatabase::byNameSelectDatas($table_name,$approval_unit_field,$approval_unit,$time_field);
    }
    //学科门类查询
    public function bySubjectCategorySelectProject(Request $request){
        $table_name             = SearchMessageConfig::PROJECT_TABLE;
        $time_field             = SearchMessageConfig::PROJECT_YEAR;
        $pro_sub_category_field = SearchMessageConfig::PROJECT_PRO_SUB_CATEGORY;
        $pro_sub_category       = $request->pro_sub_category;
        return ModelDatabase::categorySelectInformation($table_name,$pro_sub_category_field,$pro_sub_category,$time_field);
    }
    //项目研究类别查询
    public function byCategoryResearchSelectProject(Request $request){
        $table_name              = SearchMessageConfig::PROJECT_TABLE;
        $time_field              = SearchMessageConfig::PROJECT_YEAR;
        $pro_cate_research_field = SearchMessageConfig::PROJECT_PRO_CATE_RESEARCH;
        $pro_cate_research       = $request->pro_cate_research;
        return ModelDatabase::categorySelectInformation($table_name,$pro_cate_research_field,$pro_cate_research,$time_field);
    }

    /**
     * 著作检索
     */
    //查询全部著作信息
    public function leaderSelecttAllOpus(){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //著作名称查询
    public function byNameSelectOpus(Request $request){
        $table_name    = SearchMessageConfig::OPUS_TABLE;
        $time_field    = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_name_field = SearchMessageConfig::OPUS_OP_NAME;
        $op_name       = $request->op_name;
        return ModelDatabase::byNameSelectDatas($table_name,$op_name_field,$op_name,$time_field);
    }
    //第一作者查询
    public function byAuthorSelectOpus(Request $request){
        $table_name            = SearchMessageConfig::OPUS_TABLE;
        $time_field            = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_first_author_field = SearchMessageConfig::OPUS_OP_FIRST_AUTHOR;
        $op_first_author       = $request->op_first_author;
        return ModelDatabase::byNameSelectDatas($table_name,$op_first_author_field,$op_first_author,$time_field);
    }
    //著作类别查询
    public function byCategorySelectOpus(Request $request){
        $table_name         = SearchMessageConfig::OPUS_TABLE;
        $time_field         = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_cate_work_field = SearchMessageConfig::OPUS_OP_CATE_WORK;
        $op_cate_work       = $request->op_cate_work;
        return ModelDatabase::categorySelectInformation($table_name,$op_cate_work_field,$op_cate_work,$time_field);
    }
    //编著形式查询
    public function byFormWritingSelectOpus(Request $request){
        $table_name          = SearchMessageConfig::OPUS_TABLE;
        $time_field          = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_form_write_field = SearchMessageConfig::OPUS_OP_FORM_WRITE;
        $op_form_write       = $request->op_form_write;
        return ModelDatabase::categorySelectInformation($table_name,$op_form_write_field,$op_form_write,$time_field);
    }
    //学科门类查询
    public function bySubjectCategorySelectOpus(Request $request){
        $table_name            = SearchMessageConfig::OPUS_TABLE;
        $time_field            = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_sub_category_field = SearchMessageConfig::OPUS_OP_SUB_CATEGORY;
        $op_sub_category       = $request->op_sub_category;
        return ModelDatabase::categorySelectInformation($table_name,$op_sub_category_field,$op_sub_category,$time_field);
    }
    //出版日期查询
    public function byPublicationDateSelectOpus(Request $request){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //研究类别查询
    public function byCategoryResearchSelectOpus(Request $request){
        $table_name             = SearchMessageConfig::OPUS_TABLE;
        $time_field             = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_cate_research_field = SearchMessageConfig::OPUS_OP_CATE_RESEARCH;
        $op_cate_research       = $request->op_cate_research;
        return ModelDatabase::categorySelectInformation($table_name,$op_cate_research_field,$op_cate_research,$time_field);
    }

    /**
     * 获奖检索
     */
    //查询全部获奖信息
    public function leaderSelectAllAward(){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //第一获奖人查询
    public function byFirstWinnerSelectAward(Request $request){
        $table_name            = SearchMessageConfig::AWARD_TABLE;
        $time_field            = SearchMessageConfig::AW_GRANT_TIME;
        $aw_first_author_field = SearchMessageConfig::AWARD_AW_FIRST_AUTHOR;
        $aw_first_author       = $request->aw_first_author;
        return ModelDatabase::byNameSelectDatas($table_name,$aw_first_author_field,$aw_first_author,$time_field);
    }
    //奖励名称查询
    public function byNameSelectAward(Request $request){
        $table_name       = SearchMessageConfig::AWARD_TABLE;
        $time_field       = SearchMessageConfig::AW_GRANT_TIME;
        $award_name_field = SearchMessageConfig::AWARD_AWARD_NAME;
        $award_name       = $request->award_name;
        return ModelDatabase::byNameSelectDatas($table_name,$award_name_field,$award_name,$time_field);
    }
    //授奖单位查询
    public function byAwardingUnitSelectAward(Request $request){
        $table_name          = SearchMessageConfig::AWARD_TABLE;
        $time_field          = SearchMessageConfig::AW_GRANT_TIME;
        $aw_grant_unit_field = SearchMessageConfig::AWARD_AW_GRANT_UNIT;
        $aw_grant_unit       = $request->aw_grant_unit;
        return ModelDatabase::byNameSelectDatas($table_name,$aw_grant_unit_field,$aw_grant_unit,$time_field);
    }
    //授予时间查询
    public function byAwardTimeSelectAward(Request $request){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //获奖成果名称查询
    public function byResultsNameSelectAward(Request $request){
        $table_name           = SearchMessageConfig::AWARD_TABLE;
        $time_field           = SearchMessageConfig::AW_GRANT_TIME;
        $prize_win_name_field = SearchMessageConfig::AWARD_PRIZE_WIN_NAME;
        $prize_win_name       = $request->prize_win_name;
        return ModelDatabase::byNameSelectDatas($table_name,$prize_win_name_field,$prize_win_name,$time_field);
    }
    //获奖级别查询
    public function byWinnerGradeSelectAward(Request $request){
        $table_name     = SearchMessageConfig::AWARD_TABLE;
        $time_field     = SearchMessageConfig::AW_GRANT_TIME;
        $aw_level_field = SearchMessageConfig::AWARD_AW_LEVEL;
        $aw_level       = $request->aw_level;
        return ModelDatabase::categorySelectInformation($table_name,$aw_level_field,$aw_level,$time_field);
    }
    //我校名次查询
    public function bySchoolRankSelectAward(Request $request){
        $table_name        = SearchMessageConfig::AWARD_TABLE;
        $time_field        = SearchMessageConfig::AW_GRANT_TIME;
        $aw_sch_rank_field = SearchMessageConfig::AWARD_AW_SCH_RANK;
        $aw_sch_rank       = $request->aw_sch_rank;
        return ModelDatabase::categorySelectInformation($table_name,$aw_sch_rank_field,$aw_sch_rank,$time_field);
    }

    /**
     * 专利检索
     */
    //查询全部专利信息
    public function leaderSelectAllPatent(){
        $table_name = SearchMessageConfig::PATENT_TABLE;
        $time_field = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //第一发明人查询
    public function byFirstInventorSelectPatent(Request $request){
        $table_name           = SearchMessageConfig::PATENT_TABLE;
        $time_field           = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $first_inventor_field = SearchMessageConfig::PATEN_FIRST_INVENTOR;
        $first_inventor       = $request->first_inventor;
        return ModelDatabase::byNameSelectDatas($table_name,$first_inventor_field,$first_inventor,$time_field);
    }
    //专利类型查询
    public function byTypeSelectPatent(Request $request){
        $table_name    = SearchMessageConfig::PATENT_TABLE;
        $time_field    = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $pa_type_field = SearchMessageConfig::PATENT_PA_TYPE;
        $pa_type       = $request->pa_type;
        return ModelDatabase::categorySelectInformation($table_name,$pa_type_field,$pa_type,$time_field);
    }
    //实施情况查询
    public function byImplementStatusSelectPatent(Request $request){
        $table_name          = SearchMessageConfig::PATENT_TABLE;
        $time_field          = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $pa_imple_situ_field = SearchMessageConfig::PATENT_PA_IMPLE_SITU;
        $pa_imple_situ       = $request->pa_imple_situ;
        return ModelDatabase::categorySelectInformation($table_name,$pa_imple_situ_field,$pa_imple_situ,$time_field);
    }
    //受理日查询
    public function byAdmissibilityDaySelectPatent(Request $request){
        $table_name = SearchMessageConfig::PATENT_TABLE;
        $time_field = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //专利名称查询
    public function byNameSelectPatent(Request $request){
        $table_name    = SearchMessageConfig::PATENT_TABLE;
        $time_field    = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $pa_name_field = SearchMessageConfig::PATENT_PA_NAME;
        $pa_name       = $request->pa_name;
        return ModelDatabase::byNameSelectDatas($table_name,$pa_name_field,$pa_name,$time_field);
    }

    /**
     * 成果鉴定检索
     */
    //查询全部成果鉴定信息
    public function leaderSelectAllAppraisal(){
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //主持人查询
    public function byHostSelectAppraisal(Request $request){
        $table_name            = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field            = SearchMessageConfig::AP_TIME;
        $ap_first_author_field = SearchMessageConfig::APPRAISAL_AP_FIRST_AUTHOR;
        $ap_first_author       = $request->ap_first_author ;
        return ModelDatabase::byNameSelectDatas($table_name,$ap_first_author_field,$ap_first_author,$time_field);
    }
    //鉴定成果名称查询
    public function byNameSelectAppraisal(Request $request){
        $table_name        = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field        = SearchMessageConfig::AP_TIME;
        $ap_res_name_field = SearchMessageConfig::APPRAISAL_AP_RES_NAME;
        $ap_res_name       = $request->ap_res_name ;
        return ModelDatabase::byNameSelectDatas($table_name,$ap_res_name_field,$ap_res_name,$time_field);
    }
    //鉴定形式查询
    public function byFormSelectAppraisal(Request $request){
        $table_name    = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field    = SearchMessageConfig::AP_TIME;
        $ap_form_field = SearchMessageConfig::APPRAISAL_AP_FORM;
        $ap_form       = $request->ap_form;
        return ModelDatabase::categorySelectInformation($table_name,$ap_form_field,$ap_form,$time_field);
    }
    //鉴定结论查询
    public function byConclusionSelectAppraisal(Request $request){
        $table_name          = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field          = SearchMessageConfig::AP_TIME;
        $ap_conclusion_field = SearchMessageConfig::APPRAISAL_AP_CONCLUSION;
        $ap_conclusion       = $request->ap_conclusion;
        return ModelDatabase::byNameSelectDatas($table_name,$ap_conclusion_field,$ap_conclusion,$time_field);
    }
    //鉴定时间查询
    public function byTimeSelectAppraisal(Request $request){
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //鉴定级别查询
    public function byLevelSelectAppraisal(Request $request){
        $table_name     = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field     = SearchMessageConfig::AP_TIME;
        $ap_level_field = SearchMessageConfig::APPRAISAL_AP_LEVEL;
        $ap_level       = $request->ap_level;
        return ModelDatabase::categorySelectInformation($table_name,$ap_level_field,$ap_level,$time_field);
    }

    /**
     * 举办会议检索
     */
    //查询全部举办会议信息
    public function leaderSelectAllHoldmeet(){
        $table_name = SearchMessageConfig::HOLD_MEET_TABLE;
        $time_field = SearchMessageConfig::HO_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //举办会议名称查询
    public function byNameSelectHoldmeet(Request $request){
        $table_name    = SearchMessageConfig::HOLD_MEET_TABLE;
        $time_field    = SearchMessageConfig::HO_TIME;
        $ho_name_field = SearchMessageConfig::HOLDMEET_HO_NAME;
        $ho_name       = $request->ho_name;
        return ModelDatabase::byNameSelectDatas($table_name,$ho_name_field,$ho_name,$time_field);
    }
    //举办会议级别查询
    public function byLevelSelectHoldmeet(Request $request){
        $table_name     = SearchMessageConfig::HOLD_MEET_TABLE;
        $time_field     = SearchMessageConfig::HO_TIME;
        $ho_level_field = SearchMessageConfig::HOLDMEET_HO_LEVEL;
        $ho_level       = $request->ho_level;
        return ModelDatabase::categorySelectInformation($table_name,$ho_level_field,$ho_level,$time_field);
    }
    //举办会议时间查询
    public function byTimeSelectHoldmeet(Request $request){
        $table_name = SearchMessageConfig::HOLD_MEET_TABLE;
        $time_field = SearchMessageConfig::HO_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }

    /**
     * 参加会议检索
     */
    //查询全部参加会议信息
    public function leaderSelectAllJoinmeet(){
        $table_name = SearchMessageConfig::JOIN_MEET_TABLE;
        $time_field = SearchMessageConfig::JO_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //参加会议名称查询
    public function byNameSelectJoinmeet(Request $request){
        $table_name    = SearchMessageConfig::JOIN_MEET_TABLE;
        $time_field    = SearchMessageConfig::JO_TIME;
        $jo_name_field = SearchMessageConfig::JOINMEET_JO_NAME;
        $jo_name       = $request->jo_name;
        return ModelDatabase::byNameSelectDatas($table_name,$jo_name_field,$jo_name,$time_field);
    }
    //参加会议级别查询
    public function byLevelSelectJoinmeet(Request $request){
        $table_name     = SearchMessageConfig::JOIN_MEET_TABLE;
        $time_field     = SearchMessageConfig::JO_TIME;
        $jo_level_field = SearchMessageConfig::JOINMEET_JO_LEVEL;
        $jo_level       = $request->jo_level;
        return ModelDatabase::categorySelectInformation($table_name,$jo_level_field,$jo_level,$time_field);
    }
    //参加会议时间查询
    public function byTimeSelectJoinmeet(Request $request){
        $table_name = SearchMessageConfig::JOIN_MEET_TABLE;
        $time_field = SearchMessageConfig::JO_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }

    /**
     * 专家讲学检索
     */
    //查询全部专家讲学信息
    public function leaderSelectAllLecture(){
        $table_name = SearchMessageConfig::LECTURE_TABLE;
        $time_field = SearchMessageConfig::LE_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //专家名字查询
    public function byNameSelectLecture(Request $request){
        $table_name           = SearchMessageConfig::LECTURE_TABLE;
        $time_field           = SearchMessageConfig::LE_TIME;
        $le_expert_name_field = SearchMessageConfig::LECTURE_LE_EXPERT_NAME;
        $le_expert_name       = $request->le_expert_name;
        return ModelDatabase::byNameSelectDatas($table_name,$le_expert_name_field,$le_expert_name,$time_field);
    }
    //专家级别查询
    public function byLevelSelectLecture(Request $request){
        $table_name            = SearchMessageConfig::LECTURE_TABLE;
        $time_field            = SearchMessageConfig::LE_TIME;
        $le_expert_level_field = SearchMessageConfig::LECTURE_LE_EXPERT_LEVEL;
        $le_expert_level       = $request->le_expert_level;
        return ModelDatabase::categorySelectInformation($table_name,$le_expert_level_field,$le_expert_level,$time_field);
    }
    //邀请单位查询
    public function byInviteUnitSelectLecture(Request $request){
        $table_name           = SearchMessageConfig::LECTURE_TABLE;
        $time_field           = SearchMessageConfig::LE_TIME;
        $le_invite_unit_field = SearchMessageConfig::LECTURE_LE_INVITE_UNIT;
        $le_invite_unit       = $request->le_invite_unit;
        return ModelDatabase::byNameSelectDatas($table_name,$le_invite_unit_field,$le_invite_unit,$time_field);
    }
    //邀请时间查询
    public function byInviteTimeSelectLecture(Request $request){
        $table_name = SearchMessageConfig::LECTURE_TABLE;
        $time_field = SearchMessageConfig::LE_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }

    /**
     * 校发文件检索
     */
    //查询全部校发文件信息
    public function leaderSelectAllSchoolfile(){
        $table_name = SearchMessageConfig::SCHOOL_FILE_TABLE;
        $time_field = SearchMessageConfig::SCHFILE_DOWN_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //校发文件名称查询
    public function byNameSelectSchoofile(Request $request){
        $table_name         = SearchMessageConfig::SCHOOL_FILE_TABLE;
        $time_field         = SearchMessageConfig::SCHFILE_DOWN_TIME;
        $schfile_name_field = SearchMessageConfig::SCHOOLFILE_SCHFILE_NAME;
        $schfile_name       = $request->schfile_name;
        return ModelDatabase::byNameSelectDatas($table_name,$schfile_name_field,$schfile_name,$time_field);
    }
    //校发时间查询
    public function byTimeSelectSchoofile(Request $request){
        $table_name = SearchMessageConfig::SCHOOL_FILE_TABLE;
        $time_field = SearchMessageConfig::SCHFILE_DOWN_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }

    /**
     * 合作协议检索
     */
    //查询全部合作协议信息
    public function leaderSelectAllAgreement(){
        $table_name = SearchMessageConfig::AGREEMENT_TABLE;
        $time_field = SearchMessageConfig::AGREE_TIME;
        return ModelDatabase::selectAllDatas($table_name,$time_field);
    }
    //合作协议名称查询
    public function byNameSelectAgreement(Request $request){
        $table_name       = SearchMessageConfig::AGREEMENT_TABLE;
        $time_field       = SearchMessageConfig::AGREE_TIME;
        $agree_name_filed = SearchMessageConfig::AGREEMENT_AGREE_NAME;
        $agree_name       = $request->agree_name;
        return ModelDatabase::byNameSelectDatas($table_name,$agree_name_filed,$agree_name,$time_field);
    }
    //协议时间查询
    public function byTimeSelectAgreement(Request $request){
        $table_name = SearchMessageConfig::AGREEMENT_TABLE;
        $time_field = SearchMessageConfig::AGREE_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }

    /**
     *担任学术团体职务
     */
    //查询全部担任团体职务信息
    public function leaderSelectAllDuties(){
        $table_name = SearchMessageConfig::DUTIES_TABLE;
        return ModelDatabase::selectAllDatas($table_name,'');
    }
    //担任学术团体名称查询
    public function byNameSelectDuties(Request $request){
        $table_name    = SearchMessageConfig::DUTIES_TABLE;
        $du_name_field = SearchMessageConfig::DUTIES_DU_NAME;
        $du_name       = $request->du_name;
        return ModelDatabase::byNameSelectDatas($table_name,$du_name_field,$du_name,'');
    }
    //根据老师名字查询
    public function byTeacherNameSelectDuties(Request $request){
        $table_name         = SearchMessageConfig::DUTIES_TABLE;
        $teacher_name_field = SearchMessageConfig::DUTIES_TEACHER_NAME;
        $teacher_name       = $request->teacher_name;
        return ModelDatabase::byNameSelectDatas($table_name,$teacher_name_field,$teacher_name,'');
    }


    /**
     * 查询饼图数据
     */

    /**
     * 老师饼图数据
     */
    //按老师学历分组查询
    public function groupByTeacherEducation(){
        $table_name  = SearchMessageConfig::TEACHER_TABLE;
        $group_field = SearchMessageConfig::TEACHER_MOST_ACADEMIC;
        return ModelDatabase::groupByAndCountDatas($table_name,$group_field);
    }
    //按老师职称分组查询
    public function groupByTeacherTechnicalTitle(){
        $table_name  = SearchMessageConfig::TEACHER_TABLE;
        $group_field = SearchMessageConfig::TEACHER_ACADEMIC_TITLE;
        return ModelDatabase::groupByAndCountDatas($table_name,$group_field);
    }
    //按老师学缘分组查询
    public function groupByTeacherAcademicMargin(){
        $table_name  = SearchMessageConfig::TEACHER_TABLE;
        $group_field = SearchMessageConfig::TEACHER_EDU_SCHOOL;
        return ModelDatabase::groupByAndCountDatas($table_name,$group_field);
    }

    /**
     * 论文饼图数据
     */
    //期刊级别查询
    public function groupByArticalJournalLevel(Request $request){
        $table_name = SearchMessageConfig::ARTICAL_TABLE;
        $group_field = SearchMessageConfig::ARTICAL_PERCAL_CATE;
        return ModelDatabase::groupByAndCountDatas($table_name,$group_field);
    }

    /**
     * 项目饼图数据
     */
    //项目学科门类查询
    public function groupByProjectCertificateLevel(Request $request){
         $table_name = SearchMessageConfig::PROJECT_TABLE;
         $group_field = SearchMessageConfig::PROJECT_PRO_SUB_CATEGORY;
         return ModelDatabase::groupByAndCountDatas($table_name,$group_field);
    }

    /**
     * 著作饼图数据
     */
    //著作类别查询
    public function gropuByOpusCategory(Request $request){
         $table_name  = SearchMessageConfig::OPUS_TABLE;
         $group_field = SearchMessageConfig::OPUS_OP_CATE_WORK;
         return ModelDatabase::groupByAndCountDatas($table_name,$group_field);
    }

    /**
     * 获奖饼图数据
     */
    //获奖级别查询
    public function groupBywinLevel(Request $request){
         $table_name  = SearchMessageConfig::AWARD_TABLE;
         $group_field = SearchMessageConfig::AWARD_AW_LEVEL;
         return ModelDatabase::groupByAndCountDatas($table_name,$group_field);
    }
}