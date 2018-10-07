<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ArticalDatabase  extends Model
{
     //查找个人一篇论文信息
     public  static function selectArticalDatas($art_id)
     {
         return DB::table('artical')->where('art_id',$art_id)->get();
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
}