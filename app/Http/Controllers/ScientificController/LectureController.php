<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LectureDatabase;
use App\Model\ImageDatas;
use config\uploadsubjectionconfig;
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
         $new_inject_road = uploadFiles(uploadsubjectionconfig::LECTURE_INJECTION,$lecture_inject);
         $add_inject      = LectureDatabase::updateLectureInjectRoad($le_id,$new_inject_road);
         if($add_inject){
             return showMsg(0,'添加会议图注成功');
         }
         deletefiles(uploadsubjectionconfig::LECTURE,$new_inject_road);
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
         $subjection      = uploadsubjectionconfig::LECTURE_IMG;
         $le_id           = $request->le_id;
         $new_images_road = uploadAllImgs($subjection,$success_images);
         $images_status   = uploadsubjectionconfig::LECTURE_IMG_STATUS;
         $add_images      = ImageDatas::addImagesDatas();


     }
     //删除专家讲学信息
     public function deleteLecture(Request $request){

     }
     //删除专家讲学图片
     public function deleteLectureImages(Request $request){

     }
     //查看单个专家讲学信息
     public function selectLecture(Request $request){

     }
     //查看所有专家讲学信息
     public function selectAllLecture(){

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
         $disk              = uploadsubjectionconfig::LECTURE;
         $new_inject_road   = uploadFiles(uploadsubjectionconfig::LECTURE_INJECTION,$update_inject);
         $reset_inject_road = LectureDatabase::updateLectureInjectRoad($le_id,$new_inject_road);
         if($reset_inject_road){
             deletefiles($disk,$old_inject_road);
             return showMsg(0,'修改讲学图注成功');
         }
         deletefiles($disk,$new_inject_road);
         return showMsg(1,'修改会议图注失败');
     }
}