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
     * 2.生成=======>师资组成(最高学历，职称，学缘)，论文(期刊级别)
     * 项目(证书级别)，著作(著作类别)，获奖(获奖级别)
     */
    /**
     *检索功能
     */
    /**
     * 老师检索
     */
    public function byFieldSelectTeacher(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        $datas['table_name'] = $this->teacher_table_name;
        if($request->has('value')){
            $datas['value'] = $request->value;
        }
        $teacher_name_field          = SearchMessageConfig::TEACHER_NAME;
        $teacher_admin_duties_field  = SearchMessageConfig::TEACHER_ADMIN_DUTIES;
        $teacher_re_department_field = SearchMessageConfig::TEACHER_TE_RE_DEPARTMENT;
        $teacher_work_major_filed    = SearchMessageConfig::TEACHER_WORK_MAJOR;
        $academic_title_field        = SearchMessageConfig::TEACHER_ACADEMIC_TITLE;
        $job_level_field             = SearchMessageConfig::TEACHER_JOB_LEVEL;
        $post_category_field         = SearchMessageConfig::TEACHER_POST_CATEGORY;
        switch($request->type){
            case $teacher_name_field:
                $datas['field'] = $teacher_name_field;
                break;
            case $teacher_admin_duties_field:
                $datas['field'] = $teacher_admin_duties_field;
                break;
            case $teacher_re_department_field:
                $datas['field'] = $teacher_re_department_field;
                break;
            case $teacher_work_major_filed:
                $datas['field'] = $teacher_work_major_filed;
                break;
            case 'composite_query':
                $datas['first_field'] = $academic_title_field;
                $datas['first_datas'] = $request->academic_title_datas;
                $job_level_datas      = $request->job_level_datas;
                $post_category_datas  = $request->post_category_datas;
                return ModelDatabase::combinationSelectDatas($datas,$job_level_field,$job_level_datas,$post_category_field,$post_category_datas);
            default:
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 论文检索
     */
    //根据论文作者模糊查询
    public function byFieldSelectArtical(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        if($request->has('value')){
            $datas['value'] = $request->total;
        }
        $datas['table_name'] = $this->artical_table_name;
        $datas['time_field'] = $this->artical_time_field;
        $art_author_field        = SearchMessageConfig::ARTICAL_AUTHOR;
        $sch_percal_cate_field   = SearchMessageConfig::ARTICAL_SCH_PERCAL_CATE;
        $journal_level_field     = SearchMessageConfig::ARTICAL_PERCAL_CATE;
        $art_cate_research_field = SearchMessageConfig::ARTICAL_ART_CATE_RESEARCH;//文章研究类别字段
        switch ($request->type){
            case $art_author_field:
                $datas['field'] = $art_author_field;
                break;
            case $sch_percal_cate_field:
                $datas['field'] = $sch_percal_cate_field;
                break;
            case 'composite_query':
                $datas['first_field'] = $journal_level_field;
                $datas['first_datas'] = $request->percal_cate_datas;
                $cate_research_datas  = $request->cate_research_datas;
                return ModelDatabase::combinationSelectDatas($datas,$art_cate_research_field,$cate_research_datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default:
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 项目检索
     */
    public function byFieldSelectProject(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        $datas['table_name']    = $this->project_table_name;
        $datas['time_field']    = $this->project_time_field;
        if($request->has('value')){
            $datas['value'] = $request->value;
        }
        $pro_host_field         = SearchMessageConfig::PROJECT_PRO_HOST;
        $project_category_field = SearchMessageConfig::PROJECT_PROJECT_CATEGORY;
        $approval_unit_field    = SearchMessageConfig::PROJECT_APPROVAL_UNIT;
        $pro_sub_category_field = SearchMessageConfig::PROJECT_PRO_SUB_CATEGORY;
        switch($request->type){
            case $pro_host_field:
                $datas['field'] = $pro_host_field;
                break;
            case $project_category_field:
                $datas['field'] = $project_category_field;
                break;
            case $approval_unit_field:
                $datas['field'] = $approval_unit_field;
                break;
            case $pro_sub_category_field:
                $datas['first_field'] = $pro_sub_category_field;
                $datas['first_datas'] = $request->pro_sub_category_datas;
                return ModelDatabase::combinationSelectDatas($datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default:
                return  ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 著作检索
     */
    public function byFieldSelectOpus(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        $datas['table_name'] = $this->opus_table_name;
        $datas['time_field'] = $this->opus_time_field;
        if($request->has('value')){
            $datas['value'] = $request->value;
        }
        $op_name_field          = SearchMessageConfig::OPUS_OP_NAME;
        $op_first_author_field  = SearchMessageConfig::OPUS_OP_FIRST_AUTHOR;
        $op_cate_work_field     = SearchMessageConfig::OPUS_OP_CATE_WORK;
        $op_form_write_field    = SearchMessageConfig::OPUS_OP_FORM_WRITE;
        $op_cate_research_field = SearchMessageConfig::OPUS_OP_CATE_RESEARCH;
        switch($request->type){
            case $op_name_field:
                $datas['field'] = $op_name_field;
                break;
            case $op_first_author_field:
                $datas['field'] = $op_first_author_field;
                break;
            case 'composite_query':
                $datas['first_field']   = $op_cate_work_field;
                $datas['first_datas']   = $request->op_cate_work_datas;
                $op_cate_research_datas = $request->op_cate_research_datas;
                $op_form_write_datas    = $request->op_form_write_datas;
                return ModelDatabase::combinationSelectDatas($datas,$op_cate_research_field,$op_cate_research_datas,$op_form_write_field,$op_form_write_datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default:
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 获奖检索
     */
    public function byFieldSelectAward(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        if($request->has('value')){
            $datas['value'] = $request->value;
        }
        $datas['table_name'] = $this->award_table_name;
        $datas['time_field'] = $this->award_time_field;
        $award_name_field = SearchMessageConfig::AWARD_AWARD_NAME;
        $aw_first_author_field = SearchMessageConfig::AWARD_AW_FIRST_AUTHOR;
        $aw_level_field = SearchMessageConfig::AWARD_AW_LEVEL;
        switch($request->type){
            case $award_name_field:
                $datas['field'] = $award_name_field;
                break;
            case $aw_first_author_field:
                $datas['field'] = $aw_first_author_field;
                break;
            case $aw_level_field:
                $datas['first_field'] = $aw_level_field;
                $datas['first_datas'] = $request->aw_level_datas;
                return ModelDatabase::combinationSelectDatas($datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default:
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 专利检索
     */
    public function byFieldSelectPatent(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        $datas['table_name'] = $this->patent_table_name;
        $datas['time_field'] = $this->patent_time_field;
        if($request->has('value')){
            $datas['value']  = $request->value;
        }
        $pa_name_field = SearchMessageConfig::PATENT_PA_NAME;
        $first_inventor_field = SearchMessageConfig::PATEN_FIRST_INVENTOR;
        switch($request->type){
            case $pa_name_field:
                $datas['field'] = $pa_name_field;
                break;
            case $first_inventor_field:
                $datas['field'] = $first_inventor_field;
                break;
            case 'composite_query':
                $datas['first_field'] = SearchMessageConfig::PATENT_PA_TYPE;
                $datas['first_datas'] = $request->pa_type_datas;
                $pa_imple_situ_field = SearchMessageConfig::PATENT_PA_IMPLE_SITU;         //专利实施情况字段
                return ModelDatabase::combinationSelectDatas($datas,$pa_imple_situ_field,$request->pa_imple_situ_datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default:
                return  ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }

    /**
     * 成果鉴定检索
     */
    public function byFieldSelectAppraisal(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $this->total;
        $datas['table_name']    = $this->appraisal_table_name;
        $datas['time_field']    = $this->appraisal_time_field;
        if($request->has('value')){
            $datas['value']     = $request->value;
        }
        $ap_form_field         = SearchMessageConfig::APPRAISAL_AP_FORM;
        $ap_first_author_field = SearchMessageConfig::APPRAISAL_AP_FIRST_AUTHOR;
        $ap_res_name_field     = SearchMessageConfig::APPRAISAL_AP_RES_NAME;
        $ap_level_field        = SearchMessageConfig::APPRAISAL_AP_LEVEL;
        switch($request->type){
            case $ap_res_name_field:
                $datas['filed'] = $ap_res_name_field;
                break;
            case $ap_first_author_field:
                $datas['field'] = $ap_first_author_field;
                break;
            case $ap_form_field:
                $datas['field'] = $ap_form_field;
                break;
            case $ap_level_field:
                $datas['first_field'] = $ap_level_field;
                $datas['first_datas'] = $request->ap_level_datas;
                return ModelDatabase::combinationSelectDatas($datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default:
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }

    /**
     * 举办会议检索
     */
    public function byFieldSelectHoldmeet(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        $datas['table_name'] = $this->holdmeet_table_name;
        $datas['time_field'] = $this->holdmeet_time_field;
        if($request->has('value')){
            $datas['value'] = $request->value;
        }
        $ho_name_field  = SearchMessageConfig::HOLDMEET_HO_NAME;
        $ho_level_field = SearchMessageConfig::HOLDMEET_HO_LEVEL;
        switch($request->type){
            case $ho_name_field:
                $datas['field'] = $ho_name_field;
                break;
            case $ho_level_field:
                $datas['first_field'] = $ho_level_field;
                $datas['first_datas'] = $request->ho_level_datas;
                return ModelDatabase::combinationSelectDatas($datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],'',$datas['time_field']);
            default:
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 参加会议检索
     */
    public function byFieldSelectJoinmeet(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        $datas['table_name'] = $this->joinmeet_tale_name;
        $datas['time_field'] = $this->joinmeet_time_field;
        if($request->has('value')){
            $datas['value']  = $request->value;
        }
        $jo_name_field  = SearchMessageConfig::JOINMEET_JO_NAME;
        $jo_level_field = SearchMessageConfig::JOINMEET_JO_LEVEL;
        switch($request->type){
            case $jo_name_field:
                $datas['field'] = $jo_name_field;
                break;
            case $jo_level_field:
                $datas['first_field'] = $jo_level_field;
                $datas['first_datas'] = $request->jo_level_datas;
                return ModelDatabase::combinationSelectDatas($datas);
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],'',$datas['time_field']);
            default:
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 专家讲学检索
     */
    public function byFieldSelectLecture(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        if($request->has('value')){
            $datas['value']    = $request->value;
        }
        $datas['table_name']   = $this->lecture_table_name;
        $datas['time_field']   = $this->lecture_time_field;
        $le_expert_level_field = SearchMessageConfig::LECTURE_LE_EXPERT_LEVEL;
        $le_expert_name_field  = SearchMessageConfig::LECTURE_LE_EXPERT_NAME;
        $le_invite_unit_field  = SearchMessageConfig::LECTURE_LE_INVITE_UNIT;
        switch($request->type){
            case $le_expert_level_field:
                $datas['first_field'] = $le_expert_level_field;
                $datas['first_datas'] = $request->le_expert_level_datas;
                return ModelDatabase::combinationSelectDatas($datas);
            case $le_expert_name_field:
                $datas['field'] = $le_expert_name_field;
                break;
            case $le_invite_unit_field:
                $datas['field'] = $le_invite_unit_field;
                break;
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field'],'',$datas['total']);
            default :
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 校发文件检索
     */
    public function byFieldSelectSchoofile(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        $datas['table_name'] = $this->schfile_table_name;
        $datas['time_field'] = $this->schfile_time_field;
        if($request->has('value')){
            $datas['value']  = $request->value;
        }
        $schfile_name_field  = SearchMessageConfig::SCHOOLFILE_SCHFILE_NAME;
        switch($request->type){
            case $schfile_name_field:
                $datas['field'] = $schfile_name_field;
                break;
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field']);
            default :
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     * 合作协议检索
     */
    public function byFieldSelectAgreement(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        $datas['table_name'] = $this->agreement_table_name;
        $datas['time_field'] = $this->agreement_time_field;
        if($request->has('value')){
            $datas['value']  = $request->value;
        }
        $agree_name_filed = SearchMessageConfig::AGREEMENT_AGREE_NAME;
        switch($request->type){
            case $agree_name_filed:
                $datas['field'] = $agree_name_filed;
                break;
            case 'time':
                return ModelDatabase::timeSelectInformation($request->start_time,$request->end_time,$datas['table_name'],$datas['time_field']);
            default:
                return ModelDatabase::selectAllDatas($datas);
        }
        return ModelDatabase::pagingQueryDatas($datas);
    }
    /**
     *担任学术团体职务
     */
    public function byFieldSelectDuties(Request $request){
        ($request->has('total')) ? $datas['total'] = $request->total : $datas['total'] = $this->total;
        if($request->has('value')){
            $datas['value']  = $request->value;
        }
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
                return ModelDatabase::selectAllDatas($datas);
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
