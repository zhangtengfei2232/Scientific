<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class HoldmeetDatas extends ModelDatabase
{
    //添加会议信息
    public static function addHoldmeetDatas($datas){
        $response = DB::table('holdmeet')
                    ->insertGetId([
                        'teacher_id'     => $datas->teacher_id,
                        'ho_name'        => $datas->ho_name,
                        'ho_art_status'  => $datas->ho_art_status,
                        'people_num'     => $datas->people_num,
                        'ho_unit'        => $datas->ho_unit,
                        'undertake_unit' => $datas->undertake_unit,
                        'ho_level'       => $datas->ho_level,
                        'ho_time'        => $datas->ho_time
                    ]);
        return ($response) ? showMsg(0,'添加会议信息成功',$response)
               : showMsg(1,'添加信息失败');
    }
    //删除会议信息
    public static function deleteHoldmeetDatas(){

    }
    //查看所有会议信息
    public static function selectAllHoldmeetDatas($teacher_id){
        $result = DB::table('image')->where('teacher_id',$teacher_id)->orderBy('ho_time','desc')->get();
        foreach ($result as $datas){
            $result->ho_time = date('Y-m-d',$datas->ho_time);
        }
        return $result;
    }
    //查看单个会议信息
    public static function selectHoldmetDatas($ho_id){
        $result = DB::table('image')->where('ho_id',$ho_id)->first();
        $result->ho_time = date('Y-m-d',$result->ho_time);
        return $result;
    }
    //查看以前会议图注路径
    public static function selectHoldmeetInjectRoad($ho_id){
        $result = DB::table('holdmeet')->select('ho_graph_inject')->where('ho_id',$ho_id)->first();
        return  $result->ho_graph_inject;
    }
    //修改会议信息
    public static function updateHoldmeetDatas($datas){
        $response = DB::table('holdmeet')->where('ho_id',$datas->ho_id)
                    ->update([
                        'ho_name'        => $datas->ho_name,
                        'ho_art_status'  => $datas->ho_art_status,
                        'people_num'     => $datas->people_num,
                        'ho_unit'        => $datas->ho_unit,
                        'undertake_unit' => $datas->undertake_unit,
                        'ho_level'       => $datas->ho_level,
                        'ho_time'        => $datas->ho_time
                    ]);
        return ($response != 1) ? showMsg(1,'修改举行会议信息失败')
               : showMsg(0,'修改举行会议成功');
    }
    //修改会议图注信息
    public static function updateHoldmeetInjectRoad($ho_id,$new_image_road){
        $response = DB::table('holdmeet')->where('ho_id',$ho_id)
                    ->update(['ho_graph_inject' => $new_image_road]);
        return ($response != 1) ? false : true;
    }

}