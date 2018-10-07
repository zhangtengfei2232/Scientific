<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppraisalController extends Controller
{
    //添加成果鉴定
    public function addAppraisal()
    {

    }
    //删除鉴定成果
    public function deleteAppraisal()
    {

    }
    //查看成果鉴定
    public function selectAppraisal()
    {

    }
    //修改成功鉴定
    public function updateAppraisal(Request $request)
    {
         $ap_all_author = trim($request->ap_all_author);
         $ap_res_name   = trim($request->ap_res_name);
         $ap_form       = trim($request->ap_form);
         $ap_num        = trim($request->ap_num);
         $ap_conclu     = trim($request->ap_conclu);
         $ap_time       = trim($request->ap_time);
         $ap_level      = trim($request->ap_level);
         $ap_integral   = trim($request->ap_integral);
         $ap_remarks    = trim($request->ap_remarks);
    }

}