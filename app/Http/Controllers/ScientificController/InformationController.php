<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use App\Model\TeacherDatabase;
use config\SearchMessageConfig;
use Illuminate\Http\Request;
use config\UploadSubjectionConfig;
class InformationController extends Controller
{
    /**显示登录后老师的信息页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIndex(){
        return view('index');
    }
    //查看已经存在的老师工号
    public function selectAllTeacherId(){
        return TeacherDatabase::selectAllTeacherIdDatas();
    }
    //修改老师密码
    public function updateTeacherPassword(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $old_password = trim($request->old_password);
        $new_password = trim($request->new_password);
        if(!preg_match("/^[A-Za-z0-9]+$/",$new_password) || strlen($new_password) > 30){
            return responseTojson(1,'你输入的新密码必须为字母或数字且不超过30位');
        }
        return TeacherDatabase::byOldPasswordSelectDatas($old_password,$new_password);
    }
    //重置老师密码
    public function initializeTeacherPassword(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $teacher_id = trim($request->teacher_id);
        $judge_teacher_id = judgeTeacherIdField($teacher_id);
        if($judge_teacher_id['code'] == 1){
            return responseTojson(1,$judge_teacher_id['message']);
        }
        $is_exists_teacher = TeacherDatabase::isExistsTeacherDatas($teacher_id);
        if(!$is_exists_teacher){
            return responseTojson(1,'你输入的老师工号不存在');
        }
        return TeacherDatabase::initializeTeacherPasswordDatas($teacher_id);
    }
    //修改老师的岗位类别
    public function updateTeacherPostCategory(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $teacher_id = $request->teacher_id;
        $judge_teacher_id = judgeTeacherIdField($teacher_id);
        if($judge_teacher_id['code'] == 1){
            return responseTojson(1,$judge_teacher_id['message']);
        }
        $is_exists_teacher = TeacherDatabase::isExistsTeacherDatas($teacher_id);
        if(!$is_exists_teacher){
            return responseTojson(1,'你输入的老师工号不存在');
        }
        $new_admin_duties = trim($request->admin_duties);
        return TeacherDatabase::updateTeacherPostCategoryDatas($teacher_id,$new_admin_duties);
    }
    /**添加老师信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTeacher(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $teacher_id = trim($request->teacher_id);
        $judge_teacher_id = judgeTeacherIdField($teacher_id);
        if($judge_teacher_id['code'] == 1){
            return responseTojson(1,$judge_teacher_id['message']);
        }
        $is_exists_teacher = TeacherDatabase::isExistsTeacherDatas($teacher_id);
        if($is_exists_teacher){
            return responseTojson(1,'老师工号已经存在');
        }
        $series = trim($request->series);                           //老师系列
        if (strlen($series) > 29){
            return responseTojson(1,'你输入的系列名称过长');
        }
        $datas  = [
            'teacher_id'            => $teacher_id,                          //老师工号
            'name'                  => trim($request->name),                 //老师名字
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
            'admin_tenure_time'     => trim($request->admin_tenure_time),    //老师任职时间
            'job_level'             => trim($request->job_level),            //老师职务级别
            'technical_position'    => trim($request->technical_position),   //老师专业技术职务
            'academic_title'        => trim($request->academic_title),       //老师职称
            'review_time'           => trim($request->review_time),          //评审通过时间
            'appointment_time'      => trim($request->appointment_time),     //聘任时间
            'company'               => trim($request->company),              //老师所在单位
            'te_re_department'      => trim($request->te_re_department),     //老师所属教研室或实验室
            'working_hours'         => trim($request->working_hours),        //老师来校工作时间
            'origin_work_unit'      => trim($request->origin_work_unit),     //老师原工作单位
            'certificate_num'       => trim($request->certificate_num),      //老师教师资格证编号
            'identity_card'         => trim($request->identity_card),        //老师身份证号
            'edu_school'            => trim($request->edu_school),           //老师毕业院校
            'first_academic'        => trim($request->first_academic),       //老师第一学历学位
            'first_study_major'     => trim($request->first_study_major),    //老师第一学历专业
            'first_graduation_time' => trim($request->first_graduation_time),//老师第一学历毕业时间
            'first_graduate_school' => trim($request->first_graduate_school),//老师第一学历毕业学校
            'most_academic'         => trim($request->most_academic),        //老师最高学历学位
            'most_study_major'      => trim($request->most_study_major),     //老师最高学历专业
            'most_graduation_time'  => trim($request->most_graduation_time), //老师最高学历毕业时间
            'most_graduate_school'  => trim($request->most_graduate_school), //老师最高学历毕业学校
            'work_major'            => trim($request->work_major),           //老师从事专业
            'belong_subject'        => trim($request->belong_subject),       //老师从事专业所属学科
            'teach_course'          => trim($request->teach_course),         //老师任教课程
            'master_company'        => trim($request->master_company),       //老师硕博导授予单位
            'master_time'           => trim($request->master_time)           //老师硕博导授予时间
        ];
        $judge_datas = judgeTeacherField($datas);
        if($judge_datas['code'] == 1){                                        //没有字段通过验证
            return responseTojson(1,$judge_datas['message']);
        }
        $datas['series'] = $series;
        $datas['teacher_department'] = trim($request->teacher_department);    //老师所属部门
        return TeacherDatabase::addTeacherDatas($datas);
    }
    //添加老师证书信息
    public function addCertificate(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        if(!$request->is_add_teacher){
            return responseTojson(1,'请你先添加老师信息');
        }
        if(!$request->hasFile('gra_cert_road') && !$request->hasFile('edu_cert_road')){
            return responseTojson(1,'请你上传证书图片');
        }
        if($request->file('gra_cert_road')){
            $status         = 1;
            $subjection     = UploadSubjectionConfig::GRADUCETION_IMG;
            $certificate    = $request->file('gra_cert_road');            //接收毕业证书图片
        }else{
            $status         = 2;
            $subjection     = UploadSubjectionConfig::EDUCATION_IMG;
            $certificate    = $request->file('edu_cert_road');             //接收学历证书图片
        }
        $judge_certificate  = judgeFileImage($certificate);                    //判断文件是否合法
        if($judge_certificate['code'] == 1){
            return responseTojson(1,$judge_certificate['message']);
        }
        $disk       = UploadSubjectionConfig::TEACHER;
        $teacher_id = $request->teacher_id;
        $new_certificate_road = uploadFiles($subjection,$certificate,$disk);
        $add_certificate  = TeacherDatabase::updateCertificate($teacher_id,$new_certificate_road,$status);
        TeacherDatabase::beginTraction();
        if(!$add_certificate){
            TeacherDatabase::rollback();
            deletefiles($disk,$new_certificate_road);
            return responseTojson(1,'上传图片失败');
        }
        TeacherDatabase::commit();
        return responseTojson(0,'证书图片添加成功');
    }
    /**删除老师的所有信息
     */
    public function deleteTeacher(Request $request){
        $teacher_id           = trim($request->teacher_id);
        /**
         * 删除前，做一个判断，看数据库里是否有两个办公室主任，
         * 否则会出现，从此无法添加老师和修改老师角色
         */
        $judge_director_office_num = TeacherDatabase::countDirectorOfficeNum($teacher_id);
        if($judge_director_office_num['code'] == 1){
            return responseTojson(1,'你必须先添加一个办公室主任，才能删除这个办公室主任');
        }
        //老师论文
        $artical_table_name   = SearchMessageConfig::ARTICAL_TABLE;
        $art_road             = SearchMessageConfig::ARTICAL_ROAD;
        $art_sci_road         = SearchMessageConfig::ARTICAL_SCI_ROAD;
        $art_id_field         = SearchMessageConfig::ARTICAL_ID;
        $artical_datas        = ModelDatabase::byTeacherIdSelect($teacher_id,$art_id_field,$artical_table_name,$art_road,$art_sci_road);
        $artical_road_datas   = $artical_datas['file_road'];
        $artical_id_datas     = $artical_datas['id_datas'];
        //老师成果鉴定
        $appraisal_table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $ap_road              = SearchMessageConfig::AP_ROAD;
        $ap_id_field          = SearchMessageConfig::APPRAISAL_ID;
        $appraisal_datas      = ModelDatabase::byTeacherIdSelect($teacher_id,$ap_id_field,$appraisal_table_name,$ap_road);
        $appraisal_road_datas = $appraisal_datas['file_road'];
        $appraisal_id_datas   = $appraisal_datas['id_datas'];
        //老师著作
        $opus_table_name      = SearchMessageConfig::OPUS_TABLE;
        $op_id_filed          = SearchMessageConfig::OPUS_ID;
        $op_road              = SearchMessageConfig::OP_ROAD;
        $opus_datas           = ModelDatabase::byTeacherIdSelect($teacher_id,$op_id_filed,$opus_table_name,$op_road);
        $opus_road_datas      = $opus_datas['file_road'];
        $op_id_datas          = $opus_datas['id_datas'];
        //老师获奖
        $award_table_name     = SearchMessageConfig::AWARD_TABLE;
        $aw_road              = SearchMessageConfig::AW_ROAD;
        $aw_id_field          = SearchMessageConfig::AWARD_ID;
        $aw_datas             = ModelDatabase::byTeacherIdSelect($teacher_id,$aw_id_field,$award_table_name,$aw_road);
        $aw_road_datas        = $aw_datas['file_road'];
        $aw_id_datas          = $aw_datas['id_datas'];
        //老师担任团体职务
        $duties_table_name    = SearchMessageConfig::DUTIES_TABLE;
        $du_road              = SearchMessageConfig::DU_ROAD;
        $du_id_field          = SearchMessageConfig::DUTIES_ID;
        $duties_datas         = ModelDatabase::byTeacherIdSelect($teacher_id,$du_id_field,$duties_table_name,$du_road);
        $du_road_datas        = $duties_datas['file_road'];
        $du_id_datas          = $duties_datas['id_datas'];
        //老师专利
        $patent_table_name    = SearchMessageConfig::PATENT_TABLE;
        $pa_id_field          = SearchMessageConfig::PATENT;
        $pa_road              = SearchMessageConfig::PA_ROAD;
        $patent_datas         = ModelDatabase::byTeacherIdSelect($teacher_id,$pa_id_field,$patent_table_name,$pa_road);
        $pa_road_datas        = $patent_datas['file_road'];
        $pa_id_datas          = $patent_datas['id_datas'];
        //老师项目
        $project_table_name   = SearchMessageConfig::PROJECT_TABLE;
        $project_road         = SearchMessageConfig::PRO_ROAD;
        $pro_id_field         = SearchMessageConfig::PROJECT_ID;
        $proejct_datas        = ModelDatabase::byTeacherIdSelect($teacher_id,$pro_id_field,$project_table_name,$project_road);
        $project_road_datas   = $proejct_datas['file_road'];
        $project_id_datas     = $proejct_datas['id_datas'];
        //老师举行会议
        $holdmeet_table_name  = SearchMessageConfig::HOLD_MEET_TABLE;
        $ho_id_field          = SearchMessageConfig::HOLDMEET_ID;
        $ho_image_status      = UploadSubjectionConfig::HOLD_IMG_STATUS;
        $hold_injection_field = SearchMessageConfig::HOLDMEET_INJECTION;
        $holdmeet_datas       = ModelDatabase::byTeacherIdSelect($teacher_id,'',$holdmeet_table_name,$ho_id_field,'',$ho_image_status,$hold_injection_field);
        $ho_image_road_datas  = $holdmeet_datas['file_road'];
        $ho_id_datas          = $holdmeet_datas['id_datas'];
        $ho_image_id_datas    = $holdmeet_datas['image_id_datas'];
        //老师参加会议
        $joinmeet_table_name  = SearchMessageConfig::JOIN_MEET_TABLE;
        $jo_id_field          = SearchMessageConfig::JOINMEET_ID;
        $jo_image_status      = UploadSubjectionConfig::JOIN_IMG_STATUS;
        $join_injection_field = SearchMessageConfig::JOINMEET_INJECTION;
        $joinmeet_datas       = ModelDatabase::byTeacherIdSelect($teacher_id,'',$joinmeet_table_name,$jo_id_field,'',$jo_image_status,$join_injection_field);
        $jo_image_road_datas  = $joinmeet_datas['file_road'];
        $jo_id_datas          = $joinmeet_datas['id_datas'];
        $jo_image_id_datas    = $joinmeet_datas['image_id_datas'];
        //老师讲学
        $lecture_table_name   = SearchMessageConfig::LECTURE_TABLE;
        $le_id_field          = SearchMessageConfig::LECTURE_ID;
        $le_image_status      = UploadSubjectionConfig::LECTURE_IMG_STATUS;
        $le_injection_field   = SearchMessageConfig::LECTURE_INJECTION;
        $lecture_datas        = ModelDatabase::byTeacherIdSelect($teacher_id,'',$lecture_table_name,$le_id_field,'',$le_image_status,$le_injection_field);
        $le_image_road_datas  = $lecture_datas['file_road'];
        $le_id_datas          = $lecture_datas['id_datas'];
        $le_image_id_datas    = $lecture_datas['image_id_datas'];
        //老师本人信息
        $teacher_road_datas   = TeacherDatabase::selectCertificateRoad($teacher_id,3);
        $teacher_disk         = UploadSubjectionConfig::TEACHER;
        $artical_disk         = UploadSubjectionConfig::ARTICAL;
        $appraisal_disk       = UploadSubjectionConfig::APPRAISAL;
        $opus_disk            = UploadSubjectionConfig::OPUS;
        $award_disk           = UploadSubjectionConfig::AWARD;
        $duties_disk          = UploadSubjectionConfig::DUTIES;
        $patent_disk          = UploadSubjectionConfig::PATENT;
        $project_disk         = UploadSubjectionConfig::PROJECT;
        $holdmeet_disk        = UploadSubjectionConfig::HOLD_MEET;
        $joinmeet_disk        = UploadSubjectionConfig::JOIN_MEET;
        $lecture_disk         = UploadSubjectionConfig::LECTURE;
        $teacher_table_name   = SearchMessageConfig::TEACHER_TABLE;
        $teacher_id_field     = SearchMessageConfig::TEACHER_ID;
        $teacher_id_datas[0]  = $teacher_id;
        $image_table_name     = SearchMessageConfig::IMAGE_TABLE;
        $im_id_field          = SearchMessageConfig::IMAGE_ID;
        //把举行会议，参加会议，专家讲学的图片ID合并为一个数组
        $image_id_datas = array_merge($ho_image_id_datas,$jo_image_id_datas,$le_image_id_datas);
        /**
         *删除一个老师的所有数据
         */
        ModelDatabase::beginTraction();
        $delete_artical    = ModelDatabase::deleteAllDatas($artical_table_name,$art_id_field,$artical_id_datas);    //删除文章
        $delete_appraisal  = ModelDatabase::deleteAllDatas($appraisal_table_name,$ap_id_field,$appraisal_id_datas); //删除成果鉴定
        $delete_opus       = ModelDatabase::deleteAllDatas($opus_table_name,$op_id_filed,$op_id_datas);             //删除著作
        $delete_award      = ModelDatabase::deleteAllDatas($award_table_name,$aw_id_field,$aw_id_datas);            //删除获奖
        $delete_duties     = ModelDatabase::deleteAllDatas($duties_table_name,$du_id_field,$du_id_datas);           //删除担任团体职务
        $delete_patent     = ModelDatabase::deleteAllDatas($patent_table_name,$pa_id_field,$pa_id_datas);           //删除专利
        $delete_project    = ModelDatabase::deleteAllDatas($project_table_name,$pro_id_field,$project_id_datas);    //删除项目
        $delete_holdmeet   = ModelDatabase::deleteAllDatas($holdmeet_table_name,$ho_id_field,$ho_id_datas);         //删除举行会议
        $delete_joinmeet   = ModelDatabase::deleteAllDatas($joinmeet_table_name,$jo_id_field,$jo_id_datas);         //删除参加会议
        $delete_lecture    = ModelDatabase::deleteAllDatas($lecture_table_name,$le_id_field,$le_id_datas);          //删除专家讲学
        $delete_image      = ModelDatabase::deleteAllDatas($image_table_name,$im_id_field,$image_id_datas);         //删除举行会议，参加会议，专家讲学图片
        $delete_teacher    = ModelDatabase::deleteAllDatas($teacher_table_name,$teacher_id_field,$teacher_id_datas);//删除老师信息
        if($delete_artical && $delete_appraisal && $delete_opus && $delete_award && $delete_duties && $delete_patent && $delete_project
            && $delete_holdmeet && $delete_joinmeet && $delete_lecture && $delete_teacher && $delete_image
        ){
            ModelDatabase::commit();
            /**
             * 删除一个老师的所有文件
             */
            deleteAllFiles($teacher_disk,$teacher_road_datas);
            deleteAllFiles($artical_disk,$artical_road_datas);
            deleteAllFiles($appraisal_disk,$appraisal_road_datas);
            deleteAllFiles($opus_disk,$opus_road_datas);
            deleteAllFiles($award_disk,$aw_road_datas);
            deleteAllFiles($duties_disk,$du_road_datas);
            deleteAllFiles($patent_disk,$pa_road_datas);
            deleteAllFiles($project_disk,$project_road_datas);
            deleteAllFiles($holdmeet_disk,$ho_image_road_datas);
            deleteAllFiles($joinmeet_disk,$jo_image_road_datas);
            deleteAllFiles($lecture_disk,$le_image_road_datas);
            return responseTojson(0,'删除老师信息成功');
        }
        ModelDatabase::rollback();
        return responseTojson(1,'删除老师信息失败');
    }
    /**查老师的信息
     * @return string
     */
    public function selectTeacher(){
        $teacher_id = session('usercount');
        return TeacherDatabase::selectTeacherDatas($teacher_id);
    }
    //修改老师信息
    public function updateTeacher(Request $request){
        if(!$request->isMethod('POST')) {
            return responseTojson(1, '你请求的方式不对');
        }
        $series = trim($request->series);                           //老师系列
        if (strlen($series) > 29){
            return responseTojson(1,'你输入的系列名称过长');
        }
        $datas  = [
            'teacher_department'    => trim($request->teacher_department),   //老师所属部门
            'name'                  => trim($request->name),                 //老师名字
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
            'admin_tenure_time'     => trim($request->admin_tenure_time),    //老师任职时间
            'job_level'             => trim($request->job_level),            //老师职务级别
            'technical_position'    => trim($request->technical_position),   //老师专业技术职务
            'academic_title'        => trim($request->academic_title),       //老师职称
            'review_time'           => trim($request->review_time),          //评审通过时间
            'appointment_time'      => trim($request->appointment_time),     //聘任时间
            'company'               => trim($request->company),              //老师所在单位
            'te_re_department'      => trim($request->te_re_department),     //老师所属教研室或实验室
            'working_hours'         => trim($request->working_hours),        //老师来校工作时间
            'origin_work_unit'      => trim($request->origin_work_unit),     //老师原工作单位
            'certificate_num'       => trim($request->certificate_num),      //老师教师资格证编号
            'identity_card'         => trim($request->identity_card),        //老师身份证号
            'edu_school'            => trim($request->edu_school),           //老师毕业院校
            'first_academic'        => trim($request->first_academic),       //老师第一学历学位
            'first_study_major'     => trim($request->first_study_major),    //老师第一学历专业
            'first_graduation_time' => trim($request->first_graduation_time),//老师第一学历毕业时间
            'first_graduate_school' => trim($request->first_graduate_school),//老师第一学历毕业学校
            'most_academic'         => trim($request->most_academic),        //老师最高学历学位
            'most_study_major'      => trim($request->most_study_major),     //老师最高学历专业
            'most_graduation_time'  => trim($request->most_graduation_time), //老师最高学历毕业时间
            'most_graduate_school'  => trim($request->most_graduate_school), //老师最高学历毕业学校
            'work_major'            => trim($request->work_major),           //老师从事专业
            'belong_subject'        => trim($request->belong_subject),       //老师从事专业所属学科
            'teach_course'          => trim($request->teach_course),         //老师任教课程
            'master_company'        => trim($request->master_company),       //老师硕博导授予单位
            'master_time'           => trim($request->master_time)           //老师硕博导授予时间
        ];
        $judge_datas = judgeTeacherField($datas);
        if($judge_datas['code'] == 1){                                       //没有字段通过验证
            return responseTojson(1,$judge_datas['message']);
        }
        $datas['series'] = $series;
        $teacher_id = session('usercount');
        return TeacherDatabase::updateTeacherDatas($teacher_id,$datas);
    }
    //修改证书图片
    public function updateCertificate(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        if(!$request->hasFile('gra_cert_road') && !$request->hasFile('edu_cert_road')){
            return responseTojson(1,'请你上传证书图片');
        }
        if($request->hasFile('gra_cert_road')){
            $status      = 1;
            $certificate = $request->file('gra_cert_road');             //接收证书图片文件
            $subjection  = UploadSubjectionConfig::GRADUCETION_IMG;
        }else{
            $status      = 2;
            $certificate = $request->file('edu_cert_road');             //接收证书图片文件
            $subjection  = UploadSubjectionConfig::EDUCATION_IMG;
        }
        $judge_certificate = judgeFileImage($certificate);                  //判断文件是否合法
        if($judge_certificate['code'] == 1){
           return responseTojson(1,$judge_certificate['message']);
        }
        $disk             = UploadSubjectionConfig::TEACHER;
        $teacher_id       = session('usercount');
        $certificate_road = TeacherDatabase::selectCertificateRoad($teacher_id,$status);  //查找老师证书路径
        TeacherDatabase::beginTraction();
        $new_certificate_road = uploadFiles($subjection,$certificate,$disk);              //上传新的老师证书图片
        $reset_certificate = TeacherDatabase::updateCertificate($teacher_id,$new_certificate_road,$status); //修改老师证书路径
        if($reset_certificate){
            TeacherDatabase::commit();
            deletefiles($disk,$certificate_road);
            return responseTojson(0,'上传证书图片成功');                    //删除以前的证书图片
        }
        TeacherDatabase::rollback();
        deletefiles($disk,$new_certificate_road);
        return responseTojson(1,'上传证书图片失败');
    }
}