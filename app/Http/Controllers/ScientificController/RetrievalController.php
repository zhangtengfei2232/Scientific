<?php
namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use config\SearchMessageConfig;
use Illuminate\Http\Request;
class RetrievalController extends Controller
{
    private $teacher_table_name   = SearchMessageConfig::TEACHER_TABLE;
    private $artical_table_name   = SearchMessageConfig::ARTICAL_TABLE;
    private $project_table_name   = SearchMessageConfig::PROJECT_TABLE;
    private $award_table_name     = SearchMessageConfig::AWARD_TABLE;
    private $opus_table_name      = SearchMessageConfig::OPUS_TABLE;
    private $patent_table_name    = SearchMessageConfig::PATENT_TABLE;
    private $appraisal_table_name = SearchMessageConfig::APPRAISAL_TABLE;
    private $holdmeet_table_name  = SearchMessageConfig::HOLD_MEET_TABLE;
    private $joinmeet_tale_name   = SearchMessageConfig::JOIN_MEET_TABLE;
    private $lecture_table_name   = SearchMessageConfig::LECTURE_TABLE;
    private $schfile_table_name   = SearchMessageConfig::SCHOOL_FILE_TABLE;
    private $agreement_table_name = SearchMessageConfig::AGREEMENT_TABLE;
    private $duties_table_name    = SearchMessageConfig::DUTIES_TABLE;
    private $artical_time_field   = SearchMessageConfig::ART_TIME;
    private $project_time_field   = SearchMessageConfig::PROJECT_YEAR;
    private $opus_time_field      = SearchMessageConfig::OP_PUBLISH_TIME;
    private $award_time_field     = SearchMessageConfig::AW_GRANT_TIME;
    private $patent_time_field    = SearchMessageConfig::AUTHOR_NOTIC_DAY;
    private $appraisal_time_field = SearchMessageConfig::AP_TIME;
    private $holdmeet_time_field  = SearchMessageConfig::HO_TIME;
    private $joinmeet_time_field  = SearchMessageConfig::JO_TIME;
    private $lecture_time_field   = SearchMessageConfig::LE_TIME;
    private $schfile_time_field   = SearchMessageConfig::SCHFILE_DOWN_TIME;
    private $agreement_time_field = SearchMessageConfig::AGREE_TIME;
    private $total = 10;
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
    public function leaderSelectAllTeacher(Request $request){
        if($request->has(''))
        return ModelDatabase::selectAllteacherDatas();
    }
    //老师名字查询老师信息
    public function byNameSelectTeacher(Request $request){
        $teacher_name = $request->teacher_name;
        if(empty($teacher_name)) {
            return responseTojson(1,'你输入的老师名字不能为空');
        }
        $name_field   = SearchMessageConfig::TEACHER_NAME;
        return ModelDatabase::byNameSelectDatas($this->teacher_table_name,$name_field,$teacher_name,'');
    }
    //老师职称查询
    public function byAcademicTitleSelectTeacher(Request $request){
        $academic_title_field = SearchMessageConfig::TEACHER_ACADEMIC_TITLE;
        $academic_title       = $request->academic_title;
        return ModelDatabase::categorySelectInformation($this->teacher_table_name,$academic_title_field,$academic_title,'');
    }
    //老师行政职务查询
    public function byAdminDutiesSelectTeacher(Request $request){
        $admin_duties = $request->admin_duties;
        if(empty($admin_duties)) {
            return responseTojson(1,'你输入的老师行政职务不能为空');
        }
        $admin_duties_field = SearchMessageConfig::TEACHER_ADMIN_DUTIES;
        return ModelDatabase::byNameSelectDatas($this->teacher_table_name,$admin_duties_field,$admin_duties,'');
    }
    //老师所属教研室和实验室查询
    public function byTeachResearchSelectTeacher(Request $request){
        $te_re_department = $request->te_re_department;
        if(empty($te_re_department)) {
            return responseTojson(1,'你输入的老师所属教研室和实验室不能为空');
        }
        $te_re_department_field = SearchMessageConfig::TEACHER_TE_RE_DEPARTMENT;
        return ModelDatabase::byNameSelectDatas($this->teacher_table_name,$te_re_department_field,$te_re_department,'');
    }
    //老师岗位类别查询
    public function byPostCategorySelectTeacher(Request $request){
        $post_category_field = SearchMessageConfig::TEACHER_POST_CATEGORY;
        $post_category       = $request->post_category;
        return ModelDatabase::categorySelectInformation($this->teacher_table_name,$post_category_field,$post_category,'');
    }
    //老师职务级别查询
    public function byJobLevelSelectTeacher(Request $request){
        $job_level_field = SearchMessageConfig::TEACHER_JOB_LEVEL;
        $job_level       = $request->job_level;
        return ModelDatabase::categorySelectInformation($this->teacher_table_name,$job_level_field,$job_level,'');
    }
    //老师从事专业查询
    public function byWorkMajorSelectTeacher(Request $request){
        $work_major = $request->work_major;
        if(empty($work_major)) {
            return responseTojson(1,'你输入的老师从事专业不能为空');
        }
        $work_major_filed = SearchMessageConfig::TEACHER_WORK_MAJOR;
        return ModelDatabase::byNameSelectDatas($this->teacher_table_name,$work_major_filed,$work_major,'');
    }

