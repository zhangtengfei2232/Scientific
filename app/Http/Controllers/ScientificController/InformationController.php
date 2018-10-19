<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\AcademicDatabase;
use App\Model\TeacherDatabase;
use Illuminate\Http\Request;
use config\uploadsubjectionconfig;
class InformationController extends Controller
{

    /**显示登录后老师的信息页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIndex(){
        return view('index');
    }

    /**添加老师的信息
     * @param Request $request
     */
    public function addTeacher(Request $request){


    }
    //添加证书图片
    public function addCertificate(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $certificate = $request->file('certificate_image');             //接收证书图片
        $status      = trim($request->resetimage);                           //老师修改证书的状态
        $response = judgeReceiveFiles($certificate);                         //判断是否接收成功
        if($response->code != 0){
            return showMsg(1,'上传失败');
        }
        uploadImg(uploadsubjectionconfig::CERTIFICATE,$certificate);
    }

    /**删除老师的所有信息
     * @param Request $request
     */
    public function deleteTeacher(Request $request){

    }

    /**查老师的信息
     * @return string
     */
    public function selectTeacher(){
        $teacher_id = session('usercount');
        return $result = TeacherDatabase::selectTeacherDatas($teacher_id);
    }
    //修改老师信息
    public function updateTeacher(Request $request){
        if(!$request->isMethod('POST')) {
            return showMsg(1, '你请求的方式不对');
        }
        $datas  = [
            'teacher_department'    => trim($request->teacher_department),   //老师所属部门
            'name'                  => trim($request->teacher_name),         //老师名字
            'office_phone'          => trim($request->office_phone),         //老师办公电话
            'home_phone'            => trim($request->home_phone),           //老师住宅电话
            'phone'                 => trim($request->phone),                //老师手机号
            'number'                => trim($request->number),               //老师编号
            'sex'                   => trim($request->sex),                  //老师性别
            'nation'                => trim($request->nation),               //老师民族
            'borth'                 => trim($request->borth),                //老师出生年月日
            'polit_outlook'         => trim($request->polit_outlook),        //老师政治面貌
            'native_place'          => trim($request->native_place),         //老师籍贯
            'admin_duties'          => trim($request->admin_duties),         //老师行政职务
            'tennure_time'          => trim($request->tennure_time),         //老师任职时间
            'job_level'             => trim($request->job_level),            //老师职务级别
            'technical_position'    => trim($request->technical_position),   //老师专业技术职务
            'academic_title'        => trim($request->academic_title),       //老师职称
            'review_time'           => trim($request->review_time),          //评审通过时间
            'appointment_time'      => trim($request->appointment_time),     //聘任时间
            'series'                => trim($request->series),               //老师系列
            'post_category'         => trim($request->post_category),        //老师岗位类别
            'company'               => trim($request->company),              //老师所在单位
            'te_re_department'      => trim($request->te_re_department),     //老师所属教研室或实验室
            'working_hourse'        => trim($request->working_hours),        //老师来校工作时间
            'origin_work_unit'      => trim($request->origin_work_unit),     //老师原工作单位
            'certificate_num'       => trim($request->certificate_num),      //老师教师资格证编号
            'identity_card'         => trim($request->identity_card),        //老师身份证号
            'edu_school'            => trim($request->edu_school),           //老师毕业院校
            'work_major'            => trim($request->work_major),           //老师从事专业
            'belong_subject'        => trim($request->belong_subject),       //老师从事专业所属学科
            'teach_course'          => trim($request->teach_course),         //老师任教课程
            'master_insid '         => trim($request->master_insid)          //老师硕博导
        ];
        $judge_datas = judgeDatas($datas);
        if($judge_datas->code == 1){                                         //没有字段通过验证
            return $judge_datas;
        }
        $academic = [
            'first_academic'        => trim($request->first_academic),       //老师第一学历学位
            'first_study_major'     => trim($request->first_study_major),    //老师第一学历专业
            'first_graduation_time' => trim($request->first_graduation_time),//老师第一学历毕业时间
            'first_graduate_school' => trim($request->first_graduate_school),//老师第一学历毕业学校
            'most_academic'         => trim($request->most_academic),        //老师最高学历学位
            'most_study_major'      => trim($request->most_study_major),     //老师最高学历专业
            'most_graduation_time'  => trim($request->most_graduation_time), //老师最高学历毕业时间
            'most_graduate_school'  => trim($request->most_graduate_school), //老师最高学历毕业学校
        ];
        $judge_academic = judgeAcademic($academic);
        if($judge_academic->code == 1){
            return $academic;
        }
        TeacherDatabase::beginTraction();
        $reset_academic = AcademicDatabase::updateAcademic($academic);
        $reset_teacher  = TeacherDatabase::updateTeacherDatas($datas);
        if($reset_academic && $reset_teacher){
            TeacherDatabase::commit();
        }else{
            TeacherDatabase::rollback();
            return showMsg(1,'修改信息失败');
        }
        return showMsg(0,'修改信息成功');
    }
    //修改证书图片
    public function updateCertificate(Request $request){
        if(!$request->isMethod('PSOT')){
            return showMsg(1,'你请求的方式不对');
        }
        $certificate = $request->file('certificate_image');             //接收证书图片文件
        $status      = trim($request->resetimage);                           //老师修改证书的状态
        $response = judgeReceiveFiles($certificate);                         //判断是否接收成功
        if($response->code != 0){
           return showMsg(1,'上传失败');
        }
        $teacher_id       = session('usercount');
        //查找老师证书路径
        $certificate_road = TeacherDatabase::selectCertificateRoad($teacher_id,$status);
        TeacherDatabase::beginTraction();
        //上传新的老师证书图片
        $new_certificate = uploadImg(uploadsubjectionconfig::CERTIFICATE,$certificate);
        //修改老师证书路径
        $reset_certificate = TeacherDatabase::updateCertificate($teacher_id,$new_certificate,$status);
        if($reset_certificate){
            TeacherDatabase::commit();
        }else{
            TeacherDatabase::rollback();
            deleteImg(uploadsubjectionconfig::TEACHER,$new_certificate);
            return showMsg(1,'上传证书图片失败');
        }
        //删除以前的证书图片
        deleteImg(uploadsubjectionconfig::TEACHER,$certificate_road);
        return showMsg(0,'上传证书图片成功');
    }

}