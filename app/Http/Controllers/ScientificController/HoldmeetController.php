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
        $holdmeet_inject = $request->file('holdmeet_inject');
        $judge_in   = judgeFileImage($holdmeet_inject);
        if($judge_in->code == 1){
            return $judge_in;
        }
        if(!$request->is_add_holdmeet){
            return showMsg(1,'请你先添加会议信息');
        }
        $ho_id           = $request->ho_id;
        $new_inject_road = uploadFiles(uploadsubjectionconfig::HOLD_INJECTION,$holdmeet_inject);
        $add_inject      = HoldmeetDatas::updateHoldmeetImageDatas($ho_id,$new_inject_road);
        if($add_inject){
            return showMsg(0,'添加会议图注成功');
        }
        deletefiles(uploadsubjectionconfig::HOLD_MEET,$new_inject_road);
        return showMsg(1,'添加会议图注失败');
    }
    //添加举行会议图片
    public function addHoldmeetImage(Request $request){
        $validate = true;
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $holdmeet_images = $request->file('hold_images');    //接收数组形式的图片文件
        $judge_images    = judgeAllFileImage($holdmeet_images);
        if($judge_images->code == 1){
            $validate = false;
        }
        $success_image   = $judge_images['success_images'];
        $subjection      = uploadsubjectionconfig::HOLD_IMG;
        $all_images_road = uploadAllImgs($subjection,$success_image);
        $add_images      = ImageDatas::addImagesDatas($all_images_road);
        if($validate && $add_images->code == 0){
            return showMsg(0,'全部图片添加成功');
        }
        if($add_images->code == 1){
            $delete_fail_images = [];
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


    }
    //删除举行会议信息
    public function deleteHoldmeet(Request $request){


    }
    //查看单个举行会议信息
    public function selectHoldmeet(Request $request){


    }
    //查看所有会议信息
    public function selectAllHoldmeet(){

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
    public function updateHoldmeetImage(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $update_image = $request->file('holdmeet_inject');
        $judge_iamge  = judgeFileImage($update_image);
        if($judge_iamge->code == 1){
            return $judge_iamge;
        }
        $disk           = uploadsubjectionconfig::HOLD_MEET;
        $ho_id          = $request->ho_id;
        $old_image_road = HoldmeetDatas::selectHoldmeetInjectRoad($ho_id);
        $new_image_road = uploadFiles(uploadsubjectionconfig::HOLD_INJECTION,$update_image);
        $reset_image    = HoldmeetDatas::updateHoldmeetImageDatas($ho_id,$new_image_road);
        if($reset_image){
            deletefiles($disk,$old_image_road);
            return showMsg(0,'修改会议图注成功');
        }
        deletefiles($disk,$new_image_road);
        return showMsg(1,'修改会议图注失败');
    }
}