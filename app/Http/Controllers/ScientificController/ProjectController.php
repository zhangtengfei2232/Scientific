<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ProjectDatabase;
use Illuminate\Http\Request;
use config\UploadSubjectionConfig;
class ProjectController extends Controller
{
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
            'pro_cate_research' => trim($request->pro_cate_research),
            'pro_sub_category'  => trim($request->pro_sub_category),
            'form_cooperate'    => trim($request->form_cooperate),
            'social_eco_goal'   => trim($request->social_eco_goal),
            'na_eco_industry'   => trim($request->na_eco_industry),
            'pro_integral'      => trim($request->pro_integral),
            'project_year'      => strtotime(trim($request->project_year)),
            'pro_remarks'       => trim($request->pro_remarks)
        ];
        $judge_project_datas = judgeProjectField($datas);                          //验证字段
        if($judge_project_datas['code'] == 1){
            return responseTojson(1,$judge_project_datas['message']);
        }
        $project_image = $request->file('project_image');
        $judge_project_image = judgeFileImage($project_image);
        if($judge_project_image['code'] == 1){                                     //验证图片
            return responseTojson(1,$judge_project_image['message']);
        }
        $disk = UploadSubjectionConfig::PROJECT;
        $subjection_project = UploadSubjectionConfig::PROJECT_IMG;
        ProjectDatabase::beginTraction();
        $project_iamge_road = uploadFiles($subjection_project,$project_image,$disk);//上传图片
        $datas['pro_road']  = $project_iamge_road;
        $add_project = ProjectDatabase::addProjectDatas($datas);
        if(!$add_project){
            ProjectDatabase::rollback();
            deletefiles($disk,$project_iamge_road);
            return responseTojson(1,'添加项目失败');
        }
        ProjectDatabase::commit();
        return responseTojson(0,'添加项目成功');
    }
    //删除项目信息
    public function deleteProject(Request $request){
        $pro_id_datas = $request->pro_id_datas;
        $old_image_road = ProjectDatabase::selectAllImagesRoad($pro_id_datas);
        $response = ProjectDatabase::deleteAllProjectDatas($pro_id_datas);
        deleteAllFiles(UploadSubjectionConfig::PROJECT,$old_image_road);
        return responseTojson(0,'删除项目成功');
    }
//    //删除多个项目信息
//    public function deleteAllProjectDatas(Request $request){
//        $project_id_datas = $request->project_id_datas;
//        $old_images_roads = ProjectDatabase::selectAllImagesRoad($project_id_datas);
//        ProjectDatabase::deleteAllProjectDatas($project_id_datas);
//        deleteAllFiles(UploadSubjectionConfig::PROJECT,$old_images_roads);
//        return responseTojson(0,'全部删除成功');
//    }
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
    //修改项目信息
    public function updateProject(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $update_image_status    = $request->update_image_status;
        $project_id             = trim($request->project_id);
        $datas = [
            'pro_id'            => $project_id,
            'pro_host'          => trim($request->pro_host),
            'pro_all_author'    => trim($request->pro_all_author),
            'entry_name'        => trim($request->entry_name),
            'project_category'  => trim($request->project_category),
            'approval_unit'     => trim($request->approval_unit),
            'approval_funds'    => trim($request->approval_funds),
            'account_outlay'    => trim($request->account_outlay),
            'pro_cate_research' => trim($request->pro_cate_research),
            'pro_sub_category'  => trim($request->pro_sub_category),
            'form_cooperate'    => trim($request->form_cooperate),
            'social_eco_goal'   => trim($request->social_eco_goal),
            'na_eco_industry'   => trim($request->na_eco_industry),
            'pro_integral'      => trim($request->pro_integral),
            'project_year'      => strtotime(trim($request->project_year)),
            'pro_remarks'       => trim($request->pro_remarks)
        ];
        $judge_project_datas = judgeProjectField($datas);
        if($judge_project_datas['code'] == 1){
            return $judge_project_datas;
        }
        if(!$update_image_status){
            return ProjectDatabase::updateProjectDatas($datas);
        }
        $project_image = $request->file('project_image');
        $judge_project_img = judgeFileImage($project_image);
        if($judge_project_img['code '] == 1){
            return $judge_project_img;
        }
        $disk               = UploadSubjectionConfig::PROJECT;
        $subjection_project = UploadSubjectionConfig::PROJECT_IMG;
        ProjectDatabase::beginTraction();
        $old_image_road    = ProjectDatabase::selectImageRoad($project_id);
        $new_image_road    = uploadFiles($subjection_project,$project_image,$disk);
        $datas['pro_road'] = $new_image_road;
        $reset_project     = ProjectDatabase::updateProjectImage($datas);
        if(!$reset_project){
            ProjectDatabase::rollback();
            deletefiles($disk,$new_image_road);
            return responseTojson(1,'修改项目失败');
        }
        deletefiles($disk,$old_image_road);
        return responseTojson(0,'修改项目成功');
    }
}