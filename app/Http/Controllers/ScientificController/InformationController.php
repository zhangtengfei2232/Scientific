<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\TeacherDatabase;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    //显示登录后老师的信息页面
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
    public function selectTeacher()
    {
        return $result = TeacherDatabase::selectTeacherDatas();
    }
    //修改老师的信息
    public function updateTeacher(Request $request)
    {
        $study_major_low      = trim($request->study_major_low);
        $graduation_time_low  = trim($request->graduation_time_low);
        $graduate_school_low  = trim($request->graduate_school_low);
        $sex                  = trim($request->sex);
        $borth                = trim($request->borth);
        $phone                = trim($request->phone);
        $job_level            = trim($request->job_level);
        $home_phone           = trim($request->home_phone);
        $edu_school           = trim($request->edu_school);
        $name                 = trim($request->teacher_name);
        $office_phone         = trim($request->office_phone);
        $native_place         = trim($request->native_place);
        $admin_duties         = trim($request->admin_duties);
        $tennure_time         = trim($request->tennure_time);
        $polit_outlook        = trim($request->polit_outlook);
        $post_category        = trim($request->post_category);
        $academic_high        = trim($request->academic_high);
        $study_major_high     = trim($request->study_major_high);
        $series               = trim($request->series);
        $number               = trim($request->number);
        $nation               = trim($request->nation);
        $company              = trim($request->company);
        $working_hours        = trim($request->working_hours);
        $identity_card        = trim($request->identity_card);
        $certificate_num      = trim($request->certificate_num);
        $te_re_department     = trim($request->te_re_department);
        $origin_work_unit     = trim($request->origin_work_unit);
        $academic_low         = trim($request->academic_low);
        $graduation_time_high = trim($request->graduation_time_high);
        $graduate_school_high = trim($request->graduate_school_high);
        return $result = TeacherDatabase::updateTeacherDatas();
    }

}