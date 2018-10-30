<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class SchoolfileDatabase extends ModelDatabase
{
    //添加校发文件信息
    public static function addSchoolfileDatas($datas){
        return  DB::table('schoolfile')
                    ->insert([
                        'shcfile_name'      => $datas['shcfile_name'],
                        'schfile_num'       => $datas['schfile_num'],
                        'schfile_down_time' => $datas['schfile_down_time'],
                        'schfile_road'      => $datas['schfile_road']
                    ]);
    }
    //删除单个校发文件信息
    public static function deleteSchoolfileDatas($shcoolfile_id){
        $response = DB::table('schoolfile')->where('schfile_id',$shcoolfile_id)->delete();
        return ($response != 1) ? false : true;
    }
    //删除多个校发文件信息
    public static function deleteAllSchoolfileDatas($schoolfile_id_datas){
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
        $count_id = count($fail_schoolfile_id);
        return showMsg(1,'有'.$count_id.'个校发文件删除失败',$fail_schoolfile_id);
    }
    //修改校发文件信息
    public static function updateSchoolfileDatas($datas){
        $response = DB::table('schoolfile')->where('schfile_id',$datas['schfile_id'])
                    ->update([
                        'shcfile_name'      => $datas['shcfile_name'],
                        'schfile_num'       => $datas['schfile_num'],
                        'schfile_down_time' => $datas['schfile_down_time'],
                        'schfile_road'      => $datas['schfile_road']
                    ]);
        return ($response != 1) ? false : true;
    }
    //查看单个校发文件信息
    public static function selectSchoolfileDatas($schoolfile_id){
        return DB::table('schoolfile')->where('schfile_id',$schoolfile_id)->first();
    }
    //查看所有校发文件信息
    public static function selectAllSchoolfileDatas(){
        $result = DB::table('schoolfile')->orderBy('schfile_down_time','desc')->get();
        foreach ($result as $datas){
            $datas->schfile_down_time = date('Y-m-d',$datas->schfile_down_time);
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
        $schoolfile_road = array();
        for($i = 0; $i < count($schoolfile_road); $i++){
            $result = DB::table('schoolfile')->select('schfile_road')->where('shcfile_id',$school_id_datas[$i])->first();
            //用校发文件ID作为键，路径作为值存入
            $school_id = $school_id_datas[$i];
            $schoolfile_road[$school_id] = $result->schfile_road;
        }
        return $schoolfile_road;
    }
    //查询校发文件名称
    public static function selectAllSchoolfileName($delete_schoolfile_id){
        $schoolfile_name = [];
        for($i = 0; $i < count($delete_schoolfile_id); $i++){
            $name = DB::table('schoolfile')->select('schfile_name')
                    ->where('schfile_id',$delete_schoolfile_id[$i])
                    ->first();
            $schoolfile_name[$i] = $name->schfile_name;
        }
    }
}