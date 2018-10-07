<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AwardController extends Controller
{
     //添加获奖信息
     public function addAward(Request $request)
     {

     }
     //删除获奖信息
     public function deleteAward(Request $request)
     {

     }
     //查看获奖信息
     public function selectAward(Request $request)
     {

     }
     //修改获奖信息
     public function updateAward(Request $request)
     {
         $aw_category      = trim($request->aw_category);
         $aw_sch_rank      = trim($request->aw_sch_rank);
         $aw_integral      = trim($request->aw_integral);
         $aw_all_author    = trim($request->aw_all_author);
         $aw_grade         = trim($request->aw_grade);
         $award_name       = trim($request->award_name);
         $aw_grant_unit    = trim($request->aw_grant_unit);
         $aw_grant_time    = trim($request->aw_grant_time);
         $prize_win_name   = trim($request->prize_win_name);
         $aw_certi_number  = trim($request->aw_certi_number);
         $form_achievement = trim($request->form_achievement);
     }
}