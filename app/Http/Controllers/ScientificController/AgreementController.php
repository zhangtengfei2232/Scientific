<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\AgreementDatabase;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
use Illuminate\Http\Request;
use App\Model\ModelDatabase;
class AgreementController extends Controller
{
    //添加教学科研合作协议信息
    public function addAgreement(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $datas = [
            'agree_name'           => trim($request->agree_name),
            'agree_cooperate_unit' => trim($request->agree_cooperate_unit),
            'agree_time'           => trim($request->agree_time),
        ];
        $judge_datas = judgeAgreementField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        if(!$request->hasFile('agree_road')){
            return responseTojson(1,'必须要上传PDF格式的合作协议文件');
        }
        $agreement_pdf = $request->file('agree_road');
        $judge_agreement = judgeReceiveFiles($agreement_pdf);
        if($judge_agreement['code'] == 1){
            return responseTojson(1,$judge_agreement['message']);
        }
        $disk = UploadSubjectionConfig::APPRAISAL;
        $subjection_appraisal = UploadSubjectionConfig::AGREEMENT_PDF;
        $add_agreement_raod   = uploadFiles($subjection_appraisal,$agreement_pdf,$disk);
        $datas['agree_road']  = $add_agreement_raod;
        $add_agreement        = AgreementDatabase::addAgreementDatas($datas);
        if($add_agreement){
            return responseTojson(0,'添加教学科研合作协议成功');
        }
        deletefiles($disk,$add_agreement_raod);
        return responseTojson(1,'添加教学科研合作协议失败');
    }
    //删除教学科研合作协议信息
    public function deleteAgreement(Request $request){
        $agreement_id_datas   = $request->ag_id_datas;
        $agreement_raod_datas = AgreementDatabase::selectAgreementRoad($agreement_id_datas);
        $delete_agreement     = AgreementDatabase::deleteAgreementDatas($agreement_id_datas);
        deleteAllFiles(uploadSubjectionConfig::AGREEMENT,$agreement_raod_datas);
        return responseTojson(1,'删除成功');
    }
    //修改教学科研合作协议信息
    public function updateAgreement(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $agree_road = trim($request->agree_road);
        $datas = [
            'agree_id'             => trim($request->agree_id),
            'agree_name'           => trim($request->agree_name),
            'agree_cooperate_unit' => trim($request->agree_cooperate_unit),
            'agree_time'           => trim($request->agree_time),
            'agree_road'           => $agree_road
        ];
        dd($datas);
        $judge_datas = judgeAgreementField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        $reset_file_status = false;
        if(!$request->hasFile('agree_road')){
            return AgreementDatabase::updateAgreementDatas($datas,$reset_file_status);
        }
        $reset_file_status = true;
        $agreement_pdf       = $request->file('agree_road');
        $judge_agreement_pdf = judgeReceiveFiles($agreement_pdf);
        if($judge_agreement_pdf['code'] == 1){
            return responseTojson(1,$judge_agreement_pdf['message']);
        }
        $disk = uploadSubjectionConfig::AGREEMENT;
        $new_agreement_road  = uploadFiles(uploadSubjectionConfig::AGREEMENT_PDF,$agreement_pdf,$disk);
        $datas['agree_road'] = $new_agreement_road;
        $update_agreement    = AgreementDatabase::updateAgreementDatas($datas,$reset_file_status);
        if($update_agreement){
            deletefiles($disk,$agree_road);
            return responseTojson(0,'修改教学合作协议成功');
        }
        deletefiles($disk,$new_agreement_road);
        return responseTojson(1,'修改教学合作协议失败');
    }
    //查看单个教学科研合作协议信息
    public function selectAgreement(Request $request){
        $result = AgreementDatabase::selectAgreementDatas($request->agree_id) ;
        return responseTojson(0,'查询成功','',$result);
    }
    //查看全部教学科研合作协议信息
    public function selectAllAgreement(){
        $result = AgreementDatabase::selectAllAgreementDatas();
        return responseTojson(0,'查询成功','',$result);
    }
    //根据时间区间搜索教学科研合作协议信息
    public function timeSelectAgreemet(Request $request){
        $teacher_id = session('usercount');
        $start_time = $request->strat_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::AGREEMENT_TABLE;
        $time_field = SearchMessageConfig::AGREE_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
}