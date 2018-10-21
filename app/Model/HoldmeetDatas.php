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
        return ($response) ? showMsg(0,'添加会议信息成功')
               : showMsg(1,'添加信息失败');
    }
    //删除会议信息
    public static function deleteHoldmeetDatas(){

    }
    //查看所有会议信息
    public static function selectAllHoldmeetDatas($all_images_road){

    }
    //查看单个会议信息
    public static function selectHoldmetDatas(){

    }
    //查看以前会议图注路径
    public static function selectHoldmeetInjectRoad($ho_id){
        $result = DB::table('holdmeet')->select('ho_graph_inject')->where('ho_id',$ho_id)->first();
        $result = $result->ho_graph_inject;
        return $result;
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
    public static function updateHoldmeetImageDatas($ho_id,$new_image_road){
        $response = DB::table('holdmeet')->where('ho_id',$ho_id)
                    ->update(['ho_graph_inject' => $new_image_road]);
        return ($response != 1) ? false : true;
    }

}