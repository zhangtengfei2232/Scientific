<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;

class AppraisalDatabase extends ModelDatabase
{
    //添加成功鉴定信息
    public static function addAppraisalDatas($datas){
        $ap_road  = $datas['ap_road'];
        $response = DB::table('appraisal')
                   ->insert([
                       'teacher_id'      => $datas['teacher_id'],
                       'ap_first_author' => $datas['ap_first_author'],
                       'ap_all_author'   => $datas['ap_all_author'],
                       'ap_res_name'     => $datas['ap_res_name'],
                       'ap_form'         => $datas['ap_form'],
                       'ap_num'          => $datas['ap_num'],
                       'ap_conclusion'   => $datas['ap_conclusion'],
                       'ap_time'         => $datas['ap_time'],
                       'ap_level'        => $datas['ap_level'],
                       'ap_integral'     => $datas['ap_integral'],
                       'ap_road'         => $datas['ap_road'],
                       'ap_remarks'      => $datas['ap_remarks']
                   ]);
        if(empty($ap_road)){
            return ($response) ? responseTojson(0,'添加成果鉴定信息成功','',$response)
                : responseTojson(1,'添加成果鉴定信息失败');
        }
        return $response;
    }
    //查看所有成果鉴定信息
    public static function selectAppraisalAllDatas($teacher_id){
        $result = DB::table('appraisal')->where('teacher_id',$teacher_id)->orderBy('ap_time','desc')->get();
        foreach ($result as $datas){
            $datas->ap_time = date('Y-m-d',$datas->ap_time/1000);
        }
        return $result;
    }
    //查看单个成果鉴定信息
    public static function selectAppraisalDatas($ap_id){
       return DB::table('appraisal')->where('ap_id',$ap_id)->first();
    }
    //查看多个图片路径
    public static function selectAllAppraisalImageRoad($appraisal_id_datas){
          $images_road_datas = [];
          for($i = 0; $i < count($appraisal_id_datas); $i++){
              $road = DB::table('appraisal')->select('ap_road')
                      ->where('ap_id',$appraisal_id_datas[$i])
                      ->first();
              if(!empty($road->ap_road)){
                  array_push($images_road_datas,$road->ap_road);
              }
          }
          return $images_road_datas;
    }
    //修改成果鉴定信息
    public static function updateAppraisalDatas($datas,$reset_image_status){
        $response = DB::table('appraisal')->where('ap_id',$datas['ap_id'])
                  ->update([
                      'ap_first_author' => $datas['ap_first_author'],
                      'ap_all_author'   => $datas['ap_all_author'],
                      'ap_res_name'     => $datas['ap_res_name'],
                      'ap_form'         => $datas['ap_form'],
                      'ap_num'          => $datas['ap_num'],
                      'ap_conclusion'   => $datas['ap_conclusion'],
                      'ap_time'         => $datas['ap_time'],
                      'ap_level'        => $datas['ap_level'],
                      'ap_integral'     => $datas['ap_integral'],
                      'ap_road'         => $datas['ap_road'],
                      'ap_remarks'      => $datas['ap_remarks']
                  ]);
        if($reset_image_status){
            return ($response != 1) ? false : true;
        }
        return ($response != 1) ? responseTojson(1,'修改鉴定成果信息失败')
            :responseTojson(0,'修改鉴定成果信息成功');
    }
}