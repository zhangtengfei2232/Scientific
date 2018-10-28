<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ProjectDatabase;
use Illuminate\Http\Request;
use config\UploadSubjectionConfig;
use Illuminate\Support\Facades\Storage;
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
        ];
        $judge_project_datas = judgeProjectField($datas);                  //验证字段
        if($judge_project_datas['code'] == 1){
            return $judge_project_datas;
        }
        $datas['pro_remarks'] = trim($request->pro_remarks);
        if(!$request->hasFile('pro_file')){                            //判断用户是否添加证书
            $datas['pro_road'] = '';
            return ProjectDatabase::addProjectDatas($datas);
        }
        $project_image = $request->file('pro_file');
        $judge_project_image = judgeFileImage($project_image);
        if($judge_project_image['code'] == 1){                             //验证图片
            return $judge_project_datas;
        }
        $disk = UploadSubjectionConfig::PROJECT;
        $subjection_project = UploadSubjectionConfig::PROJECT_IMG;
        $project_iamge_road = uploadFiles($subjection_project,$project_image,$disk);//上传图片
        $datas['pro_road']  = $project_iamge_road;
        $add_project = ProjectDatabase::addProjectDatas($datas);
        if(!$add_project){
            deletefiles($disk,$project_iamge_road);
            return responseTojson(1,'添加项目失败');
        }
        return responseTojson(0,'添加项目成功');
    }
    //删除项目信息
    public function deleteProject(Request $request){
        $pro_id_datas = $request->pro_id_datas;
        $old_image_road = ProjectDatabase::selectImagesRoadDatas($pro_id_datas);
        $response = ProjectDatabase::deleteAllProjectDatas($pro_id_datas);
        deleteAllFiles(UploadSubjectionConfig::PROJECT,$old_image_road);
        return responseTojson(0,'全部删除成功');
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
    //修改项目信息
    public function updateProject(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        dd($request);
        $project_id[0]          = trim($request->project_id);
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
            'project_year'      => strtotime(trim($request->project_year))
        ];
        $judge_project_datas = judgeProjectField($datas);
        if($judge_project_datas['code'] == 1){
            return $judge_project_datas;
        }
        $datas['pro_remarks'] = trim($request->pro_remarks);
        if(!$request->hasFile('pro_file')){
           return  ProjectDatabase::updateProjectDatas($datas);
        }
        $project_image = $request->file('pro_file');
        $judge_project_img = judgeFileImage($project_image);
        if($judge_project_img['code'] == 1){
            return $judge_project_img;
        }
        $disk               = UploadSubjectionConfig::PROJECT;
        $subjection_project = UploadSubjectionConfig::PROJECT_IMG;
        $old_image_road    = ProjectDatabase::selectImagesRoadDatas($project_id);
        $new_image_road    = uploadFiles($subjection_project,$project_image,$disk);
        $datas['pro_road'] = $new_image_road;
        ProjectDatabase::beginTraction();
        $reset_project     = ProjectDatabase::updateProjectDatas($datas);
        if($reset_project){
            ProjectDatabase::commit();
            deletefiles($disk,$old_image_road[0]);
            return responseTojson(0,'修改项目成功');
        }
        ProjectDatabase::rollback();
        deletefiles($disk,$new_image_road);
        return responseTojson(1,'修改项目失败');
    }
}