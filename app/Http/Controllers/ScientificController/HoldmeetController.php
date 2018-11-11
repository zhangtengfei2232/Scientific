<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\HoldmeetDatas;
use App\Model\ModelDatabase;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
use Illuminate\Http\Request;
use App\Model\ImageDatas;
class HoldmeetController extends Controller
{
    //添加举行会议信息
    public function addHoldmeet(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $datas = [
            'teacher_id'      => session('usercount'),
            'ho_name'         => trim($request->ho_name),
            'ho_art_status'   => trim($request->ho_art_status),
            'people_num'      => trim($request->people_num),
            'ho_unit'         => trim($request->ho_unit),
            'undertake_unit'  => trim($request->undertake_unit),
            'ho_level'        => trim($request->ho_level),
            'ho_time'         => trim($request->ho_time)
        ];
        $judge_datas = judgeHoldmeetField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        if(!$request->hasFile('ho_graph_inject')){
            $datas['ho_graph_inject'] = '';
            return HoldmeetDatas::addHoldmeetDatas($datas);
        }
        $holdmeet_inject = $request->file('ho_graph_inject');
        $judge_inject   = judgeFileImage($holdmeet_inject);
        if($judge_inject['code'] == 1){
            return responseTojson(1,$judge_inject['message']);
        }
        $disk                     = UploadSubjectionConfig::HOLD_MEET;
        $subjection_holdmeet      = UploadSubjectionConfig::HOLD_INJECTION;
        $new_inject_road          = uploadFiles($subjection_holdmeet,$holdmeet_inject,$disk);
        $datas['ho_graph_inject'] = $new_inject_road;
        $add_holdmeet = HoldmeetDatas::addHoldmeetDatas($datas);
        if($add_holdmeet > 0){
            return responseTojson(0,'添加会议信息成功','',$add_holdmeet);
        }
        deletefiles($disk,$new_inject_road);
        return responseTojson(1,'添加会议信息失败');
    }
    //删除举行会议信息
    public function deleteHoldmeet(Request $request){
        dd($request);
        $ho_id_datas     = $request->ho_id_datas;
        $table_name          = SearchMessageConfig::HOLD_MEET_TABLE;
        $id_field            = SearchMessageConfig::HOLDMEET_ID;
        $old_inject_road = HoldmeetDatas::selectHoldmeetInjectRoad($ho_id_datas);
        $owner_status    = UploadSubjectionConfig::HOLD_IMG_STATUS;
        $old_image_road  = ImageDatas::selectAllOwnerImage($ho_id_datas,$owner_status);
        ModelDatabase::beginTraction();
        $delete_holdmeet = ModelDatabase::deleteAllDatas($table_name,$id_field,$ho_id_datas);
        $delete_image    = ImageDatas::byOwnerdeleteImagesDatas($ho_id_datas);
        if($delete_image && $delete_holdmeet){
            ModelDatabase::commit();
            $image_road  = array_merge($old_inject_road,$old_image_road);     //举行会议图片和图注合并
            deleteAllFiles(UploadSubjectionConfig::HOLD_IMG,$image_road);
        }
        ModelDatabase::rollback();
        return responseTojson(0,'举行会议删除成功');
    }
    //查看单个举行会议信息
    public function selectHoldmeet(Request $request){
        $ho_id                = $request->ho_id;
        $information          = HoldmeetDatas::selectHoldmetDatas($ho_id);
        $image_status         = UploadSubjectionConfig::HOLD_IMG_STATUS;
        $hold_images          = ImageDatas::selectImageDatas($ho_id,$image_status);
        $datas['information'] = $information;
        $datas['hold_images'] = $hold_images;
        return responseTojson(0,'查询成功','',$datas);
    }
    //查看所有会议信息
    public function selectAllHoldmeet(){
        $result = HoldmeetDatas::selectAllHoldmeetDatas(session('usercount'));
        return responseTojson(0,'查询成功','',$result);
    }
    //根据时间区间搜索举办会议信息
    public function timeSelectHoldmeet(Request $request){
        $teacher_id = session('usercount');
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::HOLD_MEET_TABLE;
        $time_field = SearchMessageConfig::HO_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
    //修改举行会议信息
    public function updateHoldmeet(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $ho_id[0]          = trim($request->ho_id);
        $datas = [
            'ho_id'           => $ho_id[0],
            'ho_name'         => trim($request->ho_name),
            'ho_art_status'   => trim($request->ho_art_status),
            'people_num'      => trim($request->people_num),
            'ho_unit'         => trim($request->ho_unit),
            'undertake_unit'  => trim($request->undertake_unit),
            'ho_level'        => trim($request->ho_level),
            'ho_time'         => trim($request->ho_time)
        ];
        $judge_datas = judgeHoldmeetField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        $reset_inject_status = false;
        if(!$request->hasFile('ho_graph_inject')){
            $datas['ho_graph_inject'] = trim($request->ho_graph_inject);
            return HoldmeetDatas::updateHoldmeetDatas($datas,$reset_inject_status);
        }
        $reset_inject_status = true;
        $update_inject = $request->file('ho_graph_inject');
        $judge_inject  = judgeFileImage($update_inject);
        if($judge_inject['code'] == 1){
            return responseTojson(1,$judge_inject['message']);
        }
        $old_inject_road          = HoldmeetDatas::selectHoldmeetInjectRoad($ho_id);
        $disk                     = UploadSubjectionConfig::HOLD_MEET;
        $subjection_holdmeet      = UploadSubjectionConfig::HOLD_INJECTION;
        $new_inject_road          = uploadFiles($subjection_holdmeet,$update_inject,$disk);
        $datas['ho_graph_inject'] = $new_inject_road;
        $reset_holdmeet           = HoldmeetDatas::updateHoldmeetDatas($datas,$reset_inject_status);
        if($reset_holdmeet){
            deletefiles($disk,$old_inject_road[0]);
            responseTojson(0,'修改会议信息成功');
        }
        deletefiles($disk,$new_inject_road);
        return responseTojson(1,'修改会议信息失败');
    }
    //添加举行会议图片
    public function addHoldmeetImages(Request $request){
        dd($request->file());
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        if($request->has('is_add_holdmeet')){
            if(!$request->is_add_holdmeet){
                return responseTojson(1,'请你先添加会议信息');
            }
        }
        if(!$request->hasFile('ho_file')){
            return responseTojson(1,'请你上传举行会议图片');
        }
        $holdmeet_images = $request->file('ho_file');              //接收数组形式的图片文件
        $judge_images    = judgeAllFileImage($holdmeet_images);
        if($judge_images['code'] == 1){
           return responseTojson(1,'图片上传失败');
        }
        $disk = UploadSubjectionConfig::HOLD_MEET;
        $success_image   = $judge_images['datas'];
        $subjection      = UploadSubjectionConfig::HOLD_IMG;
        $ho_id           = $request->ho_id;
        $all_images_road = uploadAllImgs($subjection,$success_image,$disk);
        $image_status    = UploadSubjectionConfig::HOLD_IMG_STATUS;
        return ImageDatas::addImagesDatas($all_images_road,$ho_id,$image_status);
    }
    //删除举行会议的图片
    public function deleteHoldImages(Request $request){
        $delete_im_id = $request->im_id_datas;
        //先去查询所有删除的图片路径
        $all_images_road = ImageDatas::selectAllImageRoadDatas($delete_im_id);
        ImageDatas::beginTraction();                                   //开启事务处理
        $delete_images = ImageDatas::deleteImagesDatas($delete_im_id); //删除数据库图片路径
        if($delete_images){
            ImageDatas::commit();
            deleteAllFiles(UploadSubjectionConfig::HOLD_MEET,$all_images_road);
            return responseTojson(0,'删除举办会议图片成功');
        }
        ImageDatas::rollback();                                        //回滚，回复数据库数据
        return responseTojson(1,'删除举办会议图片失败');
    }
}