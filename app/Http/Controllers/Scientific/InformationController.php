<?php
namespace App\Http\Controllers\Scientific;

use App\Http\Controllers\Controller;
use App\Model\TeacherDatabase;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    //显示第一个登录的页面
    public function showIndex()
    {
        return view('index');
    }
    //添加老师的信息
    public function addTeacher(Request $request)
    {

    }
    //删除老师的所有信息
    public function deleteTeacher(Request $request)
    {

    }
    //查老师的信息
    public function selectTeacher(Request $request)
    {
        return $resilt = TeacherDatabase::selectTeacherDatas();
    }
    //修改老师的信息
    public function updateTeacher(Request $request)
    {

    }

}