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
             return responseTojson(1,'你请求的方式不对');
         }
         $datas = [
             'teacher_id'       => session('usercount'),
             'aw_first_author'  => trim($request->aw_first_author),
             'aw_all_author'    => trim($request->aw_all_author),
             'prize_win_name'   => trim($request->prize_win_name),
             'award_name'       => trim($request->award_name),
             'form_achievement' => trim($request->form_achievement),
             'aw_level'         => trim($request->aw_level),
             'aw_grade'         => trim($request->aw_grade),
             'aw_grant_unit'    => trim($request->aw_grant_unit),
             'aw_grant_time'    => trim($request->aw_grant_time),
             'aw_certi_number'  => trim($request->aw_certi_number),
             'aw_sch_rank'      => trim($request->aw_sch_rank),
             'aw_integral'      => trim($request->aw_integral)
         ];
         $judge_datas = judgeAwardField($datas);
         if($judge_datas['code'] == 1){
             return $judge_datas;
         }
         if(!$request->hasFile('aw_pic')){
             $datas['aw_road'] = '';
             return AwardDatabase::addAwardDatas($datas);
         }
         $award_image = $request->file('aw_pic');
         $judge_image = judgeFileImage($award_image);
         if($judge_image['code'] == 1){
             return $judge_image;
         }
         $disk             = UploadSubjectionConfig::AWARD;
         $subjection_image = UploadSubjectionConfig::AWARD_IMG;
         $add_image_road   = uploadFiles($subjection_image,$award_image,$disk);
         $datas['aw_road'] = $add_image_road;
         $add_award = AwardDatabase::addAwardDatas($datas);
         if($add_award){
             return responseTojson(0,'添加获奖信息成功');
         }
         deletefiles($disk,$add_image_road);
         return responseTojson(1,'添加获奖信息失败');
     }
     //删除获奖信息
     public function deleteAward(Request $request){
         $aw_id_datas = $request->aw_id_datas;
         $old_image_rod = AwardDatabase::selectAwardRoadDatas($aw_id_datas);
         $delete_award  = AwardDatabase::deleteAwardDatas($aw_id_datas);
         deleteAllFiles(UploadSubjectionConfig::AWARD,$old_image_rod);
         responseTojson(0,'删除成功');
     }
     //查看单个获奖信息
     public function selectAward(Request $request){
         $result = AwardDatabase::selectAwardDatas($request->aw_id);
         return responseTojson(0,'查询成功','',$result);
     }
     //查看所有获奖信息
     public function selectAllAward(){
         $result = AwardDatabase::selectAllAwardDatas(session('usercount'));
         return responseTojson(0,'查询成功','',$result);
     }
     //修改获奖信息
     public function updateAward(Request $request){
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         $aw_id[0] = trim($request->aw_id);
         $aw_road  = trim($request->aw_road);
         $datas = [
             'aw_id'            => $aw_id[0],
             'aw_first_author'  => trim($request->aw_first_author),
             'aw_all_author'    => trim($request->aw_all_author),
             'prize_win_name'   => trim($request->prize_win_name),
             'award_name'       => trim($request->award_name),
             'form_achievement' => trim($request->form_achievement),
             'aw_category'      => trim($request->aw_category),
             'aw_level'         => trim($request->aw_level),
             'aw_grade'         => trim($request->aw_grade),
             'aw_grant_unit'    => trim($request->aw_grant_unit),
             'aw_grant_time'    => trim($request->aw_grant_time),
             'aw_certi_number'  => trim($request->aw_certi_number),
             'aw_sch_rank'      => trim($request->aw_sch_rank),
             'aw_integral'      => trim($request->aw_integral),
             'aw_road'          => $aw_road
         ];
         $judge_datas = judgeAwardField($datas);
         if($judge_datas['code'] == 1){
             return $judge_datas;
         }
         $reset_image_status = false;
         if(!$request->hasFile('aw_file')){
            return AwardDatabase::updateAwardDatas($datas,$reset_image_status);
         }
         $reset_image_status = true;
         $award_image = $request->file('aw_file');
         $judge_image = judgeFileImage($award_image);
         if($judge_image['code'] == 1){
             return $judge_image;
         }
         $disk = UploadSubjectionConfig::AWARD;
         $subjection_award = UploadSubjectionConfig::AWARD_IMG;
         AwardDatabase::beginTraction();
         $new_image_road   = uploadFiles($subjection_award,$award_image,$disk);
         $datas['aw_road'] = $new_image_road;
         $reset_award      = AwardDatabase::updateAwardDatas($datas,$reset_image_status);
         if($reset_award){
             ArticalDatabase::commit();
             deleteAllFiles($disk,$aw_road);
             return responseTojson(0,'修改获奖信息成功');
         }
         ArticalDatabase::rollback();
         deletefiles($disk,$new_image_road);
         return responseTojson(1,'修改获奖信息失败');
     }
}