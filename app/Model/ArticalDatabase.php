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
     public  static function selectArticalDatas($art_id)
     {

        $result =  DB::table('artical')->where('art_id',$art_id)->get();
        $result->art_time = date('Y-m-d',$result->art_time);
        return $result;
     }
     //查找个人全部论文信息
     public static function selectAllArticalDatas($teacher_id)
     {
         return DB::table('artical')->where('teacher_id',$teacher_id)->get();
     }
     //添加个人论文信息
     public static function addArticalDatas()
     {

     }
     //修改论文信息
    public static function updateArticalDatas($datas)
    {

    }

}