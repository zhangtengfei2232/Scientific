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
     * 论文检索
     */
    //根据论文作者模糊查询
    public function byAuthorSelectArtical(Request $request){
        $table_name       = SearchMessageConfig::ARTICAL_TABLE;
        $time_field       = SearchMessageConfig::ART_TIME;
        $art_author_field = SearchMessageConfig::ARTICAL_AUTHOR;
        $art_author       = $request->author;
        return ModelDatabase::byNameSelectDatas($table_name,$art_author_field,$art_author,$time_field);
    }
    //发表刊物名称
    public function byDatelineSelectArtical(Request $request){
        $table_name = SearchMessageConfig::ARTICAL_TABLE;
        $time_field = SearchMessageConfig::ART_TIME;
        $publication_name_field = SearchMessageConfig::ARTICAL_PUBLICATION_NAME;
        $publication_name       = $request->publication_name;
        return ModelDatabase::byNameSelectDatas($table_name,$publication_name_field,$publication_name,$time_field);
    }
    //发表日期
    public function byPeriodicalSelectArtical(Request $request){
        $table_name = SearchMessageConfig::ARTICAL_TABLE;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $field      = SearchMessageConfig::ART_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$field);
    }
    //刊物级别
    public function byJournalLevelSelectArtical(Request $request){
        $journal_level       = $request->percal_cate;
        $time_field          = SearchMessageConfig::ART_TIME;
        $table_name          = SearchMessageConfig::ARTICAL_TABLE;
        $journal_level_field = SearchMessageConfig::ARTICAL_PERCAL_CATE;
        return ModelDatabase::categorySelectInformation($table_name,$journal_level_field,$journal_level,$time_field);
    }
    //所属项目
    public function byBelongProjectSelectArtical(Request $request){
        $belong_project       = $request->belong_project;
        $time_field           = SearchMessageConfig::ART_TIME;
        $table_name           = SearchMessageConfig::ARTICAL_TABLE;
        $belong_project_field = SearchMessageConfig::ARTICAL_BELONG_PROJECT;
        return ModelDatabase::byNameSelectDatas($table_name,$belong_project_field,$belong_project,$time_field);
    }
    //学科门类
    public function bySubjectCategorySelectArtical(Request $request){
        $table_name             = SearchMessageConfig::ARTICAL_TABLE;
        $time_field             = SearchMessageConfig::ART_TIME;
        $subject_category_field = SearchMessageConfig::ARTICAL_ART_SUB_CATEGORY;
        $subject_category       = $request->art_sub_category;
        return ModelDatabase::categorySelectInformation($table_name,$subject_category_field,$subject_category,$time_field);
    }
    //研究类别
    public function byCategoryResearchSelectArtical(Request $request){
        $table_name              = SearchMessageConfig::ARTICAL_TABLE;
        $time_field              = SearchMessageConfig::ART_TIME;
        $category_research_field = SearchMessageConfig::ARTICAL_ART_CATE_RESEARCH;
        $category_research       = $request->category_research;
        return ModelDatabase::categorySelectInformation($table_name,$category_research_field,$category_research,$time_field);
    }
    //学校认定刊物级别
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
    //主持人
    public function byHostSelectProject(Request $request){
        $table_name     = SearchMessageConfig::PROJECT_TABLE;
        $time_field     = SearchMessageConfig::PROJECT_YEAR;
        $pro_host_field = SearchMessageConfig::PROJECT_PRO_HOST;
        $pro_host       = $request->pro_host;
        return ModelDatabase::byNameSelectDatas($table_name,$time_field,$pro_host_field,$pro_host);
    }
    //项目年份
    public function byYearSelectProject(Request $request){
        $table_name = SearchMessageConfig::PROJECT_TABLE;
        $time_field = SearchMessageConfig::PROJECT_YEAR;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //项目类别
    public function byCategorySelectProject(Request $request){
        $table_name = SearchMessageConfig::PROJECT_TABLE;
        $time_field = SearchMessageConfig::PROJECT_YEAR;
        $project_category_field = SearchMessageConfig::PROJECT_PROJECT_CATEGORY;
        $project_category       = $request->project_category;
        return ModelDatabase::categorySelectInformation($table_name,$project_category_field,$project_category,$time_field);
    }
    //批准单位
    public function byApprovalUnitSelectProject(Request $request){
        $table_name = SearchMessageConfig::PROJECT_TABLE;
        $time_field = SearchMessageConfig::PROJECT_YEAR;
        $approval_unit_field = SearchMessageConfig::PROJECT_APPROVAL_UNIT;
        $approval_unit       = $request->approval_unit;
        return ModelDatabase::byNameSelectDatas($table_name,$approval_unit_field,$approval_unit,$time_field);
    }
    //学科门类
    public function bySubjectCategorySelectProject(Request $request){
        $table_name = SearchMessageConfig::PROJECT_TABLE;
        $time_field = SearchMessageConfig::PROJECT_YEAR;
        $pro_sub_category_field = SearchMessageConfig::PROJECT_PRO_SUB_CATEGORY;
        $pro_sub_category       = $request->pro_sub_category;
        return ModelDatabase::categorySelectInformation($table_name,$pro_sub_category_field,$pro_sub_category,$time_field);
    }
    //项目研究类别
    public function byCategoryResearchSelectProject(Request $request){
        $table_name = SearchMessageConfig::PROJECT_TABLE;
        $time_field = SearchMessageConfig::PROJECT_YEAR;
        $pro_cate_research_field = SearchMessageConfig::PROJECT_PRO_CATE_RESEARCH;
        $pro_cate_research       = $request->pro_cate_research;
        return ModelDatabase::categorySelectInformation($table_name,$pro_cate_research_field,$pro_cate_research,$time_field);
    }

    /**
     * 著作检索
     */
    //著作名称
    public function byNameSelectOpus(Request $request){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_name_field = SearchMessageConfig::OPUS_OP_NAME;
        $op_name       = $request->op_name;
        return ModelDatabase::byNameSelectDatas($table_name,$op_name_field,$op_name,$time_field);
    }
    //第一作者
    public function byAuthorSelectOpus(Request $request){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_first_author_field = SearchMessageConfig::OPUS_OP_FIRST_AUTHOR;
        $op_first_author       = $request->op_first_author;
        return ModelDatabase::byNameSelectDatas($table_name,$op_first_author_field,$op_first_author,$time_field);
    }
    //著作类别
    public function byCategorySelectOpus(Request $request){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_cate_work_field = SearchMessageConfig::OPUS_OP_CATE_WORK;
        $op_cate_work       = $request->op_cate_work;
        return ModelDatabase::categorySelectInformation($table_name,$op_cate_work_field,$op_cate_work,$time_field);
    }
    //编著形式
    public function byFormWritingSelectOpus(Request $request){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_form_write_field = SearchMessageConfig::OPUS_OP_FORM_WRITE;
        $op_form_write       = $request->op_form_write;
        return ModelDatabase::categorySelectInformation($table_name,$op_form_write_field,$op_form_write,$time_field);
    }
    //学科门类
    public function bySubjectCategorySelectOpus(Request $request){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_sub_category_field = SearchMessageConfig::OPUS_OP_SUB_CATEGORY;
        $op_sub_category       = $request->op_sub_category;
        return ModelDatabase::categorySelectInformation($table_name,$op_sub_category_field,$op_sub_category,$time_field);
    }
    //出版日期
    public function byPublicationDateSelectOpus(Request $request){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //研究类别
    public function byCategoryResearchSelectOpus(Request $request){
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        $op_cate_research_field = SearchMessageConfig::OPUS_OP_CATE_RESEARCH;
        $op_cate_research       = $request->op_cate_research;
        return ModelDatabase::categorySelectInformation($table_name,$op_cate_research_field,$op_cate_research,$time_field);
    }

    /**
     * 获奖检索
     */
    //第一获奖人
    public function byFirstWinnerSelectAward(Request $request){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        $aw_first_author_field = SearchMessageConfig::AWARD_AW_FIRST_AUTHOR;
        $aw_first_author       = $request->aw_first_author;
        return ModelDatabase::byNameSelectDatas($table_name,$aw_first_author_field,$aw_first_author,$time_field);
    }
    //奖励名称
    public function byNameSelectAward(Request $request){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        $award_name_field = SearchMessageConfig::AWARD_AWARD_NAME;
        $award_name       = $request->award_name;
        return ModelDatabase::byNameSelectDatas($table_name,$award_name_field,$award_name,$time_field);
    }
    //授奖单位
    public function byAwardingUnitSelectAward(Request $request){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        $aw_grant_unit_field = SearchMessageConfig::AWARD_AW_GRANT_UNIT;
        $aw_grant_unit       = $request->aw_grant_unit;
        return ModelDatabase::byNameSelectDatas($table_name,$aw_grant_unit_field,$aw_grant_unit,$time_field);
    }
    //授予时间
    public function byAwardTimeSelectAward(Request $request){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //获奖成果名称
    public function byResultsNameSelectAward(Request $request){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        $prize_win_name_field = SearchMessageConfig::AWARD_PRIZE_WIN_NAME;
        $prize_win_name       = $request->prize_win_name;
        return ModelDatabase::byNameSelectDatas($table_name,$prize_win_name_field,$prize_win_name,$time_field);
    }
    //获奖级别
    public function byWinnerGradeSelectAward(Request $request){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        $aw_level_field = SearchMessageConfig::AWARD_AW_LEVEL;
        $aw_level       = $request->aw_level;
        return ModelDatabase::categorySelectInformation($table_name,$aw_level_field,$aw_level,$time_field);
    }
    //我校名次
    public function bySchoolRankSelectAward(Request $request){
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        $aw_sch_rank_field = SearchMessageConfig::AWARD_AW_SCH_RANK;
        $aw_sch_rank       = $request->aw_sch_rank;
        return ModelDatabase::categorySelectInformation($table_name,$aw_sch_rank_field,$aw_sch_rank,$time_field);
    }

    /**
     * 专利检索
     */
    //第一发明人
    public function byFirstInventorSelectPatent(Request $request){
        $table_name = SearchMessageConfig::PATENT_TABLE;
        $time_field = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $first_inventor_field = SearchMessageConfig::PATEN_FIRST_INVENTOR;
        $first_inventor       = $request->first_inventor;
        return ModelDatabase::byNameSelectDatas($table_name,$first_inventor_field,$first_inventor,$time_field);
    }
    //专利类型
    public function byTypeSelectPatent(Request $request){
        $table_name = SearchMessageConfig::PATENT_TABLE;
        $time_field = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $pa_type_field = SearchMessageConfig::PATENT_PA_TYPE;
        $pa_type       = $request->pa_type;
        return ModelDatabase::categorySelectInformation($table_name,$pa_type_field,$pa_type,$time_field);
    }
    //实施情况
    public function byImplementStatusSelectPatent(Request $request){
        $table_name = SearchMessageConfig::PATENT_TABLE;
        $time_field = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $pa_imple_situ_field = SearchMessageConfig::PATENT_PA_IMPLE_SITU;
        $pa_imple_situ       = $request->pa_imple_situ;
        return ModelDatabase::categorySelectInformation($table_name,$pa_imple_situ_field,$pa_imple_situ,$time_field);
    }
    //受理日
    public function byAdmissibilityDaySelectPatent(Request $request){
        $table_name = SearchMessageConfig::PATENT_TABLE;
        $time_field = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //专利名称
    public function byNameSelectPatent(Request $request){
        $table_name = SearchMessageConfig::PATENT_TABLE;
        $time_field = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        $pa_name_field = SearchMessageConfig::PATENT_PA_NAME;
        $pa_name       = $request->pa_name;
        return ModelDatabase::byNameSelectDatas($table_name,$pa_name_field,$pa_name,$time_field);
    }

    /**
     * 成果鉴定检索
     */
    //主持人
    public function byHostSelectAppraisal(Request $request){
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
        

    }
    //鉴定成果名称
    public function byNameSelectAppraisal(Request $request){
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
    }
    //鉴定形式
    public function byFormSelectAppraisal(Request $request){
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
    }
    //鉴定结论
    public function byConclusionSelectAppraisal(Request $request){
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
    }
    //鉴定时间
    public function byTimeSelectAppraisal(Request $request){
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
    }
    //鉴定级别
    public function byLevelSelectAppraisal(Request $request){
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
    }

    /**
     * 举办会议检索
     */
    //举办会议名称
    public function byNameSelectHoldmeet(Request $request){

    }
    //举办会议级别
    public function byLevelSelectHoldmeet(Request $request){

    }
    //举办会议时间
    public function byTimeSelectHoldmeet(Request $request){

    }

    /**
     * 参加会议检索
     */
    //参加会议名称
    public function byNameSelectJoinmeet(Request $request){

    }
    //参加会议级别
    public function byLevelSelectJoinmeet(Request $request){

    }
    //参加会议时间
    public function byTimeSelectJoinmeet(Request $request){

    }

    /**
     * 专家讲学检索
     */
    //专家名称
    public function byNameSelectLecture(Request $request){

    }
    //专家级别
    public function byLevelSelectLecture(Request $request){

    }
    //邀请单位
    public function byInvitingUnitSelectLecture(Request $request){

    }
    //邀请时间
    public function byInvitingTimeSelectLecture(Request $request){

    }

    /**
     * 校发文件检索
     */
    //校发文件名称
    public function byNameSelectSchoofile(Request $request){

    }
    //校发时间
    public function byTimeSelectSchoofile(Request $request){

    }

    /**
     * 合作协议检索
     */
    //合作协议名称
    public function byNameSelectAgreement(Request $request){

    }
    //协议时间
    public function byTimeSelectAgreement(Request $request){

    }

    /**
     *担任学术团体职务
     */
    //担任学术团体名称
    public function byNameSelectDuties(Request $request){

    }

    /**
     * 查询饼图数据
     */

    /**
     * 老师饼图数据
     */
    //按老师学历分组查询
    public function groupByTeacherEducation(Request $request){

    }
    //按老师学历分组查询
    public function groupByTeacherTechnicalTitle(Request $request){

    }
    //按老师学缘分组查询
    public function groupByTeacherAcademicMargin(Request $request){

    }

    /**
     * 论文饼图数据
     */
    //期刊级别
    public function groupByArticalJournalLevel(Request $request){

    }

    /**
     * 项目饼图数据
     */
    //项目证书级别
    public function groupByProjectCertificateLevel(Request $request){

    }

    /**
     * 著作饼图数据
     */
    //著作类别
    public function gropuByOpusCategory(Request $request){

    }

    /**
     * 获奖饼图数据
     */
    //获奖级别
    public function groupBywinningLevel(Request $request){

    }
}