    /**
     * 论文检索
     */
    //根据多个条件，组合查询文章信息
    public function combinationSelectArtical(Request $request){
        $condition_datas = [
            'table_name'  => $this->artical_table_name,
            'time_field'  => $this->artical_time_field,
            'first_field' => SearchMessageConfig::ARTICAL_PERCAL_CATE,            //文章刊物级别字段
            'first_datas' => $request->percal_cate_datas,
            'total'       => 10
        ];
        if($request->has('total')){
            $condition_datas['total'] = $request->total;
        }
        $art_cate_research_field = SearchMessageConfig::ARTICAL_ART_CATE_RESEARCH;//文章研究类别字段
        $cate_research_datas     = $request->cate_research_datas;
        return ModelDatabase::combinationSelectDatas($condition_datas,$art_cate_research_field,$cate_research_datas);
    }
    public function leaderSelectAllArtical(){
        return ModelDatabase::selectAllDatas($this->artical_table_name,$this->artical_time_field);
    }
    //根据论文作者模糊查询
    public function byAuthorSelectArtical(Request $request){
        $datas['total']  = $this->total;
        $datas['value']  = $request->value;
        if($request->has('total')){
            $datas['total'] = $request->total;
        }
        $datas['table_name'] = $this->artical_table_name;
        $datas['time_field'] = $this->artical_time_field;
        $art_field = $request->type;
        $art_author_field      = SearchMessageConfig::ARTICAL_AUTHOR;
        $sch_percal_cate_field = SearchMessageConfig::ARTICAL_SCH_PERCAL_CATE;
        switch ($art_field){
            case $art_author_field:
                $datas['field'] = $art_author_field;
                break;
            case $sch_percal_cate_field:
                $datas['field'] = $sch_percal_cate_field;
                break;
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    //发表刊物名称查询
//    public function byDatelineSelectArtical(Request $request){
//        $publication_name = $request->publication_name;
//        if(empty($publication_name)) {
//            return responseTojson(1,'你输入的论文作者不能为空');
//        }

//        return ModelDatabase::byNameSelectDatas($this->artical_table_name,$publication_name_field,$publication_name,$this->artical_time_field);
//    }
    //发表日期查询
    public function byPeriodicalSelectArtical(Request $request){
        $total = $this->total;
        if($request->has('total')){
            $total = $request->total;
        }
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$this->artical_table_name,$this->artical_time_field,$total);
    }
//    //刊物级别查询
//    public function byJournalLevelSelectArtical(Request $request){
//        $journal_level       = $request->percal_cate;
//        $journal_level_field = SearchMessageConfig::ARTICAL_PERCAL_CATE;
//        return ModelDatabase::categorySelectInformation($this->artical_table_name,$journal_level_field,$journal_level,$this->artical_time_field);
//    }
//    //所属项目查询
//    public function byBelongProjectSelectArtical(Request $request){
//        $belong_project       = $request->belong_project;
//        $belong_project_field = SearchMessageConfig::ARTICAL_BELONG_PROJECT;
//        return ModelDatabase::byNameSelectDatas($this->artical_table_name,$belong_project_field,$belong_project,$this->artical_time_field);
//    }
//    //学科门类查询
//    public function bySubjectCategorySelectArtical(Request $request){
//        $subject_category_field = SearchMessageConfig::ARTICAL_ART_SUB_CATEGORY;
//        $subject_category       = $request->art_sub_category;
//        return ModelDatabase::categorySelectInformation($this->artical_table_name,$subject_category_field,$subject_category,$this->artical_time_field);
//    }
//    //研究类别查询
//    public function byCategoryResearchSelectArtical(Request $request){
//        $category_research_field = SearchMessageConfig::ARTICAL_ART_CATE_RESEARCH;
//        $category_research       = $request->category_research;
//        return ModelDatabase::categorySelectInformation($this->artical_table_name,$category_research_field,$category_research,$this->artical_time_field);
//    }
    //学校认定刊物级别查询
    public function bySchoolaffirmLevelSelectArtical(Request $request){
        $sch_percal_cate = $request->sch_percal_cate;
        if(empty($sch_percal_cate)) {
            return responseTojson(1,'你输入的学校认定刊物级别不能为空');
        }
        $sch_percal_cate_field = SearchMessageConfig::ARTICAL_SCH_PERCAL_CATE;
        return ModelDatabase::byNameSelectDatas($this->artical_table_name,$sch_percal_cate_field,$sch_percal_cate,$this->artical_time_field);
    }

    /**
     * 项目检索
     */
    //根据多个条件，组合查询文章信息
    public function combinationSelectProject(Request $request){
        $condition_datas = [
            'table_name'  => $this->project_table_name,
            'time_field'  => $this->project_time_field,
            'first_field' => SearchMessageConfig::PROJECT_PRO_SUB_CATEGORY,  //文章刊物级别字段
            'first_datas' => $request->pro_sub_category_datas
        ];
        return ModelDatabase::combinationSelectDatas($condition_datas);
    }
    //查询全部项目信息
    public function leaderSelectAllProject(){
        return ModelDatabase::selectAllDatas($this->project_table_name,$this->project_time_field);
    }
    //主持人查询
    public function byHostSelectProject(Request $request){
        $pro_host = $request->pro_host;
        if(empty($pro_host)){
            return responseTojson(1,'你输入的主持人名字为空');
        }
        $pro_host_field = SearchMessageConfig::PROJECT_PRO_HOST;
        return ModelDatabase::byNameSelectDatas($this->project_table_name,$this->project_time_field,$pro_host_field,$pro_host);
    }
    //项目年份查询
    public function byYearSelectProject(Request $request){
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$this->project_table_name,$this->project_time_field);
    }
    //项目类别查询
    public function byCategorySelectProject(Request $request){
        $project_category       = $request->project_category;
        if(empty($project_category)){
            return responseTojson(1,'你输入的项目类别的名称不能为空');
        }
        $project_category_field = SearchMessageConfig::PROJECT_PROJECT_CATEGORY;
        return ModelDatabase::categorySelectInformation($this->project_table_name,$project_category_field,$project_category,$this->project_time_field);
    }
    //批准单位查询
    public function byApprovalUnitSelectProject(Request $request){
        $approval_unit       = $request->approval_unit;
        if(empty($approval_unit)){
            return responseTojson(1,'你输入的批准单位名称不能为空');
        }
        $approval_unit_field = SearchMessageConfig::PROJECT_APPROVAL_UNIT;
        return ModelDatabase::byNameSelectDatas($this->project_table_name,$approval_unit_field,$approval_unit,$this->project_time_field);
    }
    //学科门类查询
    public function bySubjectCategorySelectProject(Request $request){
        $pro_sub_category_field = SearchMessageConfig::PROJECT_PRO_SUB_CATEGORY;
        $pro_sub_category       = $request->pro_sub_category;
        return ModelDatabase::categorySelectInformation($this->project_table_name,$pro_sub_category_field,$pro_sub_category,$this->project_time_field);
    }
    //项目研究类别查询
    public function byCategoryResearchSelectProject(Request $request){
        $pro_cate_research_field = SearchMessageConfig::PROJECT_PRO_CATE_RESEARCH;
        $pro_cate_research       = $request->pro_cate_research;
        return ModelDatabase::categorySelectInformation($this->project_table_name,$pro_cate_research_field,$pro_cate_research,$this->project_time_field);
    }
    /**
     * 著作检索
     */
    //根据多个条件，组合查询文章信息
    public function combinationSelectOpus(Request $request){
//        $op_cate_research_datas = [];
//        $op_form_write_datas    = [];
        $condition_datas = [
            'table_name'  => $this->opus_table_name,
            'time_field'  => $this->opus_time_field,
            'first_field' => SearchMessageConfig::OPUS_OP_CATE_WORK,               //著作类别字段
            'first_datas' => $request->op_cate_work_datas
        ];
        $op_cate_research_field = SearchMessageConfig::OPUS_OP_CATE_RESEARCH;      //著作研究类别字段
        $op_cate_research_datas = $request->op_cate_research_datas;
        $op_form_write_field    = SearchMessageConfig::OPUS_OP_FORM_WRITE;         //著作编著形式
        $op_form_write_datas    = $request->op_form_write_datas;
        return ModelDatabase::combinationSelectDatas($condition_datas,$op_cate_research_field,$op_cate_research_datas,$op_form_write_field,$op_form_write_datas);
    }
    //查询全部著作信息
    public function leaderSelecttAllOpus(){
        return ModelDatabase::selectAllDatas($this->opus_table_name,$this->opus_time_field);
    }
    //著作名称查询
    public function byNameSelectOpus(Request $request){
        $op_name = $request->op_name;
        if(empty($op_name)){
            return responseTojson(1,'你输入的著作名称不能为空');
        }
        $op_name_field = SearchMessageConfig::OPUS_OP_NAME;
        return ModelDatabase::byNameSelectDatas($this->opus_table_name,$op_name_field,$op_name,$this->opus_time_field);
    }
    //第一作者查询
    public function byAuthorSelectOpus(Request $request){
        $op_first_author       = $request->op_first_author;
        if(empty($op_first_author)){
            return responseTojson(1,'你输入的第一作者不能为空');
        }
        $op_first_author_field = SearchMessageConfig::OPUS_OP_FIRST_AUTHOR;
        return ModelDatabase::byNameSelectDatas($this->opus_table_name,$op_first_author_field,$op_first_author,$this->opus_time_field);
    }
    //著作类别查询
    public function byCategorySelectOpus(Request $request){
        $op_cate_work_field = SearchMessageConfig::OPUS_OP_CATE_WORK;
        $op_cate_work       = $request->op_cate_work;
        return ModelDatabase::categorySelectInformation($this->opus_table_name,$op_cate_work_field,$op_cate_work,$this->opus_time_field);
    }
    //编著形式查询
    public function byFormWritingSelectOpus(Request $request){
        $op_form_write_field = SearchMessageConfig::OPUS_OP_FORM_WRITE;
        $op_form_write       = $request->op_form_write;
        return ModelDatabase::categorySelectInformation($this->opus_table_name,$op_form_write_field,$op_form_write,$this->opus_time_field);
    }
    //学科门类查询
    public function bySubjectCategorySelectOpus(Request $request){
        $op_sub_category_field = SearchMessageConfig::OPUS_OP_SUB_CATEGORY;
        $op_sub_category       = $request->op_sub_category;
        return ModelDatabase::categorySelectInformation($this->opus_table_name,$op_sub_category_field,$op_sub_category,$this->opus_time_field);
    }
    //出版日期查询
    public function byPublicationDateSelectOpus(Request $request){
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$this->opus_table_name,$this->opus_time_field);
    }
    //研究类别查询
    public function byCategoryResearchSelectOpus(Request $request){
        $op_cate_research_field = SearchMessageConfig::OPUS_OP_CATE_RESEARCH;
        $op_cate_research       = $request->op_cate_research;
        return ModelDatabase::categorySelectInformation($this->opus_table_name,$op_cate_research_field,$op_cate_research,$this->opus_time_field);
    }

    /**
     * 获奖检索
     */
    //根据多个条件，组合查询获奖信息
    public function combinationSelectAward(Request $request){
        $condition_datas = [
            'table_name'  => $this->award_table_name,
            'time_field'  => $this->award_time_field,
            'first_field' => SearchMessageConfig::AWARD_AW_LEVEL,  //文章刊物级别字段
            'first_datas' => $request->aw_level_datas
        ];
        return ModelDatabase::combinationSelectDatas($condition_datas);
    }
    //查询全部获奖信息
    public function leaderSelectAllAward(){
        return ModelDatabase::selectAllDatas($this->award_table_name,$this->award_time_field);
    }
    //第一获奖人查询
    public function byFirstWinnerSelectAward(Request $request){
        $aw_first_author = $request->aw_first_author;
        if(empty($aw_first_author)){
            return responseTojson(1,'你输入的第一获奖人不能为空');
        }
        $aw_first_author_field = SearchMessageConfig::AWARD_AW_FIRST_AUTHOR;
        return ModelDatabase::byNameSelectDatas($this->award_table_name,$aw_first_author_field,$aw_first_author,$this->award_time_field);
    }
    //奖励名称查询
    public function byNameSelectAward(Request $request){
        $award_name = $request->award_name;
        if(empty($award_name)){
            return responseTojson(1,'你输入的奖励名称不能为空');
        }
        $award_name_field = SearchMessageConfig::AWARD_AWARD_NAME;
        return ModelDatabase::byNameSelectDatas($this->award_table_name,$award_name_field,$award_name,$this->award_time_field);
    }
    //授奖单位查询
    public function byAwardingUnitSelectAward(Request $request){
        $aw_grant_unit_field = SearchMessageConfig::AWARD_AW_GRANT_UNIT;
        $aw_grant_unit       = $request->aw_grant_unit;
        return ModelDatabase::byNameSelectDatas($this->award_table_name,$aw_grant_unit_field,$aw_grant_unit,$this->award_time_field);
    }
    //授予时间查询
    public function byAwardTimeSelectAward(Request $request){
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$this->award_table_name,$this->award_time_field);
    }
    //获奖成果名称查询
    public function byResultsNameSelectAward(Request $request){
        $prize_win_name_field = SearchMessageConfig::AWARD_PRIZE_WIN_NAME;
        $prize_win_name       = $request->prize_win_name;
        return ModelDatabase::byNameSelectDatas($this->award_table_name,$prize_win_name_field,$prize_win_name,$this->award_time_field);
    }
    //获奖级别查询
    public function byWinnerGradeSelectAward(Request $request){
        $aw_level_field = SearchMessageConfig::AWARD_AW_LEVEL;
        $aw_level       = $request->aw_level;
        return ModelDatabase::categorySelectInformation($this->award_table_name,$aw_level_field,$aw_level,$this->award_time_field);
    }
    //我校名次查询
    public function bySchoolRankSelectAward(Request $request){
        $aw_sch_rank_field = SearchMessageConfig::AWARD_AW_SCH_RANK;
        $aw_sch_rank       = $request->aw_sch_rank;
        return ModelDatabase::categorySelectInformation($this->award_table_name,$aw_sch_rank_field,$aw_sch_rank,$this->award_time_field);
    }

    /**
     * 专利检索
     */

    //专利名称查询
    public function byFieldSelectPatent(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = 10;
        $datas['table_name'] = $this->patent_table_name;
        $datas['time_field'] = $this->patent_time_field;
        $datas['value']      = $request->value;
        $pa_name_field = SearchMessageConfig::PATENT_PA_NAME;
        $first_inventor_field = SearchMessageConfig::PATEN_FIRST_INVENTOR;
        switch($request->type){
            case $pa_name_field:
                $datas['field'] = $pa_name_field;
                break;
            case $first_inventor_field:
                $datas['field'] = $first_inventor_field;
                break;
            case 'advanced_screening':
                $condition_datas = [
                    'table_name'  => $datas['table_name'],
                    'time_field'  => $datas['time_field'],
                    'first_field' => SearchMessageConfig::PATENT_PA_TYPE,                 //专利类型字段
                    'first_datas' => $request->pa_type_datas
                ];
                $pa_imple_situ_field = SearchMessageConfig::PATENT_PA_IMPLE_SITU;         //专利实施情况字段
                return ModelDatabase::combinationSelectDatas($condition_datas,$pa_imple_situ_field,$request->pa_imple_situ_datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default:
                return  ModelDatabase::selectAllDatas($datas['table_name'],$datas['time_field']);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }

    /**
     * 成果鉴定检索
     */
    //根据多个条件，组合查询文章信息
    public function combinationSelectAppraisal(Request $request){
        ($request->has('total')) ? $total = $request->total : $this->total;
        $condition_datas = [
            'table_name'  => $this->appraisal_table_name,
            'time_field'  => $this->appraisal_time_field,
            'first_field' => SearchMessageConfig::APPRAISAL_AP_LEVEL,  //文章刊物级别字段
            'first_datas' => $request->ap_level_datas,
            'total'       => $total
        ];
        return ModelDatabase::combinationSelectDatas($condition_datas);
    }
    //查询全部成果鉴定信息
    public function leaderSelectAllAppraisal(Request $request){
        ($request->has('total')) ? $total = $request->total : $this->total;
        return ModelDatabase::selectAllDatas($this->appraisal_table_name,$total,$this->appraisal_time_field);
    }
//    //主持人查询
//    public function byHostSelectAppraisal(Request $request){
//        $ap_first_author = $request->ap_first_author;
//        if(empty($ap_first_author)){
//             return responseTojson(1,'你输入的主持人不能为空');
//        }
//        $ap_first_author_field = SearchMessageConfig::APPRAISAL_AP_FIRST_AUTHOR;
//        return ModelDatabase::byNameSelectDatas($this->appraisal_table_name,$ap_first_author_field,$ap_first_author,$this->appraisal_time_field);
//    }
    //鉴定成果名称查询
    public function byNameSelectAppraisal(Request $request){
        ($request->has('total')) ? $data['total'] = $request->total : $this->total;
        $data['table_name']    = $this->appraisal_table_name;
        $data['time_field']    = $this->appraisal_time_field;
        $data['value']         = $request->value;
        $ap_form_field         = SearchMessageConfig::APPRAISAL_AP_FORM;
        $ap_first_author_field = SearchMessageConfig::APPRAISAL_AP_FIRST_AUTHOR;
        $ap_res_name_field     = SearchMessageConfig::APPRAISAL_AP_RES_NAME;
        switch($request->type){
            case $ap_res_name_field:
                $data['filed'] = $ap_res_name_field;
                break;
            case $ap_first_author_field:
                $data['field'] = $ap_first_author_field;
                break;
            case $ap_form_field:
                $data['field'] = $ap_form_field;
                break;
        }
        return ModelDatabase::pagingQueryDatas($data);
    }
//    //鉴定形式查询
//    public function byFormSelectAppraisal(Request $request){
//        $ap_form_field = SearchMessageConfig::APPRAISAL_AP_FORM;
//        $ap_form       = $request->ap_form;
//        return ModelDatabase::categorySelectInformation($this->appraisal_table_name,$ap_form_field,$ap_form,$this->appraisal_time_field);
//    }
//    //鉴定结论查询
//    public function byConclusionSelectAppraisal(Request $request){
//        $ap_conclusion_field = SearchMessageConfig::APPRAISAL_AP_CONCLUSION;
//        $ap_conclusion       = $request->ap_conclusion;
//        return ModelDatabase::byNameSelectDatas($this->appraisal_table_name,$ap_conclusion_field,$ap_conclusion,$this->appraisal_time_field);
//    }
    //鉴定时间查询
    public function byTimeSelectAppraisal(Request $request){
        ($request->has('total')) ? $total = $request->total : $this->total;
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$this->appraisal_table_name,$this->appraisal_time_field,$total);
    }
//    //鉴定级别查询
//    public function byLevelSelectAppraisal(Request $request){
//        $ap_level_field = SearchMessageConfig::APPRAISAL_AP_LEVEL;
//        $ap_level       = $request->ap_level;
//        return ModelDatabase::categorySelectInformation($this->appraisal_table_name,$ap_level_field,$ap_level,$this->appraisal_time_field);
//    }

    /**
     * 举办会议检索
     */
    //根据多个条件，组合查询文章信息
    public function combinationSelectHoldmeet(Request $request){
        $condition_datas = [
            'table_name'  => $this->holdmeet_table_name,
            'time_field'  => $this->holdmeet_time_field,
            'first_field' => SearchMessageConfig::HOLDMEET_HO_LEVEL,  //文章刊物级别字段
            'first_datas' => $request->ho_level_datas
        ];
        return ModelDatabase::combinationSelectDatas($condition_datas);
    }
    //查询全部举办会议信息
    public function leaderSelectAllHoldmeet(){
        return ModelDatabase::selectAllDatas($this->holdmeet_table_name,$this->holdmeet_time_field);
    }
    //举办会议名称查询
    public function byNameSelectHoldmeet(Request $request){
        $ho_name = $request->ho_name;
        if(empty($ho_name)){
            return responseTojson(1,'你输入的举办会议名称不能为空');
        }
        $ho_name_field = SearchMessageConfig::HOLDMEET_HO_NAME;
        return ModelDatabase::byNameSelectDatas($this->holdmeet_table_name,$ho_name_field,$ho_name,$this->holdmeet_time_field);
    }
    //举办会议级别查询
    public function byLevelSelectHoldmeet(Request $request){
        $ho_level_field = SearchMessageConfig::HOLDMEET_HO_LEVEL;
        $ho_level       = $request->ho_level;
        return ModelDatabase::categorySelectInformation($this->holdmeet_table_name,$ho_level_field,$ho_level,$this->holdmeet_time_field);
    }
    //举办会议时间查询
    public function byTimeSelectHoldmeet(Request $request){
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$this->holdmeet_table_name,$this->holdmeet_time_field);
    }

    /**
     * 参加会议检索
     */
    //根据多个条件，组合查询文章信息
    public function combinationSelectJoinmeet(Request $request){
        $condition_datas = [
            'table_name'  => $this->joinmeet_tale_name,
            'time_field'  => $this->joinmeet_time_field,
            'first_field' => SearchMessageConfig::JOINMEET_JO_LEVEL,  //文章刊物级别字段
            'first_datas' => $request->jo_level_datas
        ];
        return ModelDatabase::combinationSelectDatas($condition_datas);
    }
    //查询全部参加会议信息
    public function leaderSelectAllJoinmeet(){
        return ModelDatabase::selectAllDatas($this->joinmeet_tale_name,$this->joinmeet_time_field);
    }
    //参加会议名称查询
    public function byNameSelectJoinmeet(Request $request){
        $jo_name = $request->jo_name;
        if(empty($jo_name)){
            return responseTojson(1,'你输入的参加会议名称不能为空');
        }
        $jo_name_field = SearchMessageConfig::JOINMEET_JO_NAME;
        return ModelDatabase::byNameSelectDatas($this->joinmeet_tale_name,$jo_name_field,$jo_name,$this->joinmeet_time_field);
    }
    //参加会议级别查询
    public function byLevelSelectJoinmeet(Request $request){
        $jo_level_field = SearchMessageConfig::JOINMEET_JO_LEVEL;
        $jo_level       = $request->jo_level;
        return ModelDatabase::categorySelectInformation($this->joinmeet_tale_name,$jo_level_field,$jo_level,$this->joinmeet_time_field);
    }
    //参加会议时间查询
    public function byTimeSelectJoinmeet(Request $request){
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$this->joinmeet_tale_name,$this->joinmeet_time_field);
    }

    /**
     * 专家讲学检索
     */
    //专家名字查询
    public function byFieldSelectLecture(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = 10;
        $datas['value']        = $request->value;
        $datas['table_name']   = $this->lecture_table_name;
        $datas['time_field']   = $this->lecture_time_field;
        $le_expert_level_field = SearchMessageConfig::LECTURE_LE_EXPERT_LEVEL;
        $le_expert_name_field  = SearchMessageConfig::LECTURE_LE_EXPERT_NAME;
        $le_invite_unit_field  = SearchMessageConfig::LECTURE_LE_INVITE_UNIT;
        switch($request->type){
            case $le_expert_level_field:
                $datas['field'] = $le_expert_level_field;
                return ModelDatabase::categorySelectInformation($datas['table_name'],$le_expert_level_field,$datas['value'],$datas['time_field'],$datas['total']);
            case $le_expert_name_field:
                $datas['field'] = $le_expert_name_field;
                break;
            case $le_invite_unit_field:
                $datas['field'] = $le_invite_unit_field;
                break;
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default :
                return ModelDatabase::selectAllDatas($datas['table_name'],$datas['total'],$datas['time_field']);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 校发文件检索
     */
    //校发文件名称查询
    public function byFieldSelectSchoofile(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = 10;
        $datas['table_name'] = $this->schfile_table_name;
        $datas['time_field'] = $this->schfile_time_field;
        $datas['value']      = $request->value;
        $schfile_name_field = SearchMessageConfig::SCHOOLFILE_SCHFILE_NAME;
        switch($request->type){
            case $schfile_name_field:
                $datas['field'] = $schfile_name_field;
                break;
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field']);
            default :
                return ModelDatabase::selectAllDatas($datas['table_name'],$datas['time_field']);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 合作协议检索
     */
    //合作协议名称查询
    public function byFieldSelectAgreement(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = 10;
        $datas['table_name'] = $this->agreement_table_name;
        $datas['time_field'] = $this->agreement_time_field;
        $datas['value']      = $request->value;
        $agree_name_filed = SearchMessageConfig::AGREEMENT_AGREE_NAME;
        switch($request->type){
            case $agree_name_filed:
                $datas['field'] = $agree_name_filed;
                break;
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field']);
            default:
                return ModelDatabase::selectAllDatas($datas['table_name'],$datas['total']);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     *担任学术团体职务
     */
    //根据老师名字查询
    public function byFieldSelectDuties(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = 10;
        $datas['value']      = $request->value;
        $datas['table_name'] = $this->duties_table_name;
        $du_teacher_name_field = SearchMessageConfig::DUTIES_TEACHER_NAME;
        $du_name_field         = SearchMessageConfig::DUTIES_DU_NAME;
        switch($request->type){
            case $du_teacher_name_field:
                $datas['field'] = $du_teacher_name_field;
                break;
            case $du_name_field:
                $datas['field'] = $du_name_field;
                break;
            default:
                return ModelDatabase::selectAllDatas($datas['table_name'],$datas['total']);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }


    /**
     * 查询饼图数据
     */

    /**
     * 老师饼图数据
     */
    //按老师学历分组查询
    public function groupByTeacherEducation(){
        $group_field     = SearchMessageConfig::TEACHER_MOST_ACADEMIC;
        $group_field_num = SearchMessageConfig::TEA_MOST_ACADEMIC_NUM;
        return ModelDatabase::groupByAndCountDatas($this->teacher_table_name,$group_field,$group_field_num);
    }
    //按老师职称分组查询
    public function groupByTeacherTechnicalTitle(){
        $group_field     = SearchMessageConfig::TEACHER_ACADEMIC_TITLE;
        $group_field_num = SearchMessageConfig::TEA_ACADEMIC_TITLE_NUM;
        return ModelDatabase::groupByAndCountDatas($this->teacher_table_name,$group_field,$group_field_num);
    }

    /**
     * 论文饼图数据
     */
    //期刊级别查询
    public function groupByArticalJournalLevel(Request $request){
        $group_field     = SearchMessageConfig::ARTICAL_PERCAL_CATE;
        $percal_cate_num = SearchMessageConfig::ARTICAL_PERCAL_CATE_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->artical_table_name,$group_field,$percal_cate_num,$this->artical_time_field,$time_datas);
        }
        return ModelDatabase::groupByAndCountDatas($this->artical_table_name,$group_field,$percal_cate_num);
    }
    /**
     * 项目饼图数据
     */
    //项目学科门类查询
    public function groupByProjectCertificateLevel(Request $request){
        $group_field          = SearchMessageConfig::PROJECT_PRO_SUB_CATEGORY;
        $pro_sub_category_num = SearchMessageConfig::PRO_SUB_CATEGORY_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->project_table_name,$group_field,$pro_sub_category_num,$this->project_time_field,$time_datas);
        }
        return ModelDatabase::groupByAndCountDatas($this->project_table_name,$group_field,$pro_sub_category_num);
    }
    //项目研究类别查询
    public function groupByProjetCateResearch(Request $request){
        $group_field           = SearchMessageConfig::PROJECT_PRO_CATE_RESEARCH;
        $pro_cate_research_num = SearchMessageConfig::PRO_CATE_RESEARCH_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->project_table_name,$group_field,$pro_cate_research_num,$this->project_time_field,$time_datas);
        }
        return ModelDatabase::groupByAndCountDatas($this->project_table_name,$group_field,$pro_cate_research_num);
    }
    //项目级别查询
    public function groupByProjectLevel(Request $request){
        $group_field = SearchMessageConfig::PRO_LEVEL;
        $pro_level_num = SearchMessageConfig::PRO_LEVEL_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->project_table_name,$group_field,$pro_level_num,$this->project_time_field,$time_datas);
        }
        return ModelDatabase::groupByAndCountDatas($this->project_table_name,$group_field,$pro_level_num);
    }
    /**
     * 著作饼图数据
     */
    //著作类别查询
    public function gropuByOpusCategory(Request $request){
        $group_field      = SearchMessageConfig::OPUS_OP_CATE_WORK;
        $op_cate_work_num = SearchMessageConfig::OP_CATE_WORK_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->opus_table_name,$group_field,$op_cate_work_num,$this->opus_time_field,$time_datas);
        }
         return ModelDatabase::groupByAndCountDatas($this->opus_table_name,$group_field,$op_cate_work_num);
    }
    //著作编著形式
    public function groupByOpusFormWrite(Request $request){
        $group_field       = SearchMessageConfig::OPUS_OP_FORM_WRITE;
        $op_form_write_num = SearchMessageConfig::OP_FORM_WRITE_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->opus_table_name,$group_field,$op_form_write_num,$this->opus_time_field,$time_datas);
        }
        return ModelDatabase::groupByAndCountDatas($this->opus_table_name,$group_field,$op_form_write_num);
    }
    /**
     * 获奖饼图数据
     */
    //
    //获奖级别查询
    public function groupBywinLevel(Request $request){
        $group_field  = SearchMessageConfig::AWARD_AW_LEVEL;
        $aw_level_num = SearchMessageConfig::AW_LEVEL_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->award_table_name,$group_field,$aw_level_num,$this->award_time_field,$time_datas);
        }
         return ModelDatabase::groupByAndCountDatas($this->award_table_name,$group_field,$aw_level_num);
    }
    //获奖成果形式查询
    public function groupByFormAchievement(Request $request){
        $group_field          = SearchMessageConfig::AW_FORM_ACHIEVEMENT;
        $form_achievement_num = SearchMessageConfig::AW_FORM_ACHIEVEMENT_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->award_table_name,$group_field,$form_achievement_num,$this->award_time_field,$time_datas);
        }
        return ModelDatabase::groupByAndCountDatas($this->award_table_name,$group_field,$form_achievement_num);
    }
    /**
     * 学术专利饼图数据
     */
    //专利类型查询
    public function groupByPatentType(Request $request){
        $group_field  = SearchMessageConfig::PATENT_PA_TYPE;
        $pa_type_num  = SearchMessageConfig::PA_TYPE_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->patent_table_name,$group_field,$pa_type_num,$this->patent_time_field,$time_datas);
        }
        return ModelDatabase::groupByAndCountDatas($this->patent_table_name,$group_field,$pa_type_num);
    }
    /**
     * 成果鉴定饼图数据
     */
    //鉴定类别查询
    public function groupByAppraisalLevel(Request $request){
        $group_field = SearchMessageConfig::APPRAISAL_AP_LEVEL;
        $ap_level_num = SearchMessageConfig::AP_LEVEL_NUM;
        if($request->has('start_time') && $request->has('end_time')){
            $time_datas['start_time'] = $request->start_time;
            $time_datas['end_time']   = $request->end_time;
            return ModelDatabase::groupByAndCountDatas($this->appraisal_table_name,$group_field,$ap_level_num,$this->patent_time_field,$time_datas);
        }
        return ModelDatabase::groupByAndCountDatas($this->appraisal_table_name,$group_field,$ap_level_num);
    }
    /**
     * 总览每个模块的所有数据总和
     */
    public function countEveryModular(){
        return ModelDatabase::countEveryModularDatas();
    }

}
