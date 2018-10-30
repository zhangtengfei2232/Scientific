<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\HoldmeetDatas;
use config\UploadSubjectionConfig;
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
            'ho_time'         => trim($request->ho_time),
            'ho_graph_inject' => trim($request->ho_graph_inject)
        ];
        $judge_datas = judgeHoldmeetField($datas);
        if($judge_datas['code'] == 1){
            return $judge_datas;
        }
        if(!$request->hasFile('ho_file')){
            $datas['ho_graph_inject'] = '';
            return HoldmeetDatas::addHoldmeetDatas($datas);
        }
        $holdmeet_inject = $request->file('holdmeet_inject');
        $judge_inject   = judgeFileImage($holdmeet_inject);
        if($judge_inject['code'] == 1){
            return $judge_inject;
        }
        $disk                = UploadSubjectionConfig::HOLD_MEET;
        $subjection_holdmeet = UploadSubjectionConfig::HOLD_INJECTION;
        $new_inject_road     = uploadFiles($subjection_holdmeet,$holdmeet_inject,$disk);
        $add_holdmeet = HoldmeetDatas::addHoldmeetDatas($datas);
        if($add_holdmeet){
            return responseTojson(0,'添加会议信息成功','',$add_holdmeet['datas']);
        }
        deletefiles($disk,$new_inject_road);
        return responseTojson(1,'添加会议信息失败');
    }
    //删除举行会议信息
    public function deleteHoldmeet(Request $request){
        $ho_id_datas     = $request->ho_id_datas;
        $old_inject_road = HoldmeetDatas::selectHoldmeetInjectRoad($ho_id_datas);
        $owner_status          = UploadSubjectionConfig::HOLD_IMG_STATUS;
        $old_image_road  = ImageDatas::selectAllOwnerImage($ho_id_datas,$owner_status);
        $delete_holdmeet = HoldmeetDatas::deleteHoldmeetDatas($ho_id_datas);
        $image_road      = array_merge($old_inject_road,$old_image_road);//举行会议图片和图注合并
        deleteAllFiles(UploadSubjectionConfig::HOLD_IMG,$image_road);
        responseTojson(0,'举行会议删除成功');
    }
    //查看单个举行会议信息
    public function selectHoldmeet(Request $request){
        $ho_id[0]             = $request->ho_id;
        $information          = HoldmeetDatas::selectHoldmetDatas($ho_id[0]);
        $owner_status         = uploadSubjectionConfig::HOLD_IMG_STATUS;
        $hold_images          = ImageDatas::selectAllOwnerImage($ho_id,$owner_status);
        $datas['information'] = $information;
        $datas['hold_images'] = $hold_images;
        return responseTojson(0,'查询成功','',$datas);
    }
    //查看所有会议信息
    public function selectAllHoldmeet(){
        $result = HoldmeetDatas::selectAllHoldmeetDatas(session('usercount'));
        return responseTojson(0,'查询成功','',$result);
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
            return $judge_datas;
        }
        if(!$request->hasFile('holdmeet_inject')){
            return HoldmeetDatas::updateHoldmeetDatas($datas);
        }
        $update_inject = $request->file('holdmeet_inject');
        $judge_inject  = judgeFileImage($update_inject);
        if($judge_inject['code'] == 1){
            return $judge_inject;
        }
        $disk              = uploadSubjectionConfig::HOLD_MEET;
        $old_inject_road   = HoldmeetDatas::selectHoldmeetInjectRoad($ho_id);
        $new_inject_road   = uploadFiles(uploadSubjectionConfig::HOLD_INJECTION,$update_inject,$disk);
        $datas['ho_graph_inject'] = $new_inject_road;
        $reset_holdmeet    = HoldmeetDatas::updateHoldmeetDatas($datas);
        if($reset_holdmeet){
            deletefiles($disk,$old_inject_road[0]);
            responseTojson(0,'修改会议信息成功');
        }
        deletefiles($disk,$new_inject_road);
        return responseTojson(1,'修改会议信息失败');
    }
    //添加举行会议图片
    public function addHoldmeetImages(Request $request){
        $validate = true;
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        if(!$request->is_add_holdmeet){
            return responseTojson(1,'请你先添加会议信息');
        }
        $holdmeet_images = $request->file('hold_images');    //接收数组形式的图片文件
        $judge_images    = judgeAllFileImage($holdmeet_images);
        if($judge_images['code'] == 1){
            $validate = false;
        }
        $disk = UploadSubjectionConfig::HOLD_MEET;
        $success_image   = $judge_images['success_images'];
        $subjection      = UploadSubjectionConfig::HOLD_IMG;
        $ho_id           = $request->ho_id;
        $all_images_road = uploadAllImgs($subjection,$success_image,$disk);
        $image_status    = UploadSubjectionConfig::HOLD_IMG_STATUS;
        $add_images      = ImageDatas::addImagesDatas($all_images_road,$ho_id,$image_status);
        if($validate && $add_images['code'] == 0){
            return responseTojson(0,'全部图片添加成功');
        }
        if($add_images->code == 1){
            $delete_fail_images = [];
            $fail_images = [];
            for($i = 0; $i < count($add_images); $i++){
                $index = $add_images->datas[$i];
                //获取添加失败的图片名字
                $fail_image_name = $success_image[$index]->getClientOriginalName();
                $fail_images[$i] = $fail_image_name;               //添加失败的图片名字数组
                //取出添加数据库失败的图片路径
                $delete_fail_images[$i] = $all_images_road[$index];//添加失败的图片路径数组
            }
            deleteAllFiles($disk,$delete_fail_images);              //删除数据库添加失败的图片
            $response['fail_images'] = $fail_images;
        }
        if(!$validate){
            //有的图片验证也没通过，错误信息也返回
            $response['error_images'] = $judge_images['error_images'];
        }
        return responseTojson(1,'部分图片添加失败',$response);
    }
    //删除举行会议的图片
    public function deleteHoldImages(Request $request){
        $delete_im_id = $request->ho_id_datas;
        //先去查询所有删除的图片路径
        $all_images_road = ImageDatas::selectAllImageRoadDatas($delete_im_id);
        ImageDatas::beginTraction();                                   //开启事务处理
        $delete_images = ImageDatas::deleteImagesDatas($delete_im_id); //删除数据库图片路径
        if($delete_images){
            ImageDatas::commit();
            deleteAllFiles(uploadSubjectionConfig::HOLD_MEET,$all_images_road);
            return responseTojson(0,'删除举办会议图片成功');
        }
        ImageDatas::rollback();                                        //回滚，回复数据库数据
        return responseTojson(1,'删除举办会议图片失败');
    }
}