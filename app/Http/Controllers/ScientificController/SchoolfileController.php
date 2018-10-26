<?php
namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use App\Model\SchoolfileDatabase;
use config\uploadSubjectionConfig;
use Illuminate\Http\Request;
class SchoolfileController extends Controller
{
    //添加校发文件
    public function addSchoolfile(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $datas = [
            'schoolfile_name'   => trim($request->schoolfile_name),
            'cooperate_unit'    => trim($request->cooperate_unit),
            'schfile_down_time' => trim(data('Y-m-d',$request->scfile_down_time)),
        ];
        $judge_datas = judgeSchoolfileField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        $schoolfile_pdf   = $request->file('schoolfile_pdf');//验证接收的文件
        $judge_schoolfile = judgeReceiveFiles($schoolfile_pdf);
        if($judge_schoolfile->code == 1){
            return $judge_schoolfile;
        }
        $add_schoolfile_road = uploadFiles(uploadSubjectionConfig::SCHOOL_FILE_PDF,$schoolfile_pdf);
        $datas['schfile_road'] = $add_schoolfile_road;
        $add_schoolfile = SchoolfileDatabase::addSchoolfileDatas($datas);
        if($add_schoolfile){
            return showMsg(0,'上传校发文件成功');
        }
        deletefiles(uploadSubjectionConfig::SCHOOL_FILE,$add_schoolfile_road);
        return showMsg(1,'上传校发文件失败');
    }
    //删除单个校发文件
    public function deleteSchoolfile(Request $request){
        $shcoolfile_id     = $request->schoolfile_id;
        $schoolfile_road   = SchoolfileDatabase::selectSchoolfileRoad($shcoolfile_id);
        $delete_schoolfile = SchoolfileDatabase::deleteSchoolfileDatas($shcoolfile_id);
        if($delete_schoolfile){
            deletefiles(uploadSubjectionConfig::SCHOOL_FILE,$schoolfile_road);
            return showMsg(0,'删除校发文件成功');
        }
        return showMsg(1,'删除校发文件失败');
    }
    //删除多个校发文件
    public function deleteAllSchoolfile(Request $request){
        $validate = true;
        $schoolfile_id_datas  = $request->schoolfile_id_datas;
        $schoofile_road_datas = SchoolfileDatabase::selectAllSchoolfileRoad($schoolfile_id_datas);
        $delete_schoolfile    = SchoolfileDatabase::deleteAllSchoolfileDatas($schoolfile_id_datas);
        if($delete_schoolfile->code == 1){
            $validate = false;
            //有些校发文件删除失败，去查文件的原来名称
            $schoolfile_name = SchoolfileDatabase::selectAllSchoolfileName($delete_schoolfile);
            //根据文件'ID'键，去除掉删除失败的校发文件路径
            for($i = 0; $i < count($delete_schoolfile); $i++){
                array_splice($schoofile_road_datas,$delete_schoolfile[$i],1);
            }
            $response['fail_schoolfile'] = $schoolfile_name;
        }
        deletefiles(uploadSubjectionConfig::SCHOOL_FILE,$schoofile_road_datas);
        if($validate){
            return $delete_schoolfile;
        }
        return showMsg(1,$delete_schoolfile->message,$response);
    }
    //修改校发文件
    public function updateSchoolfile(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $schfile_id = trim($request->schfile_id);
        $datas = [
            'schfile_id'        => $schfile_id,
            'schoolfile_name'   => trim($request->schoolfile_name),
            'schfile_num'       => trim($request->schfile_num),
            'schfile_down_time' => strtotime(trim($request->schfile_down_time))
        ];
        $judge_datas = judgeSchoolfileField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        $shcoolfile_pdf       = $request->file('schoolfile_pdf');
        $judge_schoolfile_pdf = judgeReceiveFiles($shcoolfile_pdf);
        if($judge_schoolfile_pdf->code == 1){
            return $judge_schoolfile_pdf;
        }
        $old_schoolfile_road = SchoolfileDatabase::selectSchoolfileRoad($schfile_id);
        $new_schoolfile_road = uploadFiles(uploadSubjectionConfig::SCHOOL_FILE_PDF,$shcoolfile_pdf);
        $datas['schfile_road'] = $new_schoolfile_road;
        $disk = uploadSubjectionConfig::SCHOOL_FILE;
        $update_schoolfile = SchoolfileDatabase::updateSchoolfileDatas($datas);
        if($update_schoolfile){
            deletefiles($disk,$old_schoolfile_road);
            return showMsg(0,'修改校发文件成功');
        }
        deletefiles($disk,$new_schoolfile_road);
        return showMsg(1,'修改校发文件失败');
    }
    //查看单个校发文件
    public function selectSchoolfile(Request $request){
        $result = SchoolfileDatabase::selectSchoolfileDatas($request->schoolfile_id);
        return showMsg(0,'查询成功',$result);
    }
    //查看所有校发文件
    public function selectAllSchoolfile(){
        $result = SchoolfileDatabase::selectAllSchoolfileDatas();
        return showMsg(0,'查询成功',$result);
    }

}