<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppraisalDatabase;
use config\uploadsubjectionconfig;
class AppraisalController extends Controller
{
    //添加成果鉴定
    public function addAppraisal()
    {

    }
    //添加成功鉴定证书和封面图片
    public function addAppraisalImage(){

    }
    //删除鉴定成果
    public function deleteAppraisal()
    {

    }
    //查看单个成果鉴定信息
    public function selectAppraisal()
    {

    }
    //查看所有成果鉴定信息
    public function selectAllAppraisal(){

    }
    //修改成功鉴定
    public function updateAppraisal(Request $request)
    {
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
         $datas = [
             'ap_id'           => trim($request->ap_id),
             'ap_first_author' => trim($request->ap_first_author),
             'ap_all_author'   => trim($request->ap_all_author),
             'ap_res_name'     => trim($request->ap_res_name),
             'ap_form'         => trim($request->ap_form),
             'ap_num'          => trim($request->ap_num),
             'ap_conclusion'   => trim($request->ap_conclusion),
             'ap_time'         => strtotime(trim($request->ap_time)),
             'ap_level'        => trim($request->ap_level),
             'ap_integral'     => trim($request->ap_integral),
             'ap_remarks'      => trim($request->ap_remarks)
         ];
        $judge_datas = judgeAppraisalField($datas);
        if($judge_datas->code ==1){
            return $judge_datas;
        }

    }
    //修改成果鉴定证书和封面图片
    public function updateAppraisalImage(){

    }

}