<?php
namespace App\Model;

use App\Http\Controllers\Define\DefineController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class TeacherDatabase extends ModelDatabase
{
    /**根据账号和密码去查用户密码是否输入正确
     * @param $usercount
     * @param $userpassword
     * @return string
     */
     public static function selectLogin($usercount,$userpassword){
         if(strlen($usercount) == 0){
             return showMsg(1,'账号不能为空');
         }else if(strlen($usercount ) > 10){
             return showMsg(1,"账号不存在");
         }else if(strlen($userpassword) == 0){
             return showMsg(1,"密码不能为空");
         }else if(strlen($userpassword) > 30){
             return showMsg(1,'密码错误');
         }
         $result = DB::table('teacher')
                   ->where('teacher_id', $usercount)
                   ->where('password', $userpassword)
                   ->count();
         if($result == 1){
             switch ($usercount){
                 case 1  :                                                    //院长
                     return TeacherDatabase::saveAccount($usercount,DefineController::PRESIDENT);
                 case 2  :                                                    //副院长
                     return TeacherDatabase::saveAccount($usercount,DefineController::VICE_PRESIDENT);
                 case 3  :                                                    //科研秘书
                     return TeacherDatabase::saveAccount($usercount,DefineController::RESEARCH_SECRETARY);
                 case 4  :                                                    //教学秘书
                     return TeacherDatabase::saveAccount($usercount,DefineController::TEACH_SECRETARY);
                 case 5  :                                                    //系主任
                     return TeacherDatabase::saveAccount($usercount,DefineController::DEPARTMENT_HEAD);
                 case 6  :                                                    //教研室主任
                     return TeacherDatabase::saveAccount($usercount,DefineController::TEACH_RESEARCH_HEAD);
                 default :                                                    //普通老师
                     return TeacherDatabase::saveAccount($usercount,DefineController::TEACHER);
             }
         }else{
             return showMsg(1,"账号或密码输入错误");
         }
     }
     //添加老师的信息
     public static function addTeacherDatas($datas){
        $response =  DB::table('teacher')
             ->insert([
                 'teacher_id'            => $datas->teacher_id,
                 'password'              => $datas->teacher_id,     //初始密码设置为工号
                 'teacher_department'    => $datas->teacher_department,
                 'name'                  => $datas->name,
                 'office_phone'          => $datas->office_phone,
                 'home_phone'            => $datas->home_phone,
                 'phone'                 => $datas->phone,
                 'number'                => $datas->number,
                 'sex'                   => $datas->sex,
                 'nation'                => $datas->nation,
                 'borth'                 => strtotime($datas->borth),
                 'polit_outlook'         => $datas->polit_outlook,
                 'native_place'          => $datas->native_place,
                 'admin_duties'          => $datas->admin_duties,
                 'admin_tenure_time'     => strtotime($datas->admin_tenure_time),
                 'job_level'             => $datas->job_level,
                 'technical_position'    => $datas->technical_position,
                 'academic_title'        => $datas->academic_title,
                 'review_time'           => strtotime($datas->review_time),
                 'appointment_time'      => strtotime($datas->appointment_time),
                 'series'                => $datas->series,
                 'post_category'         => $datas->post_category,
                 'company'               => $datas->company,
                 'te_re_department'      => $datas->te_re_department,
                 'working_hours'         => strtotime($datas->working_hours),
                 'origin_work_unit'      => $datas->origin_work_unit,
                 'certificate_num'       => $datas->certificate_num,
                 'identity_card'         => $datas->identity_card,
                 'edu_school'            => $datas->edu_school,
                 'first_academic'        => $datas->first_academic,
                 'first_graduate_school' => $datas->first_graduate_school,
                 'first_study_major'     => $datas->first_study_major,
                 'first_graduation_time' => strtotime($datas->first_graduation_time),
                 'most_academic'         => $datas->most_academic,
                 'most_graduate_school'  => $datas->most_graduate_school,
                 'most_study_major'      => $datas->most_study_major,
                 'most_graduation_time'  => strtotime($datas->most_graduation_time),
                 'work_major'            => $datas->work_major,
                 'belong_subject'        => $datas->belong_subject,
                 'teach_course'          => $datas->teach_course,
                 'master_company'        => $datas->master_company,
                 'master_time'           => strtotime($datas->master_time),
                 'create_time'           => time()
             ]);
        return ($response) ? showMsg(0,'添加老师信息成功')
               : showMsg(1,'添加老师信息失败');
     }
     //删除老师的信息
     public static function deleteTeacherDatas(){

     }

    /**查询老师的信息
     * @return string
     */
     public static function selectTeacherDatas($teacher_id){
         $buffer             = DB::table('teacher')->where('teacher_id', $teacher_id)->first();
         $buffer             = (array)$buffer;                         //把数据转化为数组格式
         $buffer['status']   = session('status');                 //登录角色判断
         $buffer->borth      = date('Y-m-d',$buffer->borth);
         $buffer->admin_tenure_time      = date('Y-m-d',$buffer->admin_tenure_time);
         $buffer->review_time            = date('Y-m-d',$buffer->review_time);
         $buffer->appointment_time       = date('Y-m-d',$buffer->appointment_time);
         $buffer->working_hours          = date('Y-m-d',$buffer->working_hours);
         $buffer->first_graduation_time  = date('Y-m-d',$buffer->first_graduation_time);
         $buffer->most_graduation_time   = date('Y-m-d',$buffer->most_graduation_time);
         $buffer->master_time            = date('Y-m-d',$buffer->master_time);
         return showMsg(0,'查询成功',$buffer);
     }
     //查找老师证书图片路径
     public static function selectCertificateRoad($teacher_id,$status){
         if($status == 1){
             $image =  DB::table('teacher')
                     ->select('gra_cert_road')
                     ->where('teacher_id',$teacher_id)
                     ->get();
             return $image->gra_cert_road;
         }elseif ($status == 2){
             $image =  DB::table('teacher')
                 ->select('edu_cert_road')
                 ->where('teacher_id',$teacher_id)
                 ->get();
             return $image->edu_cert_road;
         }
     }
     //修改老师的信息
    /**
     * @param $datas
     * @return bool
     */
     public static function updateTeacherDatas($teacher_id,$datas){
         $retUpdate = DB::table('teacher')
                  ->where('teacher_id',$teacher_id)
                  ->update([
                      'teacher_department'    => $datas->teacher_department,
                      'name'                  => $datas->name,
                      'office_phone'          => $datas->office_phone,
                      'home_phone'            => $datas->home_phone,
                      'phone'                 => $datas->phone,
                      'number'                => $datas->number,
                      'sex'                   => $datas->sex,
                      'nation'                => $datas->nation,
                      'borth'                 => strtotime($datas->borth),
                      'polit_outlook'         => $datas->polit_outlook,
                      'native_place'          => $datas->native_place,
                      'admin_duties'          => $datas->admin_duties,
                      'admin_tenure_time'     => strtotime($datas->admin_tenure_time),
                      'job_level'             => $datas->job_level,
                      'technical_position'    => $datas->technical_position,
                      'academic_title'        => $datas->academic_title,
                      'review_time'           => strtotime($datas->review_time),
                      'appointment_time'      => strtotime($datas->appointment_time),
                      'series'                => $datas->series,
                      'post_category'         => $datas->post_category,
                      'company'               => $datas->company,
                      'te_re_department'      => $datas->te_re_department,
                      'working_hours'         => strtotime($datas->working_hours),
                      'origin_work_unit'      => $datas->origin_work_unit,
                      'certificate_num'       => $datas->certificate_num,
                      'identity_card'         => $datas->identity_card,
                      'edu_school'            => $datas->edu_school,
                      'first_academic'        => $datas->first_academic,
                      'first_graduate_school' => $datas->first_graduate_school,
                      'first_study_major'     => $datas->first_study_major,
                      'first_graduation_time' => strtotime($datas->first_graduation_time),
                      'most_academic'         => $datas->most_academic,
                      'most_graduate_school'  => $datas->most_graduate_school,
                      'most_study_major'      => $datas->most_study_major,
                      'most_graduation_time'  => strtotime($datas->most_graduation_time),
                      'work_major'            => $datas->work_major,
                      'belong_subject'        => $datas->belong_subject,
                      'teach_course'          => $datas->teach_course,
                      'master_company'        => $datas->master_company,
                      'master_time'           => strtotime($datas->master_time),
                      'update_time'           => time()
                  ]);
         return ($retUpdate != 1) ? showMsg(1,'修改信息失败')
                : showMsg(0,'修改信息成功');
     }
    //修改老师证书图片路径
    /**
     * @param $teacher_id
     * @param $certificate_road
     * @param $status
     * @return bool
     */
    public static function updateCertificate($teacher_id,$certificate_road,$status){
        if($status == 1){
            $response = DB::table('teacher')->where('teacher_id',$teacher_id)
                ->update(['gra_cert_road' => $certificate_road]);
        }elseif ($status == 2){
            $response = DB::table('teacher')->where('teacher_id',$teacher_id)
                ->update(['edu_cert_road' => $certificate_road]);
        }
        return ($response != 1) ? false : true;
    }
    /**把老师账号和身份验证信息存入session
     * @param $usercount
     * @param $status
     * @return string
     */
     public static function saveAccount($usercount,$status){
         Session::put('usercount', $usercount);     //把用户的信息存入session
         Session::put('status', $status);
         Session::save();
         return showMsg(0,"登录成功");
     }
    /**把session里的用户信息清空
     *
     */
     public static function emptyAccount(){
        Session::flush();
     }
}

