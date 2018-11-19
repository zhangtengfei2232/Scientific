<?php
namespace App\Model;

use config\SearchMessageConfig;
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
             return responseTojson(1,"账号不能为空");
         }else if(strlen($usercount ) > 10){
             return responseTojson(1,"你输入的账号过长");
         }else if(strlen($userpassword) == 0){
             return responseTojson(1,"密码不能为空");
         }else if(strlen($userpassword) > 30){
             return responseTojson(1,"你输入的密码过长");
         }
         $result = DB::table('teacher')
                   ->where('teacher_id', $usercount)
                   ->where('password', $userpassword)
                   ->count();
         if($result != 1){
             return responseTojson(1,"账号或密码输入错误");
         }
        return self::saveAccount($usercount);
     }
    /**添加老师的信息
     * @param $datas
     * @return \Illuminate\Http\JsonResponse
     */
     public static function addTeacherDatas($datas){
        $response =  DB::table('teacher')
                     ->insert([
                         'teacher_id'            => $datas['teacher_id'],
                         'password'              => $datas['teacher_id'],       //初始密码设置为工号
                         'teacher_department'    => $datas['teacher_department'],
                         'name'                  => $datas['name'],
                         'office_phone'          => $datas['office_phone'],
                         'home_phone'            => $datas['home_phone'],
                         'phone'                 => $datas['phone'],
                         'number'                => $datas['number'],
                         'sex'                   => $datas['sex'],
                         'nation'                => $datas['nation'],
                         'borth'                 => $datas['borth'],
                         'polit_outlook'         => $datas['polit_outlook'],
                         'native_place'          => $datas['native_place'],
                         'admin_duties'          => $datas['admin_duties'],
                         'admin_tenure_time'     => $datas['admin_tenure_time'],
                         'job_level'             => $datas['job_level'],
                         'technical_position'    => $datas['technical_position'],
                         'academic_title'        => $datas['academic_title'],
                         'review_time'           => $datas['review_time'],
                         'appointment_time'      => $datas['appointment_time'],
                         'series'                => $datas['series'],
                         'post_category'         => $datas['post_category'],
                         'company'               => $datas['company'],
                         'te_re_department'      => $datas['te_re_department'],
                         'working_hours'         => $datas['working_hours'],
                         'origin_work_unit'      => $datas['origin_work_unit'],
                         'certificate_num'       => $datas['certificate_num'],
                         'identity_card'         => $datas['identity_card'],
                         'edu_school'            => $datas['edu_school'],
                         'first_academic'        => $datas['first_academic'],
                         'first_graduate_school' => $datas['first_graduate_school'],
                         'first_study_major'     => $datas['first_study_major'],
                         'first_graduation_time' => $datas['first_graduation_time'],
                         'most_academic'         => $datas['most_academic'],
                         'most_graduate_school'  => $datas['most_graduate_school'],
                         'most_study_major'      => $datas['most_study_major'],
                         'most_graduation_time'  => $datas['most_graduation_time'],
                         'work_major'            => $datas['work_major'],
                         'belong_subject'        => $datas['belong_subject'],
                         'teach_course'          => $datas['teach_course'],
                         'master_company'        => $datas['master_company'],
                         'master_time'           => $datas['master_time'],
                         'create_time'           => time()
                     ]);
        return ($response) ? responseTojson(0,'添加老师信息成功')
               : responseTojson(1,'添加老师信息失败');
     }
     //查询全部老师信息
     public static function selectAllTeacherDatas(){
         $result = DB::table('teacher')->orderBy('appointment_time','asc')->get();
         foreach ($result as $datas){
             $datas->admin_tenure_time      = date('Y-m-d',$datas->admin_tenure_time);
             $datas->review_time            = date('Y-m-d',$datas->review_time);
             $datas->appointment_time       = date('Y-m-d',$datas->appointment_time);
             $datas->working_hours          = date('Y-m-d',$datas->working_hours);
             $datas->first_graduation_time  = date('Y-m-d',$datas->first_graduation_time);
             $datas->most_graduation_time   = date('Y-m-d',$datas->most_graduation_time);
             $datas->master_time            = date('Y-m-d',$datas->master_time);
         }
         return $result;
     }
    /**查询老师的信息
     * @param $teacher_id
     * @return \Illuminate\Http\JsonResponse
     */
     public static function selectTeacherDatas($teacher_id){
         $buffer     = DB::table('teacher')->where('teacher_id', $teacher_id)->first();
         $buffer     = json_decode(json_encode($buffer));
         $buffer     = (array)$buffer;
         $message['role_status'] = $buffer['post_category'];
         $message['information'] = $buffer;
         return responseTojson(0,'查询成功','',$message);
     }
    /**查找老师证书图片路径
     * @param $teacher_id
     * @param $status
     * @return mixed
     */
     public static function selectCertificateRoad($teacher_id,$status){
         if($status == 1){
             $image = DB::table('teacher')
                      ->select('gra_cert_road')
                      ->where('teacher_id',$teacher_id)
                      ->first();
             return $image->gra_cert_road;
         }elseif ($status == 2){
             $image = DB::table('teacher')
                      ->select('edu_cert_road')
                      ->where('teacher_id',$teacher_id)
                      ->first();
             return $image->edu_cert_road;
         }elseif($status == 3){       //删除老师的时候，需要查出两个
             $teacher_image_road = [];
             $image = DB::table('teacher')
                 ->select('edu_cert_road','gra_cert_road')
                 ->where('teacher_id',$teacher_id)
                 ->first();
             array_push($teacher_image_road,$image->edu_cert_road);
             array_push($teacher_image_road,$image->gra_cert_road);
             return $teacher_image_road;
         }
     }
     //修改老师的信息
    /**
     * @param $teacher_id
     * @param $datas
     * @return \Illuminate\Http\JsonResponse
     */
     public static function updateTeacherDatas($teacher_id,$datas){
         $retUpdate = DB::table('teacher')
                      ->where('teacher_id',$teacher_id)
                      ->update([
                          'teacher_department'    => $datas['teacher_department'],
                          'name'                  => $datas['name'],
                          'office_phone'          => $datas['office_phone'],
                          'home_phone'            => $datas['home_phone'],
                          'phone'                 => $datas['phone'],
                          'number'                => $datas['number'],
                          'sex'                   => $datas['sex'],
                          'nation'                => $datas['nation'],
                          'borth'                 => $datas['borth'],
                          'polit_outlook'         => $datas['polit_outlook'],
                          'native_place'          => $datas['native_place'],
                          'admin_duties'          => $datas['admin_duties'],
                          'admin_tenure_time'     => $datas['admin_tenure_time'],
                          'job_level'             => $datas['job_level'],
                          'technical_position'    => $datas['technical_position'],
                          'academic_title'        => $datas['academic_title'],
                          'review_time'           => $datas['review_time'],
                          'appointment_time'      => $datas['appointment_time'],
                          'series'                => $datas['series'],
                          'post_category'         => $datas['post_category'],
                          'company'               => $datas['company'],
                          'te_re_department'      => $datas['te_re_department'],
                          'working_hours'         => $datas['working_hours'],
                          'origin_work_unit'      => $datas['origin_work_unit'],
                          'certificate_num'       => $datas['certificate_num'],
                          'identity_card'         => $datas['identity_card'],
                          'edu_school'            => $datas['edu_school'],
                          'first_academic'        => $datas['first_academic'],
                          'first_graduate_school' => $datas['first_graduate_school'],
                          'first_study_major'     => $datas['first_study_major'],
                          'first_graduation_time' => $datas['first_graduation_time'],
                          'most_academic'         => $datas['most_academic'],
                          'most_graduate_school'  => $datas['most_graduate_school'],
                          'most_study_major'      => $datas['most_study_major'],
                          'most_graduation_time'  => $datas['most_graduation_time'],
                          'work_major'            => $datas['work_major'],
                          'belong_subject'        => $datas['belong_subject'],
                          'teach_course'          => $datas['teach_course'],
                          'master_company'        => $datas['master_company'],
                          'master_time'           => $datas['master_time'],
                          'update_time'           => time()
                      ]);
         return ($retUpdate != 1) ? responseTojson(1,'修改信息失败')
                : responseTojson(0,'修改信息成功');
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
    //判断新添加的工号是否存在
    public static function isExistsTeacherDatas($new_teacher_id){
        $response = DB::table('teacher')->where('teacher_id',$new_teacher_id)->count();
        return ($response == 1) ? true : false;
    }
    //查看已经存在的老师工号
    public static function selectAllTeacherIdDatas(){
        $all_teacher_id = DB::table('teacher')->select('teacher_id')->get();
        return responseTojson(0,'查询成功','',$all_teacher_id);
    }
    /**把老师账号和身份验证信息存入session
     * @param $usercount
     * @return \Illuminate\Http\JsonResponse
     */
     public static function saveAccount($usercount){
         if(!empty(Session('usercount'))) return responseTojson(1,'你已经登录过了');
         Session::put('usercount', $usercount);     //把用户的信息存入session
         Session::save();
         return responseTojson(0,"登录成功");
     }
     //根据老师密码去查看是否有这个老师，并修改密码
     public static function byOldPasswordSelectDatas($old_password,$new_password){
         $count = DB::tbale('teacher_id')->where('password',$old_password)->count();
         if($count == 1){
             $reset_password = DB::table('teacher')->where('password',$old_password)
                               ->update(['password' => $new_password]);
             return ($reset_password != 1) ? responseTojson(1,'修改密码失败')
                    : responseTojson(0,'修改密码成功');
         }
         return responseTojson(1,'旧密码输入错误');
     }
     //重置老师密码
    public static function initializeTeacherPasswordDatas($teacher_id){
        $initialize = DB::table('teacher')->where('teacher_id',$teacher_id)
                      ->update(['password' => md5(SearchMessageConfig::TEACHER_INITLIZE_PASSWORD)]);
        return ($initialize != 1) ? responseTojson(1,'密码重置失败')
               : responseTojson(0,'密码重置成功');
    }
    /**把session里的用户信息清空
     *
     */
     public static function emptyAccount(){
        Session::forget('usercount');
        Session::flush();
     }
}

