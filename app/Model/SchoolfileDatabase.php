<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class SchoolfileDatabase extends ModelDatabase
{
    //添加校发文件信息
    public static function addSchoolfileDatas($datas){
        $response = DB::table('schoolfile')
                    ->insert([
                        'teacher_id'        => $datas->teacher_id,
                        'schfile_num'       => $datas->schfile_num,
                        'schfile_down_time' => $datas->schfile_down_time,
                        'schfile_road'      => $datas->schfile_road
                    ]);
        return ($response) ? true : false;
    }
    //删除单个校发文件信息
    public static function deleteSchoolfileDatas($shcoolfile_id){
        $response = DB::table('schoolfile')->where('schfile_id',$shcoolfile_id)->delete();
        return ($response != 1) ? false : true;
    }
    //删除多个校发文件信息
    public static function deleteAllSchoolfileDaats($schoolfile_id_datas){
        $fail_schoolfile_id = [];
        $validate = true;
        for($i = 0; $i < count($schoolfile_id_datas); $i++){
            $response = DB::table('schoolfile')->where('schfile_id',$schoolfile_id_datas[$i])->delete();
            if($response != 1){
                $validate = false;
                array_push($fail_schoolfile_id,$schoolfile_id_datas[$i]);
            }
        }
        if($validate){
            return showMsg(0,'校发文件全部删除成功');
        }
        return showMsg(1,'有些校发文件删除失败',$fail_schoolfile_id);
    }
    //修改校发文件信息
    public static function updateSchoolfileDatas($datas){
        $response = DB::table('schoolfile')->where('schfile_id',$datas->schfile_id)
                    ->update([
                        'schfile_num'       => $datas->schfile_num,
                        'schfile_down_time' => $datas->schfile_down_time,
                        'schfile_road'      => $datas->schfile_road
                    ]);
        return ($response != 1) ? false : true;
    }
    //查看单个校发文件信息
    public static function selectSchoolfileDatas($schoolfile_id){
        $result = DB::table('schoolfile')->where('schfile_id',$schoolfile_id)->first();
        $result->schfile_down_time = date('Y-m-d',$result->schfile_down_time);
        return $result;
    }
    //查看所有校发文件信息
    public static function selectAllSchoolfileDatas(){
        $result = DB::table('schoolfile')->orderBy('schfile_down_time','desc')->get();
        foreach ($result as $datas){
            $result->schfile_down_time = date('Y-m-d',$datas->schfile_down_time);
        }
        return $result;
    }
    //查询单个校发文件的路径
    public static function selectSchoolfileRoad($schfile_id){
        $result = DB::table('schoolfile')->select('schfile_road')->where('schfile_id',$schfile_id)->first();
        return  $result->schfile_road;
    }
    //查询多个校发文件路径
    public static function selectAllSchoolfileRoad($school_id_datas){
        $schoolfile_road = [];
        for($i = 0; $i < count($schoolfile_road); $i++){
            $result = DB::table('schoolfile')->select('schfile_road')->where('shcfile_id',$school_id_datas[$i])->first();
            $schoolfile_road[$i] = $result->schfile_road;
        }
        return $schoolfile_road;
    }
}