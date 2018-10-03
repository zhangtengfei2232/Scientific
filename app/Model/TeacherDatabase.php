<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class TeacherDatabase extends Model
{
     //根据账号和密码去查用户密码是否输入正确
     public static function selectLogin($usercount,$userpassword)
     {
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
                     return TeacherDatabase::saveAccount($usercount,2);
                 case 2  :                                                    //副院长
                     return TeacherDatabase::saveAccount($usercount,3);
                 case 3  :                                                    //科研秘书
                     return TeacherDatabase::saveAccount($usercount,4);
                 case 4  :                                                    //教学秘书
                     return TeacherDatabase::saveAccount($usercount,5);
                 case 5  :                                                    //系主任
                     return TeacherDatabase::saveAccount($usercount,6);
                 case 6  :                                                    //教研室主任
                     return TeacherDatabase::saveAccount($usercount,7);
                 default :                                                    //普通老师
                     return TeacherDatabase::saveAccount($usercount,8);
             }
         }else{
             return showMsg(1,"账号或密码输入错误");
         }
     }
     //添加老师的信息
     public static function addTeacherDatas()
     {


     }
     //删除老师的信息
     public static function deleteTeacherDatas()
     {

     }
     //查询老师的信息
     public static function selectTeacherDatas()
     {
         $usercount          = session('usercount');
         $buffer             = DB::table('teacher')->where('teacher_id', $usercount)->first();
         $academic           = AcademicDatabase::selectAcademic($buffer->teacher_id);
         $buffer             = (array)$buffer;                         //把数据转化为数组格式
         $buffer['status']   = session('status');                 //登录角色判断
         $buffer['academic'] = $academic;                             //在数组后面追加老师的毕业信息
         return showMsg(0,'查询成功',$buffer);
     }
     //修改老师的信息
     public static function updateTeacherDatas()
     {

     }
     public  static function saveAccount($usercount,$status)
     {
         Session::put('usercount', $usercount);     //把用户的信息存入session
         Session::put('status', $status);
         Session::save();
         return showMsg(0,"登录成功");
     }
     //把session里的用户信息清空
     public static function emptyAccount()
     {
        Session::flush();
     }
}

