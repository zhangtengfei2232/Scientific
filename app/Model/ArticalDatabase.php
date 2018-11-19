<?php
namespace App\Model;

use Illuminate\Support\Facades\DB;
class ArticalDatabase  extends ModelDatabase
{
     //查找个人一篇论文信息
    /**
     * @param $art_id
     * @return mixed
     */
     public  static function selectArticalDatas($art_id){
         return DB::table('artical')->where('art_id',$art_id)->first();
     }
     //查找个人全部论文信息
     public static function selectAllArticalDatas($teacher_id){
         $result = DB::table('artical')->where('teacher_id',$teacher_id)->orderBy('art_time','desc')->get();
         foreach ($result as  $datas){
             $datas->art_time = date('Y-m-d',$datas->art_time/1000);
         }
         return $result;
     }
     //添加个人论文信息
     public static function addArticalDatas($datas){
         return DB::table('artical')
                ->insert([
                    'teacher_id'        => $datas['teacher_id'],
                    'author'            => $datas['author'],
                    'art_all_author'    => $datas['art_all_author'],
                    'title'             => $datas['title'],
                    'publication_name'  => $datas['publication_name'],
                    'publication_num'   => $datas['publication_num'],
                    'period'            => $datas['period'],
                    'num_words'         => $datas['num_words'],
                    'percal_cate'       => $datas['percal_cate'],
                    'belong_project'    => $datas['belong_project'],
                    'art_cate_research' => $datas['art_cate_research'],
                    'art_sub_category'  => $datas['art_sub_category'],
                    'art_integral'      => $datas['art_integral'],
                    'sch_percal_cate'   => $datas['sch_percal_cate'],
                    'art_road'          => $datas['art_road'],
                    'art_sci_road'      => $datas['art_sci_road'],
                    'art_time'          => $datas['art_time'],
                    'art_remarks'       => $datas['art_remarks']
                ]);
     }
     //删除论文
    public static function deleteArticalDatas($artical_id_datas){
         $response = DB::table('artical')->whereIn('art_id',$artical_id_datas)->delete();
         return ($response != 1) ? false :true;
    }
     //修改论文信息和论文照片信息
    public static function updateArticalDatas($datas){
        $response = DB::table('artical')
            ->where('art_id',$datas['art_id'])
            ->update([
                'author'            => $datas['author'],
                'art_all_author'    => $datas['art_all_author'],
                'title'             => $datas['title'],
                'publication_name'  => $datas['publication_name'],
                'publication_num'   => $datas['publication_num'],
                'period'            => $datas['period'],
                'num_words'         => $datas['num_words'],
                'percal_cate'       => $datas['percal_cate'],
                'belong_project'    => $datas['belong_project'],
                'art_cate_research' => $datas['art_cate_research'],
                'art_sub_category'  => $datas['art_sub_category'],
                'art_integral'      => $datas['art_integral'],
                'sch_percal_cate'   => $datas['sch_percal_cate'],
                'art_time'          => $datas['art_time'],
                'art_remarks'       => $datas['art_remarks']
             ]);
        return ($response != 1) ? responseTojson(1,'修改论文信息失败')
               : responseTojson(0,'修改论文信息成功');
    }
    //修改论文本身和论文SCI索引报告
    public static function updateArticalSelfDatas($reset_artical_road,$update_artical_status,$artical_id){
         if($update_artical_status == 1){
             $reset_response = DB::table('artical')
                 ->where('art_id',$artical_id)
                 ->update(['art_road' => $reset_artical_road]);
         }else{
             $reset_response = DB::table('artical')
                 ->where('art_id',$artical_id)
                 ->update(['art_sci_road' => $reset_artical_road]);
         }
         return ($reset_response != 1) ? false : true;
    }
    //查找多个论文、SCI索引报告路径
    public static function selectArticalRoad($art_id_datas,$select_status){
         switch ($select_status){
             case 0:
                 $artical_road = [];
                 for($i = 0; $i < count($art_id_datas); $i++){
                     $road = DB::table('artical')->select('art_road','art_sci_road')
                             ->where('art_id',$art_id_datas[$i])
                             ->get();
                     array_push($artical_road,$road->art_road);
                 }
                 break;
             case 1:
                 $road = DB::table('artical')->select('art_road')->where('art_id',$art_id_datas)->first();
                 $artical_road = $road->art_road;
                 break;
             case 2:
                 $road = DB::table('artical')->select('art_sci_road')->where('art_id',$art_id_datas)->first();
                 $artical_road = $road->art_sci_road;
                 break;
         }
         return $artical_road;
    }
}