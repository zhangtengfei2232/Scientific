<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class DutiesDatabase extends ModelDatabase
{
    //添加学术担任团体职务信息
    public static function addDutiesDatas($datas){
        $du_road = $datas['du_road'];
        $add_duties =  DB::table('duties')
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
                            'du_remark'    => $datas->du_remark,
                            'du_road'      => $du_road
                       ]);
        if(empty($du_road)){
            return ($add_duties) ? responseTojson(0,'添加成功')
                   : responseTojson(1,'添加失败');
        }
        return $add_duties;
    }
    //删除担任团体职务信息
    public static function deleteDutiesDatas($du_id_datas){
        for($i = 0; $i < count($du_id_datas); $i++){
            DB::table('duties')->where('du_id',$du_id_datas[$i])->delete();
        }
    }
    //修改担任团体职务信息
    public static function updateDutiesDatas($datas){
        $du_id = $datas['du_id'];
        $response = DB::table('duties')->where('du_id',$du_id)
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
        if(array_key_exists('du_road',$datas)){
            $reset_image = DB::table('duties')->where('du_id',$du_id)->update(['du_road' => $datas['du_road']]);
            return ($response !=1 || $reset_image != 1) ? responseTojson(1,'修改失败')
                   : responseTojson(0,'修改成功');
        }
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
    public static function selectImageRoadDatas($du_id_datas){
        $image_road_datas = [];
        for($i = 0; $i < count($du_id_datas); $i++){
            $road = DB::table('duties')->select('du_road')->where('du_id',$du_id_datas[$i])->first();
            $image_road_datas[$i] = $road->du_road;
        }
        return $image_road_datas;
    }
}