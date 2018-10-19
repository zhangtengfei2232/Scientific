<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;
class AcademicDatabase extends ModelDatabase
{
      //查询老师的学历信息
      public static function selectAcademic($teacher_id){
          return DB::table('academic')
              ->where('teacher_id',$teacher_id)
              ->whereIn('rank_distinction',[0, 1])
              ->get();
      }
      //修改老师的第一学历和最高学历
      public static function updateAcademic($academic){
          $teacher_id = session('usercount');
          $response = DB::table('academic')->where('student_id',$teacher_id)
                  ->update([
                      'first_academic'        => $academic->first_academic,
                      'first_graduate_school' => $academic->first_graduate_school,
                      'first_study_major'     => $academic->first_study_major,
                      'first_graduation_time' => strtotime($academic->first_graduation_time),
                      'most_academic'         => $academic->most_academic,
                      'most_graduate_school'  => $academic->most_graduate_school,
                      'most_study_major'      => $academic->most_study_major,
                      'most_graduation_time'  => strtotime($academic->most_graduation_time)
                  ]);
          if($response != 1){
              return false;
          }
          return true;
      }
}