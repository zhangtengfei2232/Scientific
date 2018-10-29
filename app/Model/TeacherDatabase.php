<?php
namespace App\Model;

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
             return responseTojson(1,'账号不能为空');
         }else if(strlen($usercount ) > 10){
             return responseTojson(1,"账号不存在");
         }else if(strlen($userpassword) == 0){
             return responseTojson(1,"密码不能为空");
         }else if(strlen($userpassword) > 30){
             return responseTojson(1,'密码错误');
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
     //删除老师的信息
     public static function deleteTeacherDatas(){

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
         $buffer             = DB::table('teacher')->where('teacher_id', $teacher_id)->first();
         $usercount          = session('usercount');
         $juris_diction = config('Jurisdiction');
         foreach ($juris_diction as $juris){
             if(!in_array($usercount,$juris['jurisdiction'])){
                 unset($juris[0]);
             }
         }
         $buffer->borth                  = date('Y-m-d',$buffer->borth);
         $buffer->admin_tenure_time      = date('Y-m-d',$buffer->admin_tenure_time);
         $buffer->review_time            = date('Y-m-d',$buffer->review_time);
         $buffer->appointment_time       = date('Y-m-d',$buffer->appointment_time);
         $buffer->working_hours          = date('Y-m-d',$buffer->working_hours);
         $buffer->first_graduation_time  = date('Y-m-d',$buffer->first_graduation_time);
         $buffer->most_graduation_time   = date('Y-m-d',$buffer->most_graduation_time);
         $buffer->master_time            = date('Y-m-d',$buffer->master_time);
         $message['juris_diction']       = $juris_diction;
         $message['information']         = $buffer;
         return $message;
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
                      ->get();
             return $image->gra_cert_road;
         }elseif ($status == 2){
             $image = DB::table('teacher')
                      ->select('edu_cert_road')
                      ->where('teacher_id',$teacher_id)
                      ->get();
             return $image->edu_cert_road;
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

    /**把老师账号和身份验证信息存入session
     * @param $usercount
     * @return \Illuminate\Http\JsonResponse
     */
     public static function saveAccount($usercount){
         Session::put('usercount', $usercount);     //把用户的信息存入session
         Session::save();
         return responseTojson(0,"登录成功");
     }
    /**把session里的用户信息清空
     *
     */
     public static function emptyAccount(){
        Session::flush();
     }
}

