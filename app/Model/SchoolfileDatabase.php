<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class SchoolfileDatabase extends ModelDatabase
{
    //添加校发文件信息
    public static function addSchoolfileDatas($datas){
        return  DB::table('schoolfile')
                    ->insert([
                        'schfile_name'      => $datas['schfile_name'],
                        'schfile_num'       => $datas['schfile_num'],
                        'schfile_down_time' => $datas['schfile_down_time'],
                        'schfile_road'      => $datas['schfile_road']
                    ]);
    }
    //删除多个校发文件信息
    public static function deleteSchoolfileDatas($schoolfile_id_datas){
           DB::table('schoolfile')->whereIn('schfile_id',$schoolfile_id_datas)->delete();
    }
    //修改校发文件信息
    public static function updateSchoolfileDatas($datas,$reset_file_status){
        $response = DB::table('schoolfile')->where('schfile_id',$datas['schfile_id'])
                    ->update([
                        'schfile_name'      => $datas['schfile_name'],
                        'schfile_num'       => $datas['schfile_num'],
                        'schfile_down_time' => $datas['schfile_down_time'],
                        'schfile_road'      => $datas['schfile_road']
                    ]);
        if($reset_file_status){
            return ($response != 1) ? false : true;
        }
        return ($response != 1) ? responseTojson(1,'修改校发文件信息失败')
               : responseTojson(0,'修改校发文件信息成功');
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
    //查询多个校发文件路径
    public static function selectSchoolfileRoad($school_id_datas){
        $schoolfile_road = [];
        for($i = 0; $i < count($schoolfile_road); $i++){
            $result = DB::table('schoolfile')->select('schfile_road')->where('shcfile_id',$school_id_datas[$i])->first();
           $schoolfile_road[$i] = $result->schfile_road;
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