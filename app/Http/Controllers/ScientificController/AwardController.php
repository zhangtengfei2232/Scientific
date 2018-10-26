<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use App\Model\ArticalDatabase;
use Illuminate\Http\Request;
use App\Model\AwardDatabase;
use config\UploadSubjectionConfig;
class AwardController extends Controller
{
     //添加获奖信息
     public function addAward(Request $request){
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         $datas = [
             'teacher_id'       => session('usercount'),
             'aw_first_author'  => trim($request->aw_first_author),
             'aw_all_author'    => trim($request->aw_all_author),
             'prize_win_name'   => trim($request->prize_win_name),
             'award_name'       => trim($request->award_name),
             'form_achievement' => trim($request->form_achievement),
             'aw_category'      => trim($request->aw_category),
             'aw_level'         => trim($request->aw_level),
             'aw_grade'         => trim($request->aw_grade),
             'aw_grant_unit'    => trim($request->aw_grant_unit),
             'aw_grant_time'    => strtotime(trim($request->aw_grant_time)),
             'aw_certi_number'  => trim($request->aw_certi_number),
             'aw_sch_rank'      => trim($request->aw_sch_rank),
             'aw_integral'      => trim($request->aw_integral)
         ];
         $judge_datas = judgeAwardField($datas);
         $disk        = UploadSubjectionConfig::AWARD;
         if($judge_datas->code == 1){
             return $judge_datas;
         }
         if(!$request->is_add_image){                             //判断用户是否添加证书
             $datas['aw_road'] = '';
             $add_award = AwardDatabase::addAwardDatas($datas);
         }else{
             $award_image = $request->file('award_image');
             $judge_image = judgeFileImage($award_image);
             if($judge_image->code == 1){
                 return $judge_image;
             }
             $subjection_image = UploadSubjectionConfig::AWARD_IMG;
             $add_image_road   = uploadFiles($subjection_image,$award_image,$disk);
             $datas['aw_road'] = $add_image_road;
             $add_award = AwardDatabase::addAwardDatas($datas);
         }
         if($add_award){
             return showMsg(0,'添加获奖信息成功');
         }
         deletefiles($disk,$add_image_road);
         return showMsg(1,'添加获奖信息失败');
     }
     //删除获奖信息
     public function deleteAward(Request $request){

     }
     //删除多个获奖信息
     public function deleteAllAward(){

     }
     //查看单个获奖信息
     public function selectAward(Request $request){
         $result = AwardDatabase::selectAwardDatas($request->aw_id);
         return showMsg(0,'查询成功',$result);
     }
     //查看所有获奖信息
     public function selectAllAward(){
         $result = AwardDatabase::selectAllAwardDatas(session('usercount'));
         return showMsg(0,'查询成功',$result);
     }
     //修改获奖信息
     public function updateAward(Request $request){
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         $aw_id = trim($request->aw_id);
         $datas = [
             'aw_id'            => $aw_id,
             'aw_first_author'  => trim($request->aw_first_author),
             'aw_all_author'    => trim($request->aw_all_author),
             'prize_win_name'   => trim($request->prize_win_name),
             'award_name'       => trim($request->award_name),
             'form_achievement' => trim($request->form_achievement),
             'aw_category'      => trim($request->aw_category),
             'aw_level'         => trim($request->aw_level),
             'aw_grade'         => trim($request->aw_grade),
             'aw_grant_unit'    => trim($request->aw_grant_unit),
             'aw_grant_time'    => strtotime(trim($request->aw_grant_time)),
             'aw_certi_number'  => trim($request->aw_certi_number),
             'aw_sch_rank'      => trim($request->aw_sch_rank),
             'aw_integral'      => trim($request->aw_integral)
         ];
         $judge_datas = judgeAwardField($datas);
         if($judge_datas->code == 1){
             return $judge_datas;
         }
         $is_reset_image = $request->is_reset_image;                    //判断老师是否上传证书图片
         if(!$is_reset_image){
            return AwardDatabase::updateAwardDatas($datas);
         }
         $award_image = $request->file('award_image');
         $judge_image = judgeFileImage($award_image);
         if($judge_image->code == 1){
             return $judge_image;
         }
         $disk = UploadSubjectionConfig::AWARD;
         $subjection_award = UploadSubjectionConfig::AWARD_IMG;
         AwardDatabase::beginTraction();
         $old_image_road   = AwardDatabase::selectAwardRoadDatas($aw_id);
         $new_image_road   = uploadFiles($subjection_award,$award_image,$disk);
         $datas['aw_road'] = $new_image_road;
         $reset_award      = AwardDatabase::updateAwardImage($datas);
         if(!$reset_award){
             ArticalDatabase::rollback();
             deletefiles($disk,$new_image_road);
             return showMsg(1,'修改获奖信息失败');
         }
         ArticalDatabase::commit();
         deletefiles($disk,$old_image_road);
         return showMsg(0,'修改获奖信息成功');
     }
}