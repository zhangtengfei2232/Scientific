<?php
namespace App\Model;



use Illuminate\Support\Facades\DB;

class PatentDatabase  extends ModelDatabase
{
    //添加专利信息
    public static function addPatentDatas($datas){
        $pa_raod = $datas['pa_road'];
        $add_patent =  DB::table('patent')
                       ->insert([
                       'teacher_id'       => $datas['teacher_id'],
                       'first_inventor'   => $datas['first_inventor'],
                       'pa_all_author'    => $datas['pa_all_author'],
                       'pa_type'          => $datas['pa_type'],
                       'pa_name'          => $datas['pa_name'],
                       'pa_imple_situ'    => $datas['pa_imple_situ'],
                       'author_num'       => $datas['author_num'],
                       'author_cert_num'  => $datas['author_cert_num'],
                       'author_notic_day' => $datas['author_notic_day'],
                       'pa_integral'      => $datas['pa_integral'],
                       'pa_remarks'       => $datas['pa_remarks'],
                       'pa_road'          => $pa_raod
                       ]);
        if(empty($pa_raod)){
            return ($add_patent) ? responseTojson(0,'添加成功')
                   : responseTojson(1,'添加失败');
        }
        return $add_patent;
    }
    //删除专利信息
    public static function deletePatentDatas($pa_id_datas){
        DB::table('patent')->whereIn('pa_id',$pa_id_datas)->delete();
    }
    //查看专利信息
    public static function selectPatentDatas($pa_id){
        return DB::table('patent')->where('pa_id',$pa_id)->first();
    }
    //查看所有专利信息
    public static function selectPatenAllDatas($teacher_id){
        $result = DB::table('patent')->where('teacher_id',$teacher_id)->orderBy('author_notic_day','desc')->get();
        foreach ($result as $datas){
            $datas->author_notic_day = date('Y-m-d',$datas->author_notic_day);
        }
        return $result;
    }
    //查看专利图片路径
    public static function selectImageRoadDatas($pa_id_datas){
        $pa_image_road = [];
        for($i = 0; $i < count($pa_id_datas); $i++){
            $result = DB::table('patent')->select('pa_road')->where('pa_id',$pa_id_datas[$i])->first();
            $pa_image_road[$i] = $result->pa_road;
        }
        return $pa_image_road;
    }
    //修改专利信息
    public static function updatePatentDatas($datas,$reset_image_status){
        $pa_id = $datas['pa_id'];
        $response = DB::table('patent')->where('pa_id',$pa_id)
                  ->update([
                  'first_inventor'   => $datas['first_inventor'],
                  'pa_all_author'    => $datas['pa_all_author'],
                  'pa_type'          => $datas['pa_type'],
                  'pa_name'          => $datas['pa_name'],
                  'pa_imple_situ'    => $datas['pa_imple_situ'],
                  'author_num'       => $datas['author_num'],
                  'author_cert_num'  => $datas['author_cert_num'],
                  'author_notic_day' => $datas['author_notic_day'],
                  'pa_integral'      => $datas['pa_integral'],
                  'pa_remarks'       => $datas['pa_remarks'],
                  ]);
        if($reset_image_status){
            return ($response != 1) ? false : true;
        }
        return ($response != 1) ? responseTojson(1,'修改失败')
               : responseTojson(0,'修改成功');
    }
}