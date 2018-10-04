<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpusController  extends Controller
{
    //添加著作信息
    public function addOpus(Request $request)
    {

    }
    //删除著作信息
    public function deleteOpus(Request $request)
    {

    }
    //查看著作信息
    public function selectOpus(Request $request)
    {

    }
    //修改著作信息
    public function updateOpus(Request $request)
    {
        $op_name          = trim($request->op_name);
        $op_publish       = trim($request->op_publish);
        $op_form_write    = trim($request->op_form_write);
        $op_self_words    = trim($request->op_self_words);
        $op_cate_works    = trim($request->op_cate_works);
        $op_number        = trim($request->op_number);
        $op_remarks       = trim($request->op_remarks);
        $op_integral      = trim($request->op_integral);
        $op_all_author    = trim($request->op_all_author);
        $op_total_words   = trim($request->op_total_words);
        $op_sub_category  = trim($request->op_sub_category);
        $op_publish_time  = trim($request->op_publish_time);
        $op_cate_research = trim($request->op_cate_research);


    }






}