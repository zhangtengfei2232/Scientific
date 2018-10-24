<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class LectureDatabase  extends ModelDatabase
{
    //添加讲学信息
    public static function addLectureDatas($datas){
        $response = DB::table('lecture')
                    ->insert([
                        'teacher_id'       => $datas->teacher_id,
                        'le_expert_name'   => $datas->le_expert_name,
                        'le_expert_level'  => $datas->le_expert_level,
                        'le_report_name'   => $datas->le_report_name,
                        'le_invite_status' => $datas->le_invite_status,
                        'le_invite_unit'   => $datas->le_invite_unit,
                        'le_time'          => $datas->le_time
                    ]);
        return ($response) ? showMsg(0,'添加讲学信息成功')
               : showMsg(1,'添加讲学失败');
    }
    //删除讲学信息
    public static function deleteLectureDatas(){

    }
    //修改讲学信息
    public static function updateLectureDatas($datas){
        $response = DB::table('lecture')->where('le_id',$datas->le_id)
                    ->update([
                        'le_expert_name'   => $datas->le_expert_name,
                        'le_expert_level'  => $datas->le_expert_level,
                        'le_report_name'   => $datas->le_report_name,
                        'le_invite_status' => $datas->le_invite_status,
                        'le_invite_unit'   => $datas->le_invite_unit,
                        'le_time'          => $datas->le_time
                    ]);
        return ($response != 1) ? showMsg(1,'修改讲学信息失败')
               :showMsg(0,'修改讲学信息成功');
    }
    //修改讲学图注路径
    public static function updateLectureInjectRoad($le_id,$new_inject_road){
        $response = DB::table('lecture')->where('le_id',$le_id)
                    ->update(['le_img_road' => $new_inject_road]);
        return ($response != 1) ? false : true;
    }
    //查看单个讲学信息
    public static function selectLectureDatas($le_id){
        $result = DB::table('lecture')->where('le_id',$le_id)->first();
        $result->le_time = date('Y-m-d',$result->le_time);
        return $result;
    }
    //查看所有讲学信息
    public static function selectLectureAllDatas($teacher_id){
        $result = DB::table('lecture')->where('teacher_id',$teacher_id)->get();
        foreach ($result as $datas){
            $result->le_time = date('Y-m-d',$datas->le_time);
        }
        return $result;
    }
    //查看讲学图注路径
    public static function selectLectureInject($le_id){
        $result = DB::table('lecture')->select('le_img_road')->where('le_id',$le_id)->first();
        $result = $result->le_img_road;
        return $result;
    }

}