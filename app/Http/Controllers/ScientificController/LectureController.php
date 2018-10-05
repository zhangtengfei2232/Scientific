<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LectureController extends Controller
{
     //添加专家讲学信息
     public function addLecture()
     {

     }
     //删除专家讲学信息
     public function deleteLecture()
     {

     }
     //查看专家讲学信息
     public function selectLecture()
     {

     }
     //修改专家讲学信息
     public function updateLecture(Request $request)
     {
         $le_export_name   = trim($request->le_export_name);
         $le_export_level  = trim($request->le_export_level);
         $le_report_name   = trim($request->le_report_name);
         $le_invite_status = trim($request->le_invite_status);
         $le_invite_unit   = trim($request->le_invite_unite);
         $le_time          = trim($request->le_time);

     }
}