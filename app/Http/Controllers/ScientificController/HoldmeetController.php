<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\HoldmeetDatas;
use config\uploadsubjectionconfig;
use Illuminate\Http\Request;
use App\Model\ImageDatas;
class HoldmeetController extends Controller
{
    //添加举行会议信息
    public function addHoldmeet(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $datas = [
            'teacher_id'      => session('usercount'),
            'ho_name'         => trim($request->ho_name),
            'ho_art_status'   => trim($request->ho_art_status),
            'people_num'      => trim($request->people_num),
            'ho_unit'         => trim($request->ho_unit),
            'undertake_unit'  => trim($request->undertake_unit),
            'ho_level'        => trim($request->ho_level),
            'ho_time'         => strtotime(trim($request->ho_time)),
            'ho_graph_inject' => trim($request->ho_graph_inject)
        ];
        $judge_datas = judgeHoldmeetField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        return HoldmeetDatas::addHoldmeetDatas($datas);
    }
    //添加会议图注
    public function addHoldmeetInjection(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        if(!$request->is_add_holdmeet){
            return showMsg(1,'请你先添加会议信息');
        }
        $holdmeet_inject = $request->file('holdmeet_inject');
        $judge_inject   = judgeFileImage($holdmeet_inject);
        if($judge_inject->code == 1){
            return $judge_inject;
        }
        $ho_id           = $request->ho_id;
        $new_inject_road = uploadFiles(uploadsubjectionconfig::HOLD_INJECTION,$holdmeet_inject);
        $add_inject      = HoldmeetDatas::updateHoldmeetInjectRoad($ho_id,$new_inject_road);
        if($add_inject){
            return showMsg(0,'添加会议图注成功');
        }
        deletefiles(uploadsubjectionconfig::HOLD_MEET,$new_inject_road);
        return showMsg(1,'添加会议图注失败');
    }
    //添加举行会议图片
    public function addHoldmeetImages(Request $request){
        $validate = true;
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        if(!$request->is_add_holdmeet){
            return showMsg(1,'请你先添加会议信息');
        }
        $holdmeet_images = $request->file('hold_images');    //接收数组形式的图片文件
        $judge_images    = judgeAllFileImage($holdmeet_images);
        if($judge_images->code == 1){
            $validate = false;
        }
        $success_image   = $judge_images['success_images'];
        $subjection      = uploadsubjectionconfig::HOLD_IMG;
        $ho_id           = $request->ho_id;
        $all_images_road = uploadAllImgs($subjection,$success_image);
        $image_status    = uploadsubjectionconfig::HOLD_IMG_STATUS;
        $add_images      = ImageDatas::addImagesDatas($all_images_road,$ho_id,$image_status);
        if($validate && $add_images->code == 0){
            return showMsg(0,'全部图片添加成功');
        }
        if($add_images->code == 1){
            $delete_fail_images = [];
            $fail_iamges = [];
            for($i = 0; $i < count($add_images); $i++){
                $index = $add_images->datas[$i];
                //获取添加失败的图片名字
                $fail_image_name = $success_image[$index]->getClientOriginalName();
                $fail_iamges[$i] = $fail_image_name;               //添加失败的图片名字数组
                //取出添加数据库失败的图片路径
                $delete_fail_images[$i] = $all_images_road[$index];//添加失败的图片路径数组
            }
            $disk = uploadsubjectionconfig::HOLD_MEET;
            deleteAllImgs($disk,$delete_fail_images);              //删除数据库添加失败的图片
            $response['fail_images'] = $fail_iamges;
        }
        if(!$validate){
            //有的图片验证也没通过，错误信息也返回
            $response['error_images'] = $judge_images['error_images'];
        }
        return showMsg(1,'部分图片添加失败',$response);
    }
    //删除举行会议的图片
    public function deleteHoldImages(Request $request){
        $delete_im_id = $request->ho_id_datas;
        //先去查询所有删除的图片路径
        $all_images_raod = ImageDatas::selectAllImageRoadDatas($delete_im_id);
        ImageDatas::beginTraction();                                   //开启事务处理
        $delete_images = ImageDatas::deleteImagesDatas($delete_im_id); //删除数据库图片路径
        if($delete_images){
            ImageDatas::commit();
            deleteAllImgs(uploadsubjectionconfig::HOLD_MEET,$all_images_raod);
            return showMsg(0,'删除举办会议图片成功');
        }
        ImageDatas::rollback();                                        //回滚，回复数据库数据
        return showMsg(1,'删除举办会议图片失败');
    }
    //删除举行会议信息
    public function deleteHoldmeet(Request $request){


    }
    //查看单个举行会议信息
    public function selectHoldmeet(Request $request){
        $ho_id                = $request->ho_id;
        $holdmeet_information = HoldmeetDatas::selectHoldmetDatas($ho_id);
        $owner_status         = uploadsubjectionconfig::HOLD_IMG_STATUS;
        $hold_images          = ImageDatas::selectAllOwnerImage($ho_id,$owner_status);
        $datas['holdmeet_information'] = $holdmeet_information;
        $datas['hold_images']          = $hold_images;
        return showMsg(0,'查询成功',$datas);
    }
    //查看所有会议信息
    public function selectAllHoldmeet(){
        $result = HoldmeetDatas::selectAllHoldmeetDatas(session('usercount'));
        return showMsg(0,'查询成功',$result);
    }
    //修改举行会议信息
    public function updateHoldmeet(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $datas = [
            'ho_id'           => trim($request->ho_id),
            'ho_name'         => trim($request->ho_name),
            'ho_art_status'   => trim($request->ho_art_status),
            'people_num'      => trim($request->people_num),
            'ho_unit'         => trim($request->ho_unit),
            'undertake_unit'  => trim($request->undertake_unit),
            'ho_level'        => trim($request->ho_level),
            'ho_time'         => strtotime(trim($request->ho_time)),
            'ho_graph_inject' => trim($request->ho_graph_inject)
        ];
        $judge_datas = judgeHoldmeetField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        return HoldmeetDatas::updateHoldmeetDatas($datas);
    }
    //修改会议图注
    public function updateHoldmeetInject(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $update_inject = $request->file('holdmeet_inject');
        $judge_inject  = judgeFileImage($update_inject);
        if($judge_inject->code == 1){
            return $judge_inject;
        }
        $ho_id             = $request->ho_id;
        $old_inject_road   = HoldmeetDatas::selectHoldmeetInjectRoad($ho_id);
        $disk              = uploadsubjectionconfig::HOLD_MEET;
        $new_inject_road   = uploadFiles(uploadsubjectionconfig::HOLD_INJECTION,$update_inject);
        $reset_inject_road = HoldmeetDatas::updateHoldmeetInjectRoad($ho_id,$new_inject_road);
        if($reset_inject_road){
            deletefiles($disk,$old_inject_road);
            return showMsg(0,'修改会议图注成功');
        }
        deletefiles($disk,$new_inject_road);
        return showMsg(1,'修改会议图注失败');
    }
}