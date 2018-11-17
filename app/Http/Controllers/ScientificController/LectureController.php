<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use Illuminate\Http\Request;
use App\Model\LectureDatabase;
use App\Model\ImageDatas;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
class LectureController extends Controller
{
     //添加专家讲学信息
     public function addLecture(Request $request){
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         $datas = [
             'teacher_id'       => session('usercount'),
             'le_expert_name'   => trim($request->le_expert_name),
             'le_expert_level'  => trim($request->le_expert_level),
             'le_report_name'   => trim($request->le_report_name),
             'le_invite_status' => trim($request->le_invite_status),
             'le_invite_unit'   => trim($request->le_invite_unit),
             'le_time'          => trim($request->le_time)
         ];
         $judge_datas = judgeLectureField($datas);
         if($judge_datas['code'] == 1){
             return responseTojson(1,$judge_datas['message']);
         }
         if(!$request->hasFile('le_img_road')){
             $datas['le_img_road'] = '';
             return LectureDatabase::addLectureDatas($datas);
         }
         $lecture_inject = $request->file('le_img_road');
         $judge_inject   = judgeFileImage($lecture_inject);
         if($judge_inject['code'] == 1){
             return responseTojson(1,$judge_inject['message']);
         }
         $disk  = UploadSubjectionConfig::LECTURE;
         $subjection_lecture   = UploadSubjectionConfig::LECTURE_INJECTION;
         $new_inject_road      = uploadFiles($subjection_lecture,$lecture_inject,$disk);
         $datas['le_img_road'] = $new_inject_road;
         $add_lecture          = LectureDatabase::addLectureDatas($datas);
         if($add_lecture > 0){
             return responseTojson(0,'添加讲学信息成功','',$add_lecture);
         }
         deletefiles(UploadSubjectionConfig::LECTURE,$new_inject_road);
         return responseTojson(1,'添加讲学信息失败');
     }
     //删除专家讲学信息
     public function deleteLecture(Request $request){
         $delete_image    = true;
         $le_id_datas     = $request->le_id_datas;
         $table_name      = SearchMessageConfig::LECTURE_TABLE;
         $id_field        = SearchMessageConfig::LECTURE_ID;
         $old_inject_road = LectureDatabase::selectLectureInject($le_id_datas);
         $owner_status    = UploadSubjectionConfig::LECTURE_IMG_STATUS;
         $old_image_road  = ImageDatas::selectAllOwnerImage($le_id_datas,$owner_status);
         LectureDatabase::beginTraction();
         $delete_lecture  = ModelDatabase::deleteAllDatas($table_name,$id_field,$le_id_datas);
         if(count($old_image_road) > 1){
             $delete_image    = ImageDatas::byOwnerdeleteImagesDatas($le_id_datas);
         }
         if($delete_image && $delete_lecture){
             LectureDatabase::commit();
             $image_road      = array_merge($old_inject_road,$old_image_road);  //讲学图片和图注合并
             deleteAllFiles(UploadSubjectionConfig::LECTURE,$image_road);
             return responseTojson(0,'删除讲学信息成功');
         }
         LectureDatabase::rollback();
         return responseTojson(1,'删除讲学信息失败');
     }
     //查看单个专家讲学信息
     public function selectLecture(Request $request){
         $le_id               = $request->le_id;
         $lecture_information = LectureDatabase::selectLectureDatas($le_id);
         $image_status        = UploadSubjectionConfig::LECTURE_IMG_STATUS;
         $lecture_images      = ImageDatas::selectImageDatas($le_id,$image_status);
         $datas['lecture_information'] = $lecture_information;
         $datas['lecture_images']      = $lecture_images;
         return responseTojson(0,'查询成功','',$datas);
     }
     //查看所有专家讲学信息
     public function selectAllLecture(){
         $result = LectureDatabase::selectLectureAllDatas(session('usercount'));
         return responseTojson(0,'查询成功','',$result);
     }
    //根据时间区间搜索成果鉴定
    public function timeSelectLecture(Request $request){
         $teacher_id = session('usercount');
         $start_time = $request->start_time;
         $end_time   = $request->end_time;
         $table_name = SearchMessageConfig::LECTURE_TABLE;
         $time_field = SearchMessageConfig::LE_TIME;
         return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
     //修改专家讲学信息
    public function updateLecture(Request $request){
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         $le_id[0] = trim($request->le_id);
         $datas = [
             'le_id'            => $le_id[0],
             'le_expert_name'   => trim($request->le_expert_name),
             'le_expert_level'  => trim($request->le_expert_level),
             'le_report_name'   => trim($request->le_report_name),
             'le_invite_status' => trim($request->le_invite_status),
             'le_invite_unit'   => trim($request->le_invite_unite),
             'le_time'          => trim($request->le_time)
         ];
         $judge_datas = judgeLectureField($datas);
         if($judge_datas['code'] == 1){
             return responseTojson(1,$judge_datas['message']);
         }
         $reset_inject_status = false;
         if(!$request->hasFile('le_img_road')){
             $datas['le_img_road'] = trim($request->le_img_road);
             return LectureDatabase::updateLectureDatas($datas,$reset_inject_status);
         }
         $reset_inject_status = true;
         $update_inject = $request->file('le_img_road');
         $judge_inject  = judgeFileImage($update_inject);

         if($judge_inject->code == 1){
             return responseTojson(1,$judge_inject['message']);
         }
         $old_inject_road      = LectureDatabase::selectLectureInject($le_id);
         $disk                 = UploadSubjectionConfig::LECTURE;
         $subjection_lecture   = UploadSubjectionConfig::LECTURE_INJECTION;
         $new_inject_road      = uploadFiles($subjection_lecture,$update_inject,$disk);
         $datas['le_img_road'] = $new_inject_road;
         $reset_lecture        = LectureDatabase::updateLectureDatas($datas,$reset_inject_status);
         if($reset_lecture){
             deletefiles($disk,$old_inject_road[0]);
             return responseTojson(0,'修改讲学信息成功');
         }
         deletefiles($disk,$new_inject_road);
         return responseTojson(1,'修改讲学信息失败');
     }
    //添加专家讲学图片
    public function addLectureImages(Request $request){
         if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
         }
         if($request->has('is_add_lecture')){
             if(!$request->is_add_lecture){
                 return responseTojson(1,'请你先添加讲学信息');
             }
         }
         if(count($request->file()) < 1){
            return responseTojson(1,'请你上传专家讲学图片');
         }
         $lecture_images = $request->file();
         $judge_images = judgeAllFileImage($lecture_images);
         if($judge_images['code'] == 1){
            return responseTojson(1,'图片上传失败');
         }
         $disk = UploadSubjectionConfig::LECTURE;
         $subjection      = UploadSubjectionConfig::LECTURE_IMG;
         $le_id           = $request->le_id;
         $all_images_road = uploadAllImgs($subjection,$lecture_images,$disk);
         $images_status   = UploadSubjectionConfig::LECTURE_IMG_STATUS;
         return ImageDatas::addImagesDatas($all_images_road,$le_id,$images_status);
    }
    //删除专家讲学图片
    public function deleteLectureImage(Request $request){
         $delete_im_id = $request->im_id;
         //先去查询所有删除的图片路径
         $images_road   = ImageDatas::selectAllImageRoadDatas($delete_im_id);
         ImageDatas::beginTraction();                                   //开启事务处理
         $delete_images = ImageDatas::deleteImagesDatas($delete_im_id); //删除数据库图片路径
         if($delete_images){
            ImageDatas::commit();
             deletefiles(UploadSubjectionConfig::HOLD_MEET,$images_road);
            return responseTojson(0,'删除举办会议图片成功');
         }
         ImageDatas::rollback();                                        //回滚，回复数据库数据
         return responseTojson(1,'删除举办会议图片失败');
    }
}