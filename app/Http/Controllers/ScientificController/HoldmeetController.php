<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HoldmeetController extends Controller
{
    //添加举行会议信息
    public function addHoldmeet()
    {

    }
    //删除举行会议信息
    public function deleteHoldmeet()
    {

    }
    //查看举行会议信息
    public function selectHoldmeet()
    {

    }
    //修改举行会议信息
    public function updateHoldmeet(Request $request)
    {
        $ho_name        = trim($request->ho_name);
        $ho_art_status  = trim($request->ho_art_status);
        $people_num     = trim($request->people_num);
        $ho_unit        = trim($request->ho_unit);
        $undertake_unit = trim($request->undertake_unit);
        $ho_level       = trim($request->ho_level);
        $ho_time        = trim($request->ho_time);

    }
}