<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LectureDatabase;
use App\Model\ImageDatas;
use config\uploadSubjectionConfig;
class LectureController extends Controller
{
     //添加专家讲学信息
     public function addLecture(Request $request){
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         $datas = [
             'teacher_id'       => session('usercount'),
             'le_expert_name'   => trim($request->le_export_name),
             'le_expert_level'  => trim($request->le_export_level),
             'le_report_name'   => trim($request->le_report_name),
             'le_invite_status' => trim($request->le_invite_status),
             'le_invite_unit'   => trim($request->le_invite_unite),
             'le_time'          => strtotime(trim($request->le_time))
         ];
         $judge_datas = judgeLectureField($datas);
         if($judge_datas->code == 1){
             return $judge_datas;
         }
         return LectureDatabase::addLectureDatas($datas);
     }
     //添加专家讲学图注
     public function addLectureInject(Request $request){
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         if(!$request->is_add_lecture){
             return showMsg(1,'请你先添加讲学信息');
         }
         $lecture_inject = $request->file('lecture_inject');
         $judge_inject   = judgeFileImage($lecture_inject);
         if($judge_inject->code == 1){
             return $judge_inject;
         }
         $le_id = $request->le_id;
         $new_inject_road = uploadFiles(uploadSubjectionConfig::LECTURE_INJECTION,$lecture_inject);
         $add_inject      = LectureDatabase::updateLectureInjectRoad($le_id,$new_inject_road);
         if($add_inject){
             return showMsg(0,'添加会议图注成功');
         }
         deletefiles(uploadSubjectionConfig::LECTURE,$new_inject_road);
         return showMsg(1,'添加会议图注失败');

     }
     //添加专家讲学图片
     public function addLectureImages(Request $request){
         $validate = true;
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         if(!$request->is_add_lecture){
             return showMsg(1,'请你先添加讲学信息');
         }
         $hold_images = $request->file('hold_images');
         $judge_images = judgeAllFileImage($hold_images);
         if($judge_images->code == 1){
             $validate = false;
         }
         $success_images  = $judge_images['success_images'];
         $subjection      = uploadSubjectionConfig::LECTURE_IMG;
         $le_id           = $request->le_id;
         $all_images_road = uploadAllImgs($subjection,$success_images);
         $images_status   = uploadSubjectionConfig::LECTURE_IMG_STATUS;
         $add_images      = ImageDatas::addImagesDatas($all_images_road,$le_id,$images_status);
         if($validate && $add_images->code == 1){
             return showMsg(0,'全部图片添加成功');
         }
         if($add_images->code == 1){
             $delete_fail_images = [];
             $fail_images = [];
             for($i = 0; $i < count($add_images); $i++){
                 $index = $add_images->datas[$i];
                 //获取添加失败的图片名字
                 $fail_images_name = $success_images[$index]->getClientOriginalName();
                 $fail_images[$i]  = $fail_images_name;       //添加失败的图片名字数组
                 //取出添加数据库失败的图片路径
                 $delete_fail_images[$i] = $all_images_road[$index];//添加失败的图片路径数组
             }
             $disk = uploadSubjectionConfig::LECTURE;
             deleteAllImgs($disk,$delete_fail_images);
             $response['fail_images'] = $fail_images;
         }
         if(!$validate){
             //有的图片验证也没通过，错误信息也返回
             $response['error_images'] = $judge_images['error_images'];
         }
         return showMsg(1,'部分图片添加失败',$response);
     }
     //删除专家讲学信息
     public function deleteLecture(Request $request){

     }
     //删除多个专家讲学信息
     public function deleteAllLecture(){

     }
     //删除专家讲学图片
     public function deleteLectureImages(Request $request){
         $delete_le_id = $request->le_id_datas;
         //先去查询所有删除的图片路径
         $all_images_road = ImageDatas::selectAllImageRoadDatas($delete_le_id);
         ImageDatas::beginTraction();                                   //开启事务处理
         $delete_images = ImageDatas::deleteImagesDatas($delete_le_id); //删除数据库图片路径
         if($delete_images){
             ImageDatas::commit();
             deleteAllImgs(uploadSubjectionConfig::HOLD_MEET,$all_images_road);
             return showMsg(0,'删除举办会议图片成功');
         }
         ImageDatas::rollback();                                        //回滚，回复数据库数据
         return showMsg(1,'删除举办会议图片失败');
     }
     //查看单个专家讲学信息
     public function selectLecture(Request $request){
         $le_id = $request->le_id;
         $lecture_information = LectureDatabase::selectLectureDatas($le_id);
         $owner_status        = uploadSubjectionConfig::LECTURE_IMG_STATUS;
         $lecture_images      = ImageDatas::selectAllOwnerImage($le_id,$owner_status);
         $datas['lecture_information'] = $lecture_information;
         $datas['lecture_images']      = $lecture_images;
         return showMsg(0,'查询成功',$datas);
     }
     //查看所有专家讲学信息
     public function selectAllLecture(){
         $result = LectureDatabase::selectLectureAllDatas(session('usercount'));
         return showMsg(0,'查询成功',$result);
     }
     //修改专家讲学信息
     public function updateLecture(Request $request){
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         $datas = [
             'le_id'            => trim($request->le_id),
             'le_expert_name'   => trim($request->le_export_name),
             'le_expert_level'  => trim($request->le_export_level),
             'le_report_name'   => trim($request->le_report_name),
             'le_invite_status' => trim($request->le_invite_status),
             'le_invite_unit'   => trim($request->le_invite_unite),
             'le_time'          => strtotime(trim($request->le_time))
         ];
         $judge_datas = judgeLectureField($datas);
         if($judge_datas->code == 1){
             return $judge_datas;
         }
         return LectureDatabase::updateLectureDatas($datas);
     }
     //修改会议图注信息
     public function updateLectureInject(Request $request){
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         $update_inject = $request->file('lecture_inject');
         $judge_inject  = judgeFileImage($update_inject);
         if($judge_inject->code == 1){
             return $judge_inject;
         }
         $le_id = $request->le_id;
         $old_inject_road   = LectureDatabase::selectLectureInject($le_id);
         $disk              = uploadSubjectionConfig::LECTURE;
         $new_inject_road   = uploadFiles(uploadSubjectionConfig::LECTURE_INJECTION,$update_inject);
         $reset_inject_road = LectureDatabase::updateLectureInjectRoad($le_id,$new_inject_road);
         if($reset_inject_road){
             deletefiles($disk,$old_inject_road);
             return showMsg(0,'修改讲学图注成功');
         }
         deletefiles($disk,$new_inject_road);
         return showMsg(1,'修改会议图注失败');
     }
}