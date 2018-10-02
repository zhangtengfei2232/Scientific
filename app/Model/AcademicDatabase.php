<?php
namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AcademicDatabase extends Model
{
  //查询老师的学历信息
  public static function selectAcademic($teacher_id)
  {
      return DB::table('academic')
          ->where('teacher_id',$teacher_id)
          ->whereIn('rank_distinction',[0, 1])
          ->get();
  }
}