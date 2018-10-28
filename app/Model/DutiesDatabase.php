<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class DutiesDatabase extends ModelDatabase
{
    //添加学术担任团体职务信息
    public static function addDutiesDatas($datas){
        return  DB::table('duties')
                    ->instert([
                        'teacher_id'   => $datas->teacher_id,
                        'teacher_name' => $datas->teacher_name,
                        'du_academic'  => $datas->du_academic,
                        'du_education' => $datas->du_education,
                        'du_degree'    => $datas->du_degree,
                        'du_age'       => $datas->du_age,
                        'du_name'      => $datas->du_name,
                        'du_duty'      => $datas->du_duty,
                        'du_year_num'  => $datas->du_year_num,
                        'du_remark'    => $datas->du_remark
                    ]);
    }
    //删除担任团体职务信息
    public static function deleteDutiesDatas(){


    }
    //修改担任团体职务信息
    public static function updateDutiesDatas($datas){
        $response = DB::table('duties')->where('du_id',$datas->du_id)
            ->update([
                'teacher_name' => $datas->teacher_name,
                'du_academic'  => $datas->du_academic,
                'du_education' => $datas->du_education,
                'du_degree'    => $datas->du_degree,
                'du_age'       => $datas->du_age,
                'du_name'      => $datas->du_name,
                'du_duty'      => $datas->du_duty,
                'du_year_num'  => $datas->du_year_num,
                'du_remark'    => $datas->du_remark
            ]);
        return ($response != 1) ? false : true;
    }
    //修改担任团体职务和证书信息
    public static function updateDutiesImage($datas){
        $response = DB::table('duties')->where('du_id',$datas->du_id)
                    ->update([
                        'teacher_name' => $datas->teacher_name,
                        'du_academic'  => $datas->du_academic,
                        'du_education' => $datas->du_education,
                        'du_degree'    => $datas->du_degree,
                        'du_age'       => $datas->du_age,
                        'du_name'      => $datas->du_name,
                        'du_duty'      => $datas->du_duty,
                        'du_year_num'  => $datas->du_year_num,
                        'du_road'      => $datas->du_road,
                        'du_remark'    => $datas->du_remark
                    ]);
        return ($response != 1) ? false : true;
    }
    //查看单个担任团体职务信息
    public static function selectDutiesDatas($du_id){
        $result = DB::table('duties')->where('du_id',$du_id)->first();
        $result->du_year_num = date('Y-m-d',$result->du_year_num);
        return $result;
    }
    //查看所有担任团体职务信息
    public static function selectAllDutiesDatas($teacher_id){
        $result = DB::table('duties')->where('teacher_id',$teacher_id)->orderBy('du_age','desc')->get();
        foreach ($result as $datas){
            $datas->du_year_num = date('Y-m-d',$datas->du_year_num);
        }
        return $result;
    }
    //查看担任团体职务证书路径
    public static function selectDutiesImageRoad($du_id){
        $result = DB::table('duties')->select('du_road')->where('du_id',$du_id)->first();
        return $result->du_road;
    }



}