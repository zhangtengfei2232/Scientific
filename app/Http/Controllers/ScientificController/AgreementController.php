<?php
namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use App\Model\AgreementDatabase;
use config\uploadsubjectionconfig;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    //添加教学科研合作协议信息
    public function addAgreement(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $agreement_pdf = $request->file('agreement_pdf');
        $judge_agreement = judgeReceiveFiles($agreement_pdf);
        if($judge_agreement->code == 1){
            return $judge_agreement;
        }
        $datas = [
            'agree_name'           => trim($request->agree_name),
            'agree_cooperate_unit' => trim($request->agree_cooperate_unit),
            'agree_time'           => strtotime(trim($request->agree_time)),
        ];
        $judge_datas = judgeAgreementField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        $add_agreement_raod  = uploadFiles(uploadsubjectionconfig::AGREEMENT_PDF,$agreement_pdf);
        $datas['agree_road'] = $add_agreement_raod;
        $add_agreement = AgreementDatabase::addAgreementDatas($datas);
        if($add_agreement){
            return showMsg(0,'添加教学科研合作协议成功');
        }
        deletefiles(uploadsubjectionconfig::AGREEMENT,$add_agreement_raod);
        return showMsg(1,'添加教学科研合作协议失败');
    }
    //删除单个教学科研合作协议信息
    public function deleteAgreement(Request $request){
        $agreement_id     = $request->agreement_id;
        $agreement_road   = AgreementDatabase::selectAgreementRoad($agreement_id);
        $delete_agreement = AgreementDatabase::deleteAgreementDatas($agreement_id);
        if($delete_agreement){
            deletefiles(uploadsubjectionconfig::AGREEMENT,$agreement_road);
            return showMsg(0,'删除教学科研合作协议信息成功');
        }
        return showMsg(1,'删除教学科研合作协议信息失败');
    }
    //删除多个教学科研合作协议信息
    public function deleteAllAgreement(Request $request){
        $validate = true;
        $agreement_id_datas   = $request->agreement_id_datas;
        $agreement_raod_datas = AgreementDatabase::selectAllAgreementRoad($agreement_id_datas);
        $delete_agreement     = AgreementDatabase::deleteAllAgreementDatas($agreement_id_datas);
        if($delete_agreement->code == 1){
            $validate = false;
            //有些教学科研合作协议删除失败，去查文件的原来名称
            $agreement_name = AgreementDatabase::selectAgreementName($delete_agreement);
            //根据文件'ID'键，去除掉删除失败的教学科研合作协议路径
            for($i = 0; $i < count($delete_agreement); $i++){
                array_slice($agreement_raod_datas,$delete_agreement[$i],1);
            }
            $response['fail_agreement'] = $agreement_name;
        }
        deleteAllFiles(uploadsubjectionconfig::AGREEMENT,$agreement_raod_datas);
        if($validate){
            return $delete_agreement;
        }
        return showMsg(1,$delete_agreement->message,$agreement_name);
    }
    //修改教学科研合作协议信息
    public function updateAgreement(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $agree_id = trim($request->agree_id);
        $datas = [
            'agree_id'             => $agree_id,
            'agree_name'           => trim($request->agree_name),
            'agree_cooperate_unit' => trim($request->agree_cooperate_unit),
            'agree_time'           => strtotime(trim($request->agree_time))
        ];
        $judge_datas = judgeAgreementField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        $agreement_pdf       = $request->file('agreement_pdf');
        $judge_agreement_pdf = judgeReceiveFiles($agreement_pdf);
        if($judge_agreement_pdf->code == 1){
            return $judge_agreement_pdf;
        }
        $old_agreement_road  = AgreementDatabase::selectAgreementRoad($agree_id);
        $new_agreement_road  = uploadFiles(uploadsubjectionconfig::AGREEMENT_PDF,$agreement_pdf);
        $datas['agree_road'] = $new_agreement_road;
        $disk = uploadsubjectionconfig::AGREEMENT;
        $update_agreement    = AgreementDatabase::updateAgreementDatas($datas);
        if($update_agreement){
            deletefiles($disk,$old_agreement_road);
            return showMsg(0,'修改教学合作协议成功');
        }
        deletefiles($disk,$new_agreement_road);
        return showMsg(1,'修改教学合作协议失败');
    }
    //查看单个教学科研合作协议信息
    public function selectAgreement(Request $request){
        $result = AgreementDatabase::selectAgreementDatas($request->agreement_id) ;
        return showMsg(0,'查询成功',$result);
    }
    //查看全部教学科研合作协议信息
    public function selectAllAgreement(){
        $result = AgreementDatabase::selectAllAgreementDatas();
        return showMsg(0,'查询成功',$result);
    }


}