<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class HoldmeetDatas extends ModelDatabase
{
    //添加会议信息
    public static function addHoldmeetDatas($datas){
        $ho_graph_inject = $datas['ho_graph_inject'];
        $response = DB::table('holdmeet')
                    ->insertGetId([
                        'teacher_id'      => $datas['teacher_id'],
                        'ho_name'         => $datas['ho_name'],
                        'ho_art_status'   => $datas['ho_art_status'],
                        'people_num'      => $datas['people_num'],
                        'ho_unit'         => $datas['ho_unit'],
                        'undertake_unit'  => $datas['undertake_unit'],
                        'ho_level'        => $datas['ho_level'],
                        'ho_time'         => $datas['ho_time'],
                        'ho_graph_inject' => $ho_graph_inject
                    ]);
         if(empty($ho_graph_inject)){
             return ($response > 0) ? responseTojson(0,'添加会议信息成功','',$response)
                  : responseTojson(1,'添加信息失败');
         }
         return $response;
    }
    //查看所有会议信息
    public static function selectAllHoldmeetDatas($teacher_id){
        $result = DB::table('holdmeet')->where('teacher_id',$teacher_id)->orderBy('ho_time','desc')->get();
        foreach ($result as $datas){
            $datas->ho_time = date('Y-m-d',$datas->ho_time/1000);
        }
        return $result;
    }
    //查看单个会议信息
    public static function selectHoldmetDatas($ho_id){
        return DB::table('holdmeet')->where('ho_id',$ho_id)->first();
    }
    //查看多个会议图注路径
    public static function selectHoldmeetInjectRoad($ho_id_datas){
        $ho_image_road = [];
        for($i = 0; $i < count($ho_id_datas); $i++){
            $road = DB::table('holdmeet')->select('ho_graph_inject')->where('ho_id',$ho_id_datas[$i])->first();
            $ho_image_road[$i] = $road['ho_graph_inject'];
         }
         return $ho_image_road;
    }
    //修改会议信息
    public static function updateHoldmeetDatas($datas,$reset_inject_status){
        $response = DB::table('holdmeet')->where('ho_id',$datas['ho_id'])
                    ->update([
                        'ho_name'         => $datas['ho_name'],
                        'ho_art_status'   => $datas['ho_art_status'],
                        'people_num'      => $datas['people_num'],
                        'ho_unit'         => $datas['ho_unit'],
                        'undertake_unit'  => $datas['undertake_unit'],
                        'ho_level'        => $datas['ho_level'],
                        'ho_time'         => $datas['ho_time'],
                        'ho_graph_inject' => $datas['ho_graph_inject']
                    ]);
        if($reset_inject_status){
            return ($response !=1) ? false :true;
        }
        return ($response != 1) ? responseTojson(1,'修改举行会议信息失败')
               : responseTojson(0,'修改举行会议成功');
    }
}