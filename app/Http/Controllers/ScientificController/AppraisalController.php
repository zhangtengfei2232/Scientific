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
         dd($datas);
         $judge_datas = judgeAppraisalField($datas);
         if($judge_datas['code'] == 1){
             return $judge_datas;
         }
         $datas['ap_remarks'] = trim($request->ap_remarks);
         return  AppraisalDatabase::addAppraisalDatas($datas);
    }
    //添加成功鉴定证书和封面图片
    public function addAppraisalImage(Request $request){
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         if(!$request->is_add_appraisal){
            return responseTojson(1,'请你先添加成功鉴定信息');
         }
         $add_image_status = $request->add_image_status;
         if($add_image_status == 1){
             $subjection       = UploadSubjectionConfig::APPRAISAL_IMG;
             $appraisal_image  = $request->file('ap_image');
         }else{
             $subjection       = UploadSubjectionConfig::APPRAISAL_COVER_IMG;
             $appraisal_image  = $request->file('ap_cover_image');
         }
         $judge_image = judgeFileImage($appraisal_image);
         if($judge_image['code'] == 1){
             return $judge_image;
         }
         $disk      = UploadSubjectionConfig::APPRAISAL;
         $ap_id     = $request->ap_id;
         $new_image_road = uploadFiles($subjection,$appraisal_image,$disk);
         $add_image = AppraisalDatabase::updateAppraisalImageDatas($new_image_road,$add_image_status,$ap_id);
         if($add_image){
             return responseTojson(0,'上传图片成功');
         }
         deletefiles($disk,$new_image_road);
         return responseTojson(1,'上传图片失败');
    }
    //删除单个鉴定成果信息
    public function deleteAppraisal(Request $request){
        $ap_id_datas = $request->ap_id_datas;
        $old_image_road      = AppraisalDatabase::selectAllAppraisalImageRoad($ap_id_datas);
        $delete_appraisal    = AppraisalDatabase::deleteAllAppraisalDatas($ap_id_datas);
        deleteAllFiles(UploadSubjectionConfig::APPRAISAL,$old_image_road);
        return responseTojson(0,'删除成功');
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
        $start_time = $request->start_time;
        $end_time   = $request->end_tiem;
        $table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $time_field = SearchMessageConfig::AP_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
    //修改成功鉴定
    public function updateAppraisal(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
         $datas = [
             'ap_id'           => trim($request->ap_id),
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
        dd($request);
        $judge_datas = judgeAppraisalField($datas);
        if($judge_datas['code'] == 1){
            return $judge_datas;
        }
        $datas['ap_remarks'] = trim($request->ap_remarks);
        return  AppraisalDatabase::updateAppraisalDatas($datas);
    }
    //修改成果鉴定证书和封面图片
    public function updateAppraisalImage(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $update_image_status = $request->update_image_status;
        if($update_image_status == 1){
            $appraisal_image = $request->file('ap_image');
            $subjection      = UploadSubjectionConfig::APPRAISAL_IMG;
        }else{
            $appraisal_image = $request->file('ap_cover_image');
            $subjection      = UploadSubjectionConfig::APPRAISAL_COVER_IMG;
        }
        $judge_image         = judgeFileImage($appraisal_image);
        if($judge_image['code'] == 1){
            return $judge_image;
        }
        $ap_id          = $request->ap_id;
        $disk           = UploadSubjectionConfig::APPRAISAL;
        $old_image_road = AppraisalDatabase::selectAppraisalImageRoad($ap_id,$update_image_status);
        $new_image_road = uploadFiles($subjection,$appraisal_image,$disk);
        $reset_image    = AppraisalDatabase::updateAppraisalImageDatas($new_image_road,$update_image_status,$ap_id);
        if($reset_image){
            deletefiles($disk,$old_image_road);
            return responseTojson(0,'修改鉴定成果图片成功');
        }
        deletefiles($disk,$new_image_road);
        return responseTojson(1,'修改鉴定成果图片失败');
    }

}