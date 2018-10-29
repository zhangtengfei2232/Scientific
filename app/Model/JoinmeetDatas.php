<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
class JoinmeetDatas extends ModelDatabase
{
    //添加参加会议信息
    public static function addJoinmeetDatas($datas){
        $jo_graph_inject = $datas['jo_graph_inject'];
        $response = DB::tabel('joinmeet')
                    ->insert([
                        'teacher_id'      => $datas['teacher_id'],
                        'join_people'     => $datas['join_people'],
                        'jo_name'         => $datas['jo_name'],
                        'jo_hold_unit'    => $datas['jo_hold_unit'],
                        'jo_take_unit'    => $datas['jo_take_unit'],
                        'jo_level'        => $datas['jo_level'],
                        'jo_time'         => $datas['jo_time'],
                        'jo_place'        => $datas['jo_place'],
                        'jo_art_num'      => $datas['jo_art_num'],
                        'jo_is_invite'    => $datas['jo_is_invite'],
                        'jo_title'        => $datas['jo_title'],
                        'jo_graph_inject' => $jo_graph_inject
                    ]);
        if(empty($jo_graph_inject)){
            return ($response) ? responseTojson(0,'添加参加会议信息成功')
                   : responseTojson(1,'添加参加会议信息失败');
        }
        return ($response) ? responseTojson(0,'',1,$response)
               : responseTojson(1,'',1);
    }
    //删除参加会议信息
    public static function deleteJoinmeetDatas(){

    }
    //修改参加会议信息
    public static function updateJoinmeetDatas($datas){
        $response = DB::table('joinmeet')->where('jo_id',$datas->jo_id)
                    ->update([
                        'join_people'  => $datas['join_people'],
                        'jo_name'      => $datas['jo_name'],
                        'jo_hold_unit' => $datas['jo_hold_unit'],
                        'jo_take_unit' => $datas['jo_take_unit'],
                        'jo_level'     => $datas['jo_level'],
                        'jo_time'      => $datas['jo_time'],
                        'jo_place'     => $datas['jo_place'],
                        'jo_art_num'   => $datas['jo_art_num'],
                        'jo_is_invite' => $datas['jo_is_invite'],
                        'jo_title'     => $datas['jo_title']
                    ]);
        return ($response != 1) ? showMsg(1,'修改参加会议信息失败')
               : showMsg(0,'修改参加会议信息成功');

    }
    //修改参加会议图注路径
    public static function updateJoinmeetInjectRoad($jo_id,$new_inject_road){
        $response = DB::table('joinmeet')->where('jo_id',$jo_id)
                    ->update(['jo_graph_inject' => $new_inject_road]);
        return ($response != 1) ? true : false;
    }
    //查看参加会议信息
    public static function selectJoinmeetDatas($jo_id){
        $result = DB::table('joinmeet')->where('jo_id')->first();
        $result->jo_time = date('Y-m-d',$result->jo_time);
        return $result;
    }
    //查看所有会议
    public static function selectAllJoinmeetDatas($teacher_id){
        $result = DB::table('joinmeet')->where('teacher_id',$teacher_id)->orderBy('jo_time','desc')->get();
        foreach ($result as $datas){
            $datas->jo_time = date('Y-m-d',$datas->jo_time);
        }
        return $result;
    }
    //查看参加会议图注路径
    public static function selectJoinmeetInjectRoad($jo_id){
        $result = DB::table('joinmeet')->select('jo_graph_inject')->where('jo_id',$jo_id)->first();
        return $result->jo_graph_inject;
    }

}