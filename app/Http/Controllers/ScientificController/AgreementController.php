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
        $agreement_pdf = $request->file('agreement_pdf');
        $judge_agreement = judgeReceiveFiles($agreement_pdf);
        if($judge_agreement['code'] == 1){
            return responseTojson(1,$judge_agreement['message']);
        }
        $datas = [
            'agree_name'           => trim($request->agree_name),
            'agree_cooperate_unit' => trim($request->agree_cooperate_unit),
            'agree_time'           => trim($request->agree_time),
        ];
        $judge_datas = judgeAgreementField($datas);
        if($judge_datas['code'] == 1){
            return $judge_datas;
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
        $validate = true;
        $agreement_id_datas   = $request->agreement_id_datas;
        $agreement_raod_datas = AgreementDatabase::selectAllAgreementRoad($agreement_id_datas);
        $delete_agreement     = AgreementDatabase::deleteAllAgreementDatas($agreement_id_datas);
        if($delete_agreement['code']== 1){
            $validate = false;
            //有些教学科研合作协议删除失败，去查文件的原来名称
            $agreement_name = AgreementDatabase::selectAgreementName($delete_agreement);
            //根据文件'ID'键，去除掉删除失败的教学科研合作协议路径
            for($i = 0; $i < count($delete_agreement); $i++){
                array_slice($agreement_raod_datas,$delete_agreement[$i],1);
            }
            $response['fail_agreement'] = $agreement_name;
        }
        deleteAllFiles(uploadSubjectionConfig::AGREEMENT,$agreement_raod_datas);
        if($validate){
            return $delete_agreement;
        }
        return responseTojson(1,$delete_agreement->message,$agreement_name);
    }
    //修改教学科研合作协议信息
    public function updateAgreement(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $agree_id = trim($request->agree_id);
        $datas = [
            'agree_id'             => $agree_id,
            'agree_name'           => trim($request->agree_name),
            'agree_cooperate_unit' => trim($request->agree_cooperate_unit),
            'agree_time'           => trim($request->agree_time)
        ];
        $judge_datas = judgeAgreementField($datas);
        if($judge_datas['code'] == 1){
            return $judge_datas;
        }
        $agreement_pdf       = $request->file('agreement_pdf');
        $judge_agreement_pdf = judgeReceiveFiles($agreement_pdf);
        if($judge_agreement_pdf['code'] == 1){
            return $judge_agreement_pdf;
        }
        $old_agreement_road  = AgreementDatabase::selectAgreementRoad($agree_id);
        $new_agreement_road  = uploadFiles(uploadSubjectionConfig::AGREEMENT_PDF,$agreement_pdf);
        $datas['agree_road'] = $new_agreement_road;
        $disk = uploadSubjectionConfig::AGREEMENT;
        $update_agreement    = AgreementDatabase::updateAgreementDatas($datas);
        if($update_agreement){
            deletefiles($disk,$old_agreement_road);
            return responseTojson(0,'修改教学合作协议成功');
        }
        deletefiles($disk,$new_agreement_road);
        return responseTojson(1,'修改教学合作协议失败');
    }
    //查看单个教学科研合作协议信息
    public function selectAgreement(Request $request){
        $result = AgreementDatabase::selectAgreementDatas($request->agreement_id) ;
        return responseTojson(0,'查询成功','',$result);
    }
    //查看全部教学科研合作协议信息
    public function selectAllAgreement(){
        $result = AgreementDatabase::selectAllAgreementDatas();
        return responseTojson(0,'查询成功','',$result);
    }
    //根据时间区间搜索教学科研合作协议信息
    public function timeSelectAgreemet(Request $request){
        $start_time = $request->strat_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::AGREEMENT_TABLE;
        $time_field = SearchMessageConfig::AGREE_TIME;
        return  ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field);
    }
}