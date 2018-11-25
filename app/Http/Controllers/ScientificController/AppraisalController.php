<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use Illuminate\Http\Request;
use App\Model\AppraisalDatabase;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
class AppraisalController extends Controller
{
    private $disk       = UploadSubjectionConfig::APPRAISAL;
    private $subjection = UploadSubjectionConfig::APPRAISAL_COVER_IMG;
    //添加成果鉴定
    public function addAppraisal(Request $request){
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         $datas = [
             'teacher_id'      => session('usercount'),
             'ap_first_author' => trim($request->ap_first_author),
             'ap_all_author'   => trim($request->ap_all_author),
             'ap_res_name'     => trim($request->ap_res_name),
             'ap_form'         => trim($request->ap_form),
             'ap_num'          => trim($request->ap_num),
             'ap_conclusion'   => trim($request->ap_conclusion),
             'ap_time'         => trim($request->ap_time),
             'ap_level'        => trim($request->ap_level),
             'ap_integral'     => trim($request->ap_integral)
         ];
         $judge_datas = judgeAppraisalField($datas);
         if($judge_datas['code'] == 1){
             return responseTojson(1,$judge_datas['message']);
         }
         $datas['ap_remarks'] = trim($request->ap_remarks);
         if(!$request->hasFile('ap_road')){
             $datas['ap_road'] = '';
             return AppraisalDatabase::addAppraisalDatas($datas);
         }
         $appraisal_image = $request->file('ap_road');
         $judge_image     = judgeReceiveFiles($appraisal_image);
         if($judge_image['code'] == 1){
             return responseTojson(1,$judge_image['message']);
         }
         $add_image_road = uploadFiles($this->subjection,$appraisal_image,$this->disk);
         $datas['ap_road'] = $add_image_road;
         $add_appraisal = AppraisalDatabase::addAppraisalDatas($datas);
         if($add_appraisal){
             return responseTojson(0,'添加成功鉴定信息成功');
         }
         deletefiles($this->disk,$add_appraisal);
         return responseTojson(1,'添加成功鉴定信息失败');
    }
    //删除鉴定成果信息
    public function deleteAppraisal(Request $request){
        $ap_id_datas         = $request->ap_id_datas;
        $old_image_road      = AppraisalDatabase::selectAllAppraisalImageRoad($ap_id_datas);
        $table_name          = SearchMessageConfig::APPRAISAL_TABLE;
        $id_field            = SearchMessageConfig::APPRAISAL_ID;
        ModelDatabase::beginTraction();
        $delete_appraisal    = ModelDatabase::deleteAllDatas($table_name,$id_field,$ap_id_datas);
        if($delete_appraisal){
            ModelDatabase::commit();
            deleteAllFiles(UploadSubjectionConfig::APPRAISAL,$old_image_road);
            return responseTojson(0,'删除成功');
        }
        return responseTojson(1,'删除失败');
    }
    //查看单个成果鉴定信息
    public function selectAppraisal(Request $request){
        $result = AppraisalDatabase::selectAppraisalDatas($request->ap_id);
        return responseTojson(0,'查询成功','',$result);
    }
    //查看所有成果鉴定信息
    public function selectAllAppraisal(){
        $result = AppraisalDatabase::selectAppraisalAllDatas(session('usercount'));
        return responseTojson(0,'查询成功','',$result);
    }
    //根据时间区间搜索成果鉴定
    public function timeSelectAppraisal(Request $request){
        $teacher_id = session('usercount');
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
    //修改成功鉴定
    public function updateAppraisal(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $ap_id[0] = trim($request->ap_id);
        $ap_road  = AppraisalDatabase::selectAllAppraisalImageRoad($ap_id);
        (empty($ap_road)) ? $ap_road = '' : $ap_road = $ap_road[0];
        $datas = [
             'ap_id'           => $ap_id[0],
             'ap_first_author' => trim($request->ap_first_author),
             'ap_all_author'   => trim($request->ap_all_author),
             'ap_res_name'     => trim($request->ap_res_name),
             'ap_form'         => trim($request->ap_form),
             'ap_num'          => trim($request->ap_num),
             'ap_conclusion'   => trim($request->ap_conclusion),
             'ap_time'         => trim($request->ap_time),
             'ap_level'        => trim($request->ap_level),
             'ap_integral'     => trim($request->ap_integral)
        ];
        $judge_datas = judgeAppraisalField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        $datas['ap_remarks'] = trim($request->ap_remarks);
        $reset_image_status = false;
        $datas['ap_road'] = $ap_road;
        if(!$request->hasFile('ap_road')){
            return AppraisalDatabase::updateAppraisalDatas($datas,$reset_image_status);
        }
        $reset_image_status = false;
        $appraisal_image = $request->file('ap_road');
        $judge_image = judgeReceiveFiles($appraisal_image);
        if($judge_image['code'] == 1){
            return responseTojson(1,$judge_image['message']);
        }
        $new_image_road   = uploadFiles($this->subjection,$appraisal_image,$this->disk);
        $datas['ap_road'] = $new_image_road;
        AppraisalDatabase::beginTraction();
        $reset_appraisal = AppraisalDatabase::updateAppraisalDatas($datas,$reset_image_status);
        if($reset_appraisal){
            AppraisalDatabase::commit();
            if(!empty($ap_road)){
                deletefiles($this->disk,$ap_road);
            }
            return responseTojson(0,'修改成果鉴定信息成功');
        }
        deletefiles($this->disk,$new_image_road);
        return responseTojson(1,'修改成果鉴定信息失败');
    }
}