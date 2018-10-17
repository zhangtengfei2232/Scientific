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
     public static function addTeacherDatas(){


     }
     //删除老师的信息
     public static function deleteTeacherDatas(){

     }

    /**查询老师的信息
     * @return string
     */
     public static function selectTeacherDatas(){
         $usercount          = session('usercount');
         $buffer             = DB::table('teacher')->where('teacher_id', $usercount)->first();
         $academic           = AcademicDatabase::selectAcademic($buffer->teacher_id);
         $buffer             = (array)$buffer;                         //把数据转化为数组格式
         $buffer['status']   = session('status');                 //登录角色判断
         $buffer['academic'] = $academic;                             //在数组后面追加老师的毕业信息
         return showMsg(0,'查询成功',$buffer);
     }
     //查找老师证书图片路径
     public static function selectCertificateRoad($status){
         if($status == 1){
             return DB::table('teacher')
                 ->select('gra_cert_road')
                 ->where('teacher_id',session('usercount'))
                 ->get();
         }elseif ($status == 2){
             return DB::table('teacher')
                 ->select('edu_cert_road')
                 ->where('teacher_id',session('usercount'))
                 ->get();
         }else{
             return DB::table('teacher')
                 ->select('gra_cert_road','edu_cert_road')
                 ->where('teacher_id',session('usercount'))
                 ->get();
         }
     }
     //修改老师的信息

    /**
     * @param $datas
     * @param $status
     */
     public static function updateTeacherDatas($datas,$status){
         $teacher_id = session('usercount');
         if($status == 1){                       //只修改老师的毕业证书图片路径
             $retUpdate = DB::table('teacher')
                 ->where('teacher_id',$teacher_id)
                 ->update([

                 ]);
         }elseif($status == 2){                  //只修改老师的学历证书图片路径
             $retUpdate = DB::table('teacher')
                 ->where('teacher_id',$teacher_id)
                 ->update([

                 ]);
         }elseif($status == 3){                  //学历和毕业证书图片都修改
             $retUpdate = DB::table('teacher')
                 ->where('teacher_id',$teacher_id)
                 ->update([

                 ]);
         }
         $retUpdate = DB::table('teacher')
                  ->where('teacher_id',$teacher_id)
                  ->update([

                  ]);



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

