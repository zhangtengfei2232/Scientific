<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ArticalDatabase;
use App\Model\ModelDatabase;
use Illuminate\Http\Request;
use App\Model\AwardDatabase;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
class AwardController extends Controller
{
     private $disk       = UploadSubjectionConfig::AWARD;
     private $subjection = UploadSubjectionConfig::AWARD_IMG;
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
             return responseTojson(1,$judge_datas['message']);
         }
         if(!$request->hasFile('aw_road')){
             $datas['aw_road'] = '';
             return AwardDatabase::addAwardDatas($datas);
         }
         $award_image = $request->file('aw_road');
         $judge_image = judgeReceiveFiles($award_image);
         if($judge_image['code'] == 1){
             return responseTojson(1,$judge_image['message']);
         }
         $add_image_road   = uploadFiles($this->subjection,$award_image,$this->disk);
         $datas['aw_road'] = $add_image_road;
         $add_award = AwardDatabase::addAwardDatas($datas);
         if($add_award){
             return responseTojson(0,'添加获奖信息成功');
         }
         deletefiles($this->disk,$add_image_road);
         return responseTojson(1,'添加获奖信息失败');
     }
     //删除获奖信息
     public function deleteAward(Request $request){
         $aw_id_datas   = $request->aw_id_datas;
         $old_image_rod = AwardDatabase::selectAwardRoadDatas($aw_id_datas);
         $table_name    = SearchMessageConfig::AWARD_TABLE;
         $id_field      = SearchMessageConfig::AWARD_ID;
         ModelDatabase::beginTraction();
         $delete_award  = ModelDatabase::deleteAllDatas($table_name,$id_field,$aw_id_datas);
         if($delete_award) {
             ModelDatabase::commit();
             deleteAllFiles(UploadSubjectionConfig::AWARD, $old_image_rod);
             return responseTojson(0, '删除成功');
         }
         ModelDatabase::rollback();
         return responseTojson(1,'删除失败');
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
    //根据时间区间搜索获奖信息
    public function timeSelectAward(Request $request){
        $teacher_id = session('usercount');
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::AWARD_TABLE;
        $time_field = SearchMessageConfig::AW_GRANT_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
     //修改获奖信息
     public function updateAward(Request $request){
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         $aw_id[0]    = trim($request->aw_id);
         $aw_road  = AwardDatabase::selectAwardRoadDatas($aw_id);
         (empty($aw_road)) ? $aw_road = '' : $aw_road = $aw_road[0];
         $datas = [
             'aw_id'            => $aw_id,
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
             return responseTojson(1,$judge_datas['message']);
         }
         $reset_image_status = false;
         if(!$request->hasFile('aw_road')){
            $datas['aw_road'] = $aw_road;
            return AwardDatabase::updateAwardDatas($datas,$reset_image_status);
         }
         $reset_image_status = true;
         $award_image = $request->file('aw_road');
         $judge_image = judgeReceiveFiles($award_image);
         if($judge_image['code'] == 1){
             return responseTojson(1,$judge_image['message']);
         }
         AwardDatabase::beginTraction();
         $new_image_road   = uploadFiles($this->subjection,$award_image,$this->disk);
         $datas['aw_road'] = $new_image_road;
         $reset_award      = AwardDatabase::updateAwardDatas($datas,$reset_image_status);
         if($reset_award){
             ArticalDatabase::commit();
             if(!empty($aw_road)){
                 deletefiles($this->disk,$aw_road);
             }
             return responseTojson(0,'修改获奖信息成功');
         }
         ArticalDatabase::rollback();
         deletefiles($this->disk,$new_image_road);
         return responseTojson(1,'修改获奖信息失败');
     }
}