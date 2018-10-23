<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use config\uploadsubjectionconfig;
use Illuminate\Http\Request;
use App\Model\DutiesDatabase;
class DutiesController extends Controller
{
    //添加学术团体职务信息
    public function addDuties(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
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
            'du_year_num'  => trim($request->du_year_num),
            'du_remark'    => trim($request->du_remark)
        ];
        $judge_datas = judgeDutiesField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        if(!$request->is_add_images){             //判断用户是否添加证书
            $datas['du_road'] = '';
            $add_duties = DutiesDatabase::addDutiesDatas($datas);
        }else{
            $duties_image = $request->file('duties_image');
            $judge_image  = judgeFileImage($duties_image);
            if($judge_image->code == 1){
                return $judge_image;
            }
            $add_image_road   = uploadFiles(uploadsubjectionconfig::DUTIES_IMG,$duties_image);
            $datas['du_road'] = $add_image_road;
            $add_duties       = DutiesDatabase::addDutiesDatas($datas);
        }
        if($add_duties){
            return showMsg(0,'添加担任职务信息成功');
        }
        deletefiles(uploadsubjectionconfig::DUTIES,$add_image_road);
        return showMsg(1,'添加担任职务信息失败');
    }
    //删除学术团体职务信息
    public function deleteDuties(){

    }
    //查看学术团体职务信息
    public function selectDuties(Request $request){
        $result = DutiesDatabase::selectDutiesDatas($request->du_id);
        return showMsg(0,'查询成功',$result);
    }
    //查看所有学术团体职务信息
    public function selectAllDuties(){
        $result = DutiesDatabase::selectAllDutiesDatas(session('usercount'));
        return showMsg(0,'查询成功',$result);
    }
    //修改学术团体职务信息
    public function updateDuties(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $du_id = $request->du_id;
        $datas = [
            'du_id'        => $du_id,
            'teacher_name' => trim($request->teacher_name),
            'du_academic'  => trim($request->du_academic),
            'du_education' => trim($request->du_education),
            'du_degree'    => trim($request->du_degree),
            'du_age'       => trim($request->du_age),
            'du_name'      => trim($request->du_name),
            'du_duty'      => trim($request->du_duty),
            'du_year_num'  => trim($request->du_year_num),
            'du_remark'    => trim($request->du_remark)
        ];
        $judge_datas = judgeDutiesField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        $is_reset_image = $request->is_reset_image;     //判断老师是否上传证书图片
        if(!$is_reset_image){
            return DutiesDatabase::updateDutiesDatas($datas);
        }
        $duties_image = $request->file('duties_image');
        $judge_image  = judgeFileImage($duties_image);
        if($judge_image->code == 1){
            return $judge_image;
        }
        $disk = uploadsubjectionconfig::DUTIES;
        DutiesDatabase::beginTraction();
        $old_image_road = DutiesDatabase::selectDutiesImageRoad($du_id);
        $new_image_road = uploadFiles(uploadsubjectionconfig::DUTIES_IMG,$duties_image);
        $datas['aw_road'] = $new_image_road;
        $reset_duties_  = DutiesDatabase::updateDutiesImage($datas);
        if(!$reset_duties_){
            DutiesDatabase::rollback();
            deletefiles($disk,$new_image_road);
            return showMsg(1,'修改信息失败');
        }
        DutiesDatabase::commit();
        deletefiles($disk,$old_image_road);
        return showMsg(0,'修改信息成功');
    }
}