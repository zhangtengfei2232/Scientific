<?php

namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JoinmeetController  extends Controller
{
    //添加参加会议信息
    public function addJoinmeet()
    {

    }
    //删除参加会议信息
    public function deleteJoinmeet()
    {

    }
    //查看参加会议信息
    public function selectJoinmeet()
    {

    }
    //修改参加会议信息
    public function updateJoinmeet(Request $request)
    {
       $join_people  = trim($request->join_people);
       $join_name    = trim($request->join_name);
       $jo_hold_unit = trim($request->jo_hold_unit);
       $jo_take_unit = trim($request->jo_take_unit);
       $join_level   = trim($request->join_level);
       $jo_time      = trim($request->jo_time);
       $jo_place     = trim($request->jo_place);
       $jo_art_num   = trim($request->jo_art_num);
       $jo_is_invite = trim($request->jo_is_invite);
       $jo_title     = trim($request->jo_title);

    }
}