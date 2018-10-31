<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use App\Model\SchoolfileDatabase;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
use Illuminate\Http\Request;
class SchoolfileController extends Controller
{
    //添加校发文件
    public function addSchoolfile(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $datas = [
            'schfile_name'      => trim($request->schfile_name),
            'schfile_num'       => trim($request->schfile_num),
            'schfile_down_time' => trim($request->schfile_down_time),
        ];
        $judge_datas = judgeSchoolfileField($datas);
        if($judge_datas['code'] == 1){
            return $judge_datas;
        }
        if(!$request->hasFile('sch_file')){
            return responseTojson(1,'必须要上传PDF格式的校发文件');
        }
        $schoolfile_pdf   = $request->file('sch_file');//验证接收的文件
        $judge_schoolfile = judgeReceiveFiles($schoolfile_pdf);
        if($judge_schoolfile['code'] == 1){
            return $judge_schoolfile;
        }
        $disk                  = UploadSubjectionConfig::SCHOOL_FILE;
        $subjection_shoolfile  = UploadSubjectionConfig::SCHOOL_FILE_PDF;
        $add_schoolfile_road   = uploadFiles($subjection_shoolfile,$schoolfile_pdf,$disk);
        $datas['schfile_road'] = $add_schoolfile_road;
        $add_schoolfile        = SchoolfileDatabase::addSchoolfileDatas($datas);
        if($add_schoolfile){
            return responseTojson(0,'上传校发文件成功');
        }
        deletefiles($disk,$add_schoolfile_road);
        return responseTojson(1,'上传校发文件失败');
    }
    //删除校发文件
    public function deleteSchoolfile(Request $request){
        $validate = true;
        $schoolfile_id_datas  = $request->schoolfile_id_datas;
        $schoofile_road_datas = SchoolfileDatabase::selectAllSchoolfileRoad($schoolfile_id_datas);
        $delete_schoolfile    = SchoolfileDatabase::deleteAllSchoolfileDatas($schoolfile_id_datas);
        if($delete_schoolfile['code'] == 1){
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
        return responseTojson(1,$delete_schoolfile->message,$response);
    }
    //修改校发文件
    public function updateSchoolfile(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $schfile_road = trim($request->schfile_road);
        $datas = [
            'schfile_id'        => trim($request->schfile_id),
            'schfile_name'      => trim($request->schfile_name),
            'schfile_num'       => trim($request->schfile_num),
            'schfile_down_time' => trim($request->schfile_down_time),
            'schfile_road'      => $schfile_road
        ];
        $judge_datas = judgeSchoolfileField($datas);
        if($judge_datas['code']== 1){
            return $judge_datas;
        }
        $reset_file_status = false;
        if(!$request->hasFile('sch_file')){
            return SchoolfileDatabase::updateSchoolfileDatas($datas,$reset_file_status);
        }
        $reset_file_status = true;
        $shcoolfile_pdf       = $request->file('sch_file');
        $judge_schoolfile_pdf = judgeReceiveFiles($shcoolfile_pdf);
        if($judge_schoolfile_pdf['code'] == 1){
            return $judge_schoolfile_pdf;
        }
        $disk = UploadSubjectionConfig::SCHOOL_FILE;
        $subjection_shoolfile  = UploadSubjectionConfig::SCHOOL_FILE_PDF;
        $new_schoolfile_road = uploadFiles($subjection_shoolfile,$shcoolfile_pdf,$disk);
        $datas['schfile_road'] = $new_schoolfile_road;
        $update_schoolfile = SchoolfileDatabase::updateSchoolfileDatas($datas,$reset_file_status);
        if($update_schoolfile){
            deletefiles($disk,$schfile_road);
            return responseTojson(0,'修改校发文件成功');
        }
        deletefiles($disk,$new_schoolfile_road);
        return responseTojson(1,'修改校发文件失败');
    }
    //查看单个校发文件
    public function selectSchoolfile(Request $request){
        $result = SchoolfileDatabase::selectSchoolfileDatas($request->schfile_id);
        return responseTojson(0,'查询成功','',$result);
    }
    //查看所有校发文件
    public function selectAllSchoolfile(){
        $result = SchoolfileDatabase::selectAllSchoolfileDatas();
        return responseTojson(0,'查询成功','',$result);
    }
    //根据时间查看项目信息
    public function timeSelectSchoolfile(Request $request){
        $start_time = $request->start_time;
        $end_time   = $request->end_tiem;
        $table_name = SearchMessageConfig::SCHOOL_FILE_TABLE;
        $time_field = SearchMessageConfig::SCHFILE_DOWN_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
}