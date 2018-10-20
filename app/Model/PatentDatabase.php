<?php
namespace App\Model;



use Illuminate\Support\Facades\DB;

class PatentDatabase  extends ModelDatabase
{
    //添加专利信息
    public static function addPatentDatas($datas){
        return DB::table('patent')
               ->insert([
                   'teacher_id'       => $datas->teacher_id,
                   'first_inventor'   => $datas->first_inventor,
                   'pa_all_author'    => $datas->pa_all_author,
                   'pa_type'          => $datas->pa_type,
                   'pa_name'          => $datas->pa_name,
                   'pa_imple_situ'    => $datas->pa_imple_situ,
                   'author_num'       => $datas->author_num,
                   'author_cert_num'  => $datas->author_cert_num,
                   'author_notic_day' => $datas->author_notic_day,
                   'pa_integral'      => $datas->pa_integral,
                   'pa_remarks'       => $datas->pa_remarks,
                   'pa_road'          => $datas->pa_road
               ]);
    }
    //删除专利信息
    public static function deletePatentDatas(){

    }
    //查看专利信息
    public static function selectPatentDatas($pa_id){
        $result =  DB::table('patent')->where('pa_id',$pa_id)->first();
        $result->author_notic_day = date('Y-m-d',$result->author_notic_day);
        return $result;
    }
    //查看所有专利信息
    public static function selectPatenAllDatas($teacher_id){
        $result = DB::table('patent')->where('teacher_id',$teacher_id)->get();
        foreach ($result as $datas){
            $datas->author_notic_day = date('Y-m-d',$datas->author_notic_day);
        }
        return $datas;
    }
    //查看专利图片路径
    public static function selectImageRoad($pa_id){
        return DB::table('patent')->select('pa_road')->where('pa_id',$pa_id)->first();
    }
    //修改专利和图片信息
    public static function updatePatentImage($datas){
        $response = DB::table('patent')->where('pa_id',$datas->pa_id)
            ->update([
                'first_inventor'   => $datas->first_inventor,
                'pa_all_author'    => $datas->pa_all_author,
                'pa_type'          => $datas->pa_type,
                'pa_name'          => $datas->pa_name,
                'pa_imple_situ'    => $datas->pa_imple_situ,
                'author_num'       => $datas->author_num,
                'author_cert_num'  => $datas->author_cert_num,
                'author_notic_day' => $datas->author_notic_day,
                'pa_integral'      => $datas->pa_integral,
                'pa_remarks'       => $datas->pa_remarks,
                'pa_road'          => $datas->pa_road
            ]);
        return ($response != 1) ? false : true;

    }
    //修改专利信息
    public static function updatePatentDatas($datas){
        $response = DB::table('patent')->where('pa_id',$datas->pa_id)
                  ->update([
                      'first_inventor'   => $datas->first_inventor,
                      'pa_all_author'    => $datas->pa_all_author,
                      'pa_type'          => $datas->pa_type,
                      'pa_name'          => $datas->pa_name,
                      'pa_imple_situ'    => $datas->pa_imple_situ,
                      'author_num'       => $datas->author_num,
                      'author_cert_num'  => $datas->author_cert_num,
                      'author_notic_day' => $datas->author_notic_day,
                      'pa_integral'      => $datas->pa_integral,
                      'pa_remarks'       => $datas->pa_remarks
                  ]);
        return ($response != 1) ? false : true;
    }
}