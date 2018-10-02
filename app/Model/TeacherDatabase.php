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
         }else if(strlen($userpassword) >30){
             return showMsg(1,'密码错误');
         }
         $result = DB::table('teacher')
                   ->where('teacher_id', $usercount)
                   ->where('password', $userpassword)
                   ->count();
         if($result == 1){
             TeacherDatabase::saveAccount($usercount);                        //把信息存入session
             return session('usercount');
             switch ($usercount){
                 case 1  :                                                    //院长
                     return showMsg(2,"登录成功");
                 case 2  :                                                    //副院长
                     return showMsg(3,"登录成功");
                 case 3  :                                                    //科研秘书
                     return showMsg(4,"登录成功");
                 case 4  :                                                    //教学秘书
                     return showMsg(5,"登录成功");
                 case 5  :                                                    //系主任
                     return showMsg(6,"登录成功");
                 case 6  :                                                    //教研室主任
                     return showMsg(7,"登录成功");
                 default :                                                    //普通老师
                     return showMsg(8,"登录成功");
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
     public static function selectTeacherDatas($usercount)
     {
         $buffer   =  DB::table('teacher')->where('teacher_id', $usercount)->first();
         $academic =  AcademicDatabase::selectAcademic($buffer->teacher_id);
         $buffer   = (array)$buffer;                                    //把数据转化为数组格式
         $buffer['academic'] = $academic;                               //在数组后面追加老师的毕业信息
         return $buffer;
     }
     //修改老师的信息
     public static function updateTeacherDatas()
     {

     }
     //把用户的信息存入session
     public static function saveAccount($usercount)
     {
         session(['usercount'=>$usercount]);
     }
     //把session里的用户信息清空
     public static function emptyAccount()
     {
         Session::flush();
     }
}