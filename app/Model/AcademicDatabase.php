<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;
class AcademicDatabase extends ModelDatabase
{

      //添加老师学历学位信息
      public static function addAcademic($academic){
          $response = DB::table('academic')
                  ->insertGetId([
                      'teacher_id' => $academic->teacher_id,
                      'first_academic' => $academic->first_academic,
                      'first_graduate_school' => $academic->first_graduate_school,
                      'first_study_major' => $academic->first_study_major,
                      'first_graduation_time' => strtotime($academic->first_graduation_time),
                      'most_academic'   => $academic->most_academic,
                      'most_graduate_school' => $academic->most_graduate_school,
                      'most_study_major' => $academic->most_study_major,
                      'most_graduation_time' => strtotime($academic->most_graduation_time)
                  ]);
         return $response ? $response : !$response;
      }
      //查询老师的学历信息
      public static function selectAcademic($teacher_id){
          return DB::table('academic')
              ->where('teacher_id',$teacher_id)
              ->whereIn('rank_distinction',[0, 1])
              ->get();
      }
      //修改老师的第一学历和最高学历
      public static function updateAcademic($teacher_id,$academic){
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
          return ($response != 1) ? false : true;
      }

}