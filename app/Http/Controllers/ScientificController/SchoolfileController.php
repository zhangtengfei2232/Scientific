<?php
namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use App\Model\SchoolfileDatabase;
use config\uploadsubjectionconfig;
use Illuminate\Http\Request;
class SchoolfileController extends Controller
{
    //添加校发文件
    public function addSchoolfile(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $schoolfile   = $request->file('schoolfile_pdf');//验证接收的文件
        $judge_schoolfile = judgeReceiveFiles($schoolfile);
        if($judge_schoolfile->code == 1){
            return $judge_schoolfile;
        }
        $add_schoolfile_road = uploadFiles(uploadsubjectionconfig::SCHOOL_FILE_PDF,$add_schoolfile);
        $datas = [
            'teacher_id'        => session('usercount'),
            'cooperate_unit'    => trim($request->cooperate_unit),
            'schfile_down_time' => trim(data('Y-m-d',$request->scfile_down_time)),
            'schfile_road'      => $add_schoolfile_road
        ];
        $judge_datas = judgeSchoolfileField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        $add_schoolfile = SchoolfileDatabase::addSchoolfileDatas($datas);
        if($add_schoolfile){
            return showMsg(0,'上传校发文件成功');
        }
        deletefiles(uploadsubjectionconfig::SCHOOL_FILE,$add_schoolfile_road);
        return showMsg(1,'上传校发文件失败');
    }
    //删除校发文件
    public function deleteSchoolfile(Request $request){
        $shcoolfile_id     = $request->schoolfile_id;
        $schoolfile_road   = SchoolfileDatabase::selectSchoolfileRoad($shcoolfile_id);
        $delete_schoolfile = SchoolfileDatabase::deleteSchoolfileDatas($shcoolfile_id);
        if($delete_schoolfile){
            deletefiles(uploadsubjectionconfig::SCHOOL_FILE,$schoolfile_road);
            return showMsg(0,'删除校发文件成功');
        }
        return showMsg(1,'删除校发文件失败');
    }
    //删除多个校发文件
    public function deleteAllSchoolfile(Request $request){
        $schoolfile_id_datas  = $request->schoolfile_id_datas;
        $schoofile_road_daats = SchoolfileDatabase::selectAllSchoolfileRoad($schoolfile_id_datas);
        

    }
    //修改校发文件
    public function updateSchoolfile(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $shcoolfile = $request->file('schoolfile_pdf');
        $judge_schoolfile = judgeReceiveFiles($shcoolfile);
        if($judge_schoolfile->code == 1){
            return $judge_schoolfile;
        }
        $schfile_id = trim($request->schfile_id);
        $old_schoolfile_road = SchoolfileDatabase::selectSchoolfileRoad($schfile_id);
        $new_schoolfile_road = uploadFiles(uploadsubjectionconfig::SCHOOL_FILE_PDF,$shcoolfile);
        $datas = [
            'schfile_id'        => $schfile_id,
            'schfile_num'       => trim($request->schfile_num),
            'schfile_down_time' => strtotime(trim($request->schfile_down_time)),
            'schfile_road'      => $new_schoolfile_road
        ];
        $disk = uploadsubjectionconfig::SCHOOL_FILE;
        $update_schoolfile = SchoolfileDatabase::updateSchoolfileDatas($datas);
        if($update_schoolfile){
            deletefiles($disk,$old_schoolfile_road);
            return showMsg(0,'修改校发文件成功');
        }
        deletefiles($disk,$new_schoolfile_road);
        return showMsg(1,'修改校发文件失败');
    }
    //查看单个校发文件
    public function selectSchoolfile(){

    }
    //查看所有校发文件
    public function selectAllSchoolfile(){

    }

}