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
         if(strlen($usercount) == 0 || strlen($usercount ) > 10){
             return showMsg(1,'账号不存在');
         }
         if(strlen($userpassword) == 0 || strlen($userpassword) >30){
             return showMsg(1,'密码错误');
         }
         $result = DB::table('teacher')
                   ->where('teacher_id', $usercount)
                   ->where('password', $userpassword)
                   ->count();
         if($result == 1){
             $information = TeacherDatabase::selectTeacherDatas($usercount);
             switch ($usercount){
                 case 1  :                                                    //院长
                     return showMsg(2,"登录成功",$information);
                 case 2  :                                                    //副院长
                     return showMsg(3,"登录成功",$information);
                 case 3  :                                                    //科研秘书
                     return showMsg(4,"登录成功",$information);
                 case 4  :                                                    //教学秘书
                     return showMsg(5,"登录成功",$information);
                 case 5  :                                                    //系主任
                     return showMsg(6,"登录成功",$information);
                 case 6  :                                                    //教研室主任
                     return showMsg(7,"登录成功",$information);
                 default :                                                    //普通老师
                     return showMsg(8,"登录成功",$information);
             }
         TeacherDatabase::saveAccount($usercount);                        //把信息存入session                                                           //把老师信息存入session
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
         return  DB::table('teacher')->where('teacher_id', $usercount)->first();
     }
     //修改老师的信息
     public static function updateTeacherDatas()
     {

     }
     //把用户的信息存入session
     public static function saveAccount($usercount)
     {
         Session('usercount', $usercount);
     }
     //把session里的用户信息清空
     public static function emptyAccount()
     {
         Session::flush();
     }
}