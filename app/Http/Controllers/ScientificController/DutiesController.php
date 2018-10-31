<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use config\UploadSubjectionConfig;
use Illuminate\Http\Request;
use App\Model\DutiesDatabase;
class DutiesController extends Controller
{
    //添加学术团体职务信息
    public function addDuties(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $datas = [
            'teacher_id'   => session('usercount'),
            'teacher_name' => trim($request->teacher_name),
            'du_academic'  => trim($request->du_academic),
            'du_education' => trim($request->du_education),
            'du_degree'    => trim($request->du_degree),
            'du_age'       => trim($request->du_age),
            'du_name'      => trim($request->du_name),
            'du_duty'      => trim($request->du_duty),
            'du_year_num'  => trim($request->du_year_num)
        ];
        dd($datas);
        $judge_datas = judgeDutiesField($datas);
        if($judge_datas['code'] == 1){
            return $judge_datas;
        }
        if(!$request->hasFile('du_file')){                     //判断用户是否添加证书
            $datas['du_road'] = '';
            return DutiesDatabase::addDutiesDatas($datas);
        }
        $datas['du_remark'] = trim($request->du_remark);
        $duties_image = $request->file('du_file');
        $judge_image  = judgeFileImage($duties_image);
        if($judge_image['code'] == 1){
            return $judge_image;
        }
        $disk = UploadSubjectionConfig::DUTIES;
        $subjection_duties = UploadSubjectionConfig::DUTIES_IMG;
        $add_image_road    = uploadFiles($subjection_duties,$duties_image,$disk);
        $datas['du_road']  = $add_image_road;
        $add_duties = DutiesDatabase::addDutiesDatas($datas);
        if($add_duties){
            return responseTojson(0,'添加担任职务信息成功');
        }
        deletefiles($disk,$add_image_road);
        return responseTojson(1,'添加担任职务信息失败');
    }
    //删除学术团体职务信息
    public function deleteDuties(Request $request){
        $du_id_datas    = $request->du_id_datas;
        $old_image_road = DutiesDatabase::selectImageRoadDatas($du_id_datas);
        $delete_duties  = DutiesDatabase::deleteDutiesDatas($du_id_datas);
        deleteAllFiles(UploadSubjectionConfig::DUTIES,$old_image_road);
        responseTojson(0,'删除成功');
    }
    //查看学术团体职务信息
    public function selectDuties(Request $request){
        $result = DutiesDatabase::selectDutiesDatas($request->du_id);
        return responseTojson(0,'查询成功','',$result);
    }
    //查看所有学术团体职务信息
    public function selectAllDuties(){
        $result = DutiesDatabase::selectAllDutiesDatas(session('usercount'));
        return responseTojson(0,'查询成功','',$result);
    }
    //修改学术团体职务信息
    public function updateDuties(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $du_road           = trim($request->du_road);
        $datas = [
            'du_id'        => trim($request->du_id),
            'teacher_name' => trim($request->teacher_name),
            'du_academic'  => trim($request->du_academic),
            'du_education' => trim($request->du_education),
            'du_degree'    => trim($request->du_degree),
            'du_age'       => trim($request->du_age),
            'du_name'      => trim($request->du_name),
            'du_duty'      => trim($request->du_duty),
            'du_year_num'  => trim($request->du_year_num)
        ];
        dd($datas);
        $judge_datas = judgeDutiesField($datas);
        if($judge_datas['code'] == 1){
            return $judge_datas;
        }
        $reset_image_status = false;
        $datas['du_road']   = $du_road;
        $datas['du_remark'] = trim($request->du_remark);
        if(!$request->hasFile('du_file')){//判断老师是否上传证书图片
            return DutiesDatabase::updateDutiesDatas($datas,$reset_image_status);
        }
        $reset_image_status = true;
        $duties_image = $request->file('du_file');
        $judge_image  = judgeFileImage($duties_image);
        if($judge_image['code'] == 1){
            return $judge_image;
        }
        $disk = UploadSubjectionConfig::DUTIES;
        $subjection_duties = UploadSubjectionConfig::DUTIES_IMG;
        DutiesDatabase::beginTraction();
        $new_image_road = uploadFiles($subjection_duties,$duties_image,$disk);
        $datas['du_road'] = $new_image_road;
        $reset_duties  = DutiesDatabase::updateDutiesDatas($datas,$reset_image_status);
        if($reset_duties){
            DutiesDatabase::commit();
            if(!empty($du_road)){
                deletefiles($disk,$du_road);
            }
            return responseTojson(0,'修改信息成功');
        }
        DutiesDatabase::rollback();
        deletefiles($disk,$new_image_road);
        return responseTojson(1,'修改信息失败');
    }
}