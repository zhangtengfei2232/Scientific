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

        $result =  DB::table('artical')->where('art_id',$art_id)->get();
        $result->art_time = date('Y-m-d',$result->art_time);
        return $result;
     }
     //查找个人全部论文信息
     public static function selectAllArticalDatas($teacher_id){
         $result = DB::table('artical')->where('teacher_id',$teacher_id)->orderBy('art_time','desc')->get();
         foreach ($result as  $datas){
             $result->art_time = date('Y-m-d',$datas->art_time);
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
                    'home_page_road'    => $datas['home_page_road'],
                    'art_sci_road'      => $datas['art_sci_road'],
                    'art_time'          => strtotime($datas['art_time']),
                    'art_remarks'       => $datas->art_remarks
                ]);
     }
     //删除论文
    public static function deleteArticalDatas($artical_id){
         $response = DB::table('artical')->where('art_id',$artical_id)->delete();
         return ($response != 1) ? false :true;
    }
     //修改论文信息和论文照片信息
    public static function updateArticalImage($datas){
        $response = DB::table('artical')
            ->where('art_id',$datas->artical_id)
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
                'art_road'          => $datas['art_road'],
                'home_page_road'    => $datas['home_page_road'],
                'art_sci_road'      => $datas['art_sci_road'],
                'art_time'          => strtotime($datas['art_time']),
                'art_remarks'       => $datas->art_remarks
             ]);
        return ($response != 1) ? false : true;
    }
    //修改论文信息
    public static function updateArticalDatas($datas){
        $response = DB::table('artical')
            ->where('art_id',$datas->artical_id)
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
                'art_time'          => strtotime($datas->art_time),
                'art_remarks'       => $datas->art_remarks
            ]);
        return ($response != 1) ? showMsg(1,'修改论文失败')
               : showMsg(0,'修改论文成功');
    }
    //查找论文、首页原始、SCI索引报告路径
    public static function selectArticalRoad($artical_id){
         return DB::table('artical')
             ->select('art_road','home_page_road','art_sci_road')
             ->where('art_id',$artical_id)
             ->get();
    }
}