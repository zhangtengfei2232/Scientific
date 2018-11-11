<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class LectureDatabase  extends ModelDatabase
{
    //添加讲学信息
    public static function addLectureDatas($datas){
        $le_img_road = $datas['le_img_road'];
        $response = DB::table('lecture')
                    ->insertGetId([
                        'teacher_id'       => $datas['teacher_id'],
                        'le_expert_name'   => $datas['le_expert_name'],
                        'le_expert_level'  => $datas['le_expert_level'],
                        'le_report_name'   => $datas['le_report_name'],
                        'le_invite_status' => $datas['le_invite_status'],
                        'le_invite_unit'   => $datas['le_invite_unit'],
                        'le_time'          => $datas['le_time'],
                        'le_img_road'      => $le_img_road
                    ]);
        if(empty($le_img_road)){
            return ($response > 0) ? responseTojson(0,'添加讲学信息成功','',$response)
                : responseTojson(1,'添加讲学失败');
        }
        return $response;
    }
    //修改讲学信息
    public static function updateLectureDatas($datas,$reset_inject_status){
        $response = DB::table('lecture')->where('le_id',$datas['le_id'])
                    ->update([
                        'le_expert_name'   => $datas['le_expert_name'],
                        'le_expert_level'  => $datas['le_expert_level'],
                        'le_report_name'   => $datas['le_report_name'],
                        'le_invite_status' => $datas['le_invite_status'],
                        'le_invite_unit'   => $datas['le_invite_unit'],
                        'le_time'          => $datas['le_time'],
                        'le_img_road'      => $datas['le_img_road']
                    ]);
        if($reset_inject_status){
            return ($response !=1) ? false : true;
        }
        return ($response != 1) ? responseTojson(1,'修改讲学信息失败')
               :responseTojson(0,'修改讲学信息成功');
    }
    //查看单个讲学信息
    public static function selectLectureDatas($le_id){
        return DB::table('lecture')->where('le_id',$le_id)->first();
    }
    //查看所有讲学信息
    public static function selectLectureAllDatas($teacher_id){
        $result = DB::table('lecture')->where('teacher_id',$teacher_id)->orderBy('le_time','desc')->get();
        foreach ($result as $datas){
            $datas->le_time = date('Y-m-d',$datas->le_time/1000);
        }
        return $result;
    }
    //查看讲学图注路径
    public static function selectLectureInject($le_id_datas){
        $image_road_datas = [];
        for($i = 0; $i < count($le_id_datas); $i++){
            $road = DB::table('lecture')->select('le_img_road')->where('le_id',$le_id_datas[$i])->first();
            $image_road_datas[$i] = $road->le_img_road;
        }
        return $image_road_datas;
    }
}