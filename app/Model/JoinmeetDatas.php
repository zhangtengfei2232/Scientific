<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
class JoinmeetDatas extends ModelDatabase
{
    //添加参加会议信息
    public static function addJoinmeetDatas($datas){
        $jo_graph_inject = $datas['jo_graph_inject'];
        $jo_id = DB::table('joinmeet')
                    ->insertGetId([
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
            return ($jo_id > 0) ? responseTojson(0,'添加参加会议信息成功','',$jo_id)
                   : responseTojson(1,'添加参加会议信息失败');
        }
        return $jo_id;
    }
    //修改参加会议信息
    public static function updateJoinmeetDatas($datas,$reset_inject_status){
        $response = DB::table('joinmeet')->where('jo_id',$datas['jo_id'])
                    ->update([
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
                        'jo_graph_inject' => $datas['jo_graph_inject']
                    ]);
        if($reset_inject_status){
            return ($response != 1) ? false : true;
        }
        return ($response != 1) ? responseTojson(1,'修改参加会议信息失败')
               : responseTojson(0,'修改参加会议信息成功');
    }
    //查看参加会议信息
    public static function selectJoinmeetDatas($jo_id){
        return DB::table('joinmeet')->where('jo_id',$jo_id)->first();
    }
    //查看所有会议
    public static function selectAllJoinmeetDatas($teacher_id){
        $result = DB::table('joinmeet')->where('teacher_id',$teacher_id)->orderBy('jo_time','desc')->get();
        foreach ($result as $datas){
            $datas->jo_time = date('Y-m-d',$datas->jo_time/1000);
        }
        return $result;
    }
    //查看参加会议图注路径
    public static function selectJoinmeetInjectRoad($jo_id_datas){
        $image_road_datas = [];
        for($i = 0; $i < count($jo_id_datas); $i++){
            $road = DB::table('joinmeet')->select('jo_graph_inject')->where('jo_id',$jo_id_datas[$i])->first();
            $image_road_datas[$i] = $road->jo_graph_inject;
        }
        return $image_road_datas;
    }
}