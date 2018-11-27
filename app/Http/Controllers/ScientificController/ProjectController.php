<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ProjectDatabase;
use Illuminate\Http\Request;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
use App\Model\ModelDatabase;
class ProjectController extends Controller
{
    private $disk = UploadSubjectionConfig::PROJECT;
    private $subjection = UploadSubjectionConfig::PROJECT_IMG;
    //添加项目信息
    public function addProject(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $teacher_id = session('usercount');
        $datas = [
            'teacher_id'        => $teacher_id,
            'pro_host'          => trim($request->pro_host),
            'pro_all_author'    => trim($request->pro_all_author),
            'entry_name'        => trim($request->entry_name),
            'project_category'  => trim($request->project_category),
            'approval_unit'     => trim($request->approval_unit),
            'approval_funds'    => trim($request->approval_funds),
            'account_outlay'    => trim($request->account_outlay),
            'pro_level'         => trim($request->pro_level),
            'pro_cate_research' => trim($request->pro_cate_research),
            'pro_sub_category'  => trim($request->pro_sub_category),
            'form_cooperate'    => trim($request->form_cooperate),
            'social_eco_goal'   => trim($request->social_eco_goal),
            'na_eco_industry'   => trim($request->na_eco_industry),
            'pro_integral'      => trim($request->pro_integral),
            'project_year'      => trim($request->project_year),
        ];
        $judge_project_datas = judgeProjectField($datas);                  //验证字段
        if($judge_project_datas['code'] == 1){
            return responseTojson(1,$judge_project_datas['message']);
        }
        $datas['pro_remarks'] = trim($request->pro_remarks);
        if(!$request->hasFile('pro_road')){                            //判断用户是否添加证书
            $datas['pro_road'] = '';
            return ProjectDatabase::addProjectDatas($datas);
        }
        $project_image = $request->file('pro_road');
        $judge_project = judgeReceiveFiles($project_image);
        if($judge_project['code'] == 1){                             //验证是否已为PDF
            return responseTojson(1,$judge_project['message']);
        }
        $project_road = uploadFiles($this->subjection,$project_image,$this->disk);//上传项目PDF
        $datas['pro_road']  = $project_road;
        $add_project = ProjectDatabase::addProjectDatas($datas);
        if($add_project){
            return responseTojson(0,'添加项目成功');
        }
        deletefiles($this->disk,$project_road);
        return responseTojson(1,'添加项目失败');
    }
    //删除项目信息
    public function deleteProject(Request $request){
        $pro_id_datas   = $request->pro_id_datas;
        $table_name     = SearchMessageConfig::PROJECT_TABLE;
        $id_field       = SearchMessageConfig::PROJECT_ID;
        $old_image_road = ProjectDatabase::selectImagesRoadDatas($pro_id_datas);
        $delete_project = ModelDatabase::deleteAllDatas($table_name,$id_field,$pro_id_datas);
        if($delete_project) {
            deleteAllFiles(UploadSubjectionConfig::PROJECT, $old_image_road);
            return responseTojson(0, '全部删除成功');
        }
        return responseTojson(1,'删除失败');
    }
    //查看单个项目信息
    public function selectProject(Request $request){
        $project_datas = ProjectDatabase::selectProjectDatas($request->pro_id);
        return responseTojson(0,'查询成功','',$project_datas);
    }
    //查看多个项目信息
    public function selectAllProject(){
        $teacher_id = session('usercount');
        $resulet = ProjectDatabase::selectAllProjectDatas($teacher_id);
        return responseTojson(0,'查找成功','',$resulet);
    }
    //根据时间查看项目信息
    public function timeSelectProject(Request $request){
        $teacher_id = session('usercount');
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::PROJECT_TABLE;
        $time_field = SearchMessageConfig::PROJECT_YEAR;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
    //修改项目信息
    public function updateProject(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $pro_id[0] = trim($request->pro_id);
        $pro_road  = ProjectDatabase::selectImagesRoadDatas($pro_id);
        (empty($pro_road)) ? $pro_road = '' : $pro_road = $pro_road[0];
        $datas = [
            'pro_id'            => $pro_id,
            'pro_host'          => trim($request->pro_host),
            'pro_all_author'    => trim($request->pro_all_author),
            'entry_name'        => trim($request->entry_name),
            'project_category'  => trim($request->project_category),
            'approval_unit'     => trim($request->approval_unit),
            'approval_funds'    => trim($request->approval_funds),
            'account_outlay'    => trim($request->account_outlay),
            'pro_level'         => trim($request->pro_level),
            'pro_cate_research' => trim($request->pro_cate_research),
            'pro_sub_category'  => trim($request->pro_sub_category),
            'form_cooperate'    => trim($request->form_cooperate),
            'social_eco_goal'   => trim($request->social_eco_goal),
            'na_eco_industry'   => trim($request->na_eco_industry),
            'pro_integral'      => trim($request->pro_integral),
            'project_year'      => trim($request->project_year)
        ];
        $judge_project_datas = judgeProjectField($datas);
        if($judge_project_datas['code'] == 1){
            return responseTojson(1,$judge_project_datas['message']);
        }
        $reset_image_status = false;
        $datas['pro_remarks'] = trim($request->pro_remarks);
        if(!$request->hasFile('pro_road')){
            $datas['pro_road']    = $pro_road;
            return ProjectDatabase::updateProjectDatas($datas,$reset_image_status);
        }
        $reset_image_status = true;
        $project_image = $request->file('pro_road');
        $judge_project_img = judgeReceiveFiles($project_image);
        if($judge_project_img['code'] == 1){
            return responseTojson(1,$judge_project_img['message']);
        }
        $new_image_road     = uploadFiles($this->subjection,$project_image,$this->disk);
        $datas['pro_road']  = $new_image_road;
        ProjectDatabase::beginTraction();
        $reset_project      = ProjectDatabase::updateProjectDatas($datas,$reset_image_status);
        if($reset_project){
            ProjectDatabase::commit();
            if(!empty($pro_road)){
                deletefiles($this->disk,$pro_road);
            }
            return responseTojson(0,'修改项目成功');
        }
        ProjectDatabase::rollback();
        deletefiles($this->disk,$new_image_road);
        return responseTojson(1,'修改项目失败');
    }
}