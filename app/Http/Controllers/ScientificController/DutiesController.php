<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DutiesController extends Controller
{
    //添加学术团体职务信息
    public function addDuties()
    {

    }
    //删除学术团体职务信息
    public function deleteDuties()
    {

    }
    //查看学术团体职务信息
    public function selectDuties()
    {

    }
    //修改学术团体职务信息
    public function updateDuties(Request $request)
    {
        $du_academic  = trim($request->du_academic);
        $du_education = trim($request->du_education);
        $du_degree    = trim($request->du_degree);
        $du_age       = trim($request->du_age);
        $du_name      = trim($request->du_name);
        $du_duty      = trim($request->du_duty);
        $du_year_num  = trim($request->du_year_num);
    }
}