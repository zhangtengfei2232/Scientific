<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class OpusDatabase  extends ModelDatabase
{
    //添加著作信息
    public static function addOpusDatas($datas){
         $op_road = $datas['op_remarks'];
         $response =  DB::table('opus')
                ->insert([
                    'teacher_id'       => $datas['teacher_id'],
                    'op_first_author'  => $datas['op_first_author'],
                    'op_all_author'    => $datas['op_all_author'],
                    'op_name'          => $datas['op_name'],
                    'op_form_write'    => $datas['op_form_write'],
                    'op_publish'       => $datas['op_publish'],
                    'op_publish_time'  => $datas['op_publish_time'],
                    'op_number'        => $datas['op_number'],
                    'op_total_words'   => $datas['op_total_words'],
                    'op_self_words'    => $datas['op_self_words'],
                    'op_cate_work'     => $datas['op_cate_work'],
                    'op_integral'      => $datas['op_integral'],
                    'op_cate_research' => $datas['op_cate_research'],
                    'op_sub_category'  => $datas['op_sub_category'],
                    'op_road'          => $datas['op_road'],
                    'op_remarks'       => $op_road
                ]);
         if(empty($op_road)){
             return ($response) ? responseTojson(0,'添加著作信息成功','',$response)
                 : responseTojson(1,'添加著作信息失败');
         }
         return $response;
    }
    //查看单个著作信息
    public static function selectOpusDatas($op_id){
        return DB::table('opus')->where('op_id',$op_id)->first();
    }
    //查看所有著作信息
    public static function selectOpusAllDatas($teacher_id){
        $result = DB::table('opus')->where('teacher_id',$teacher_id)->orderBy('op_publish_time','desc')->get();
        foreach ($result as  $datas){
            $datas->op_publish_time = date('Y-m-d',$datas->op_publish_time/1000);
        }
        return $result;
    }
    //查询以前的著作图片路径
    public static function selectOpusAllImageDatas($op_id_datas){
        $op_raod_datas = [];
        for($i = 0; $i < count($op_id_datas); $i++){
            $road = DB::table('opus')->select('op_road')
                    ->where('op_id',$op_id_datas[$i])
                    ->first();
            array_push($op_raod_datas,$road->op_road);
        }
        return $op_raod_datas;
    }
    //修改著作信息
    public static function updateOpusDatas($datas,$reset_image_status){
        $respone = DB::table('opus')->where('op_id',$datas['op_id'])
                   ->update([
                       'op_first_author'  => $datas['op_first_author'],
                       'op_all_author'    => $datas['op_all_author'],
                       'op_name'          => $datas['op_name'],
                       'op_form_write'    => $datas['op_form_write'],
                       'op_publish'       => $datas['op_publish'],
                       'op_publish_time'  => $datas['op_publish_time'],
                       'op_number'        => $datas['op_number'],
                       'op_total_words'   => $datas['op_total_words'],
                       'op_self_words'    => $datas['op_self_words'],
                       'op_cate_work'     => $datas['op_cate_work'],
                       'op_integral'      => $datas['op_integral'],
                       'op_cate_research' => $datas['op_cate_research'],
                       'op_sub_category'  => $datas['op_sub_category'],
                       'op_road'          => $datas['op_road'],
                       'op_remarks'       => $datas['op_remarks']
                   ]);
        if($reset_image_status){
            return ($respone != 1) ? false : true;
        }
        return ($respone != 1) ? responseTojson(1,'修改著作信息失败')
               : responseTojson(0,'修改著作信息成功');
    }
}