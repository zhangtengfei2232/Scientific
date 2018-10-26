<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ImageDatas;
use App\Model\JoinmeetDatas;
use config\UploadSubjectionConfig;
class JoinmeetController  extends Controller
{
    //添加参加会议信息
    public function addJoinmeet(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $datas = [
            'teacher_id'   => session('usercount'),
            'join_people'  => trim($request->join_people),
            'jo_name'      => trim($request->join_name),
            'jo_hold_unit' => trim($request->jo_hold_unit),
            'jo_take_unit' => trim($request->jo_take_unit),
            'jo_level'     => trim($request->join_level),
            'jo_time'      => strtotime(trim($request->jo_time)),
            'jo_place'     => trim($request->jo_place),
            'jo_art_num'   => trim($request->jo_art_num),
            'jo_is_invite' => trim($request->jo_is_invite),
            'jo_title'     => trim($request->jo_title)
        ];
        $judge_datas = judgeJoinmeetField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        return JoinmeetDatas::addJoinmeetDatas($datas);
    }
    //添加参加会议图注信息
    public function addJoinmeetInject(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        if(!$request->is_add_joinmeet){
            return showMsg(1,'请你添加参加会议信息');
        }
        $joinmeet_inject = $request->file('joinmeet_inject');
        $judge_inject    = judgeFileImage($joinmeet_inject);
        if($judge_inject->code == 1){
            return $judge_inject;
        }
        $disk                = UploadSubjectionConfig::JOIN_MEET;
        $subjection_joinmeet = UploadSubjectionConfig::JOIN_INJECTION;
        $jo_id = $request->jo_id;
        $new_inject_road     = uploadFiles($subjection_joinmeet,$judge_inject,$disk);
        $add_inject          = JoinmeetDatas::updateJoinmeetInjectRoad($jo_id,$new_inject_road);
        if($add_inject){
            return showMsg(0,'添加参加会议图注成功');
        }
        deletefiles($disk,$new_inject_road);
        return showMsg(1,'添加会议图注失败');
    }
    //添加会议图片
    public function addJoinmeetImage(Request $request){
        $validate = true;
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        if(!$request->is_add_joinmeet){
            return showMsg(1,'请你先添加参加会议信息');
        }
        $join_images = $request->file('joinmeet_images');
        $judge_images = judgeAllFileImage($join_images);
        if($judge_images->code == 1){
            $validate = false;
        }
        $disk = UploadSubjectionConfig::JOIN_MEET;
        $success_images = $judge_images['success_images'];
        $subjection     = UploadSubjectionConfig::JOIN_IMG;
        $ho_id          = $request->ho_id;
        $all_image_road = uploadAllImgs($subjection,$success_images,$disk);
        $image_status   = UploadSubjectionConfig::JOIN_IMG_STATUS;
        $add_images     = ImageDatas::addImagesDatas($all_image_road,$ho_id,$image_status);
        if($validate && $add_images->code == 0){
            return showMsg(0,'全部图片添加成功');
        }
        if($add_images->code == 1){
            $delete_fail_images = [];
            $fail_images = [];
            for($i = 0; $i < count($add_images); $i++){
                $index = $add_images->datas[$i];
                //获取添加失败的图片的名字
                $fail_image_name = $success_images[$index]->getClientOriginalName();
                $fail_images[$i] = $fail_image_name;
                //取出添加数据库失败的图片路径
                $delete_fail_images[$i] = $all_image_road[$index];//添加失败的图片路径数组
            }
            deleteAllImgs($disk,$delete_fail_images);
            $response['fail_images'] = $fail_images;
        }
        if(!$validate){
            //有的图片验证也没通过，错误信息也返回
            $response['error_images'] = $judge_images['error_images'];
        }
        return showMsg(1,'部分图片添加失败',$response);
    }
    //删除参加会议信息
    public function deleteJoinmeet(){

    }
    //删除多个参加会议信息
    public function deleteAllJoinmeet(){

    }
    //删除参加会议图片
    public function deleteJoinmeetImage(Request $request){
        $delete_jo_id = $request->le_id_datas;
        //先去查询所有删除的图片路径
        $all_images_road = ImageDatas::selectAllImageRoadDatas($delete_jo_id);
        ImageDatas::beginTraction();                                  //开启事务处理
        $delete_images = ImageDatas::deleteImagesDatas($delete_jo_id);//删除数据库图片路径
        if($delete_images){
            ImageDatas::commit();
            deleteAllImgs(uploadSubjectionConfig::LECTURE,$all_images_road);
            return showMsg(0,'删除讲学图片成功');
        }
        ImageDatas::rollback();
        return showMsg(1,'删除讲学图片失败');
    }
    //查看单个参加会议信息
    public function selectJoinmeet(Request $request){
        $result = JoinmeetDatas::selectJoinmeetDatas($request->jo_id);
        return showMsg(0,'查询成功',$result);
    }
    //查看所有参加会议信息
    public function selectAllJoinmeet(){
        $result = JoinmeetDatas::selectAllJoinmeetDatas(session('usercount'));
        return showMsg(0,'查询成功',$result);
    }
    //修改参加会议信息
    public function updateJoinmeet(Request $request){
       if(!$request->isMethod('POST')){
           return showMsg(1,'请求的方式不对');
       }
       $datas = [
           'jo_id'        => trim($request->jo_id),
           'join_people'  => trim($request->join_people),
           'jo_name'      => trim($request->join_name),
           'jo_hold_unit' => trim($request->jo_hold_unit),
           'jo_take_unit' => trim($request->jo_take_unit),
           'jo_level'     => trim($request->join_level),
           'jo_time'      => strtotime(trim($request->jo_time)),
           'jo_place'     => trim($request->jo_place),
           'jo_art_num'   => trim($request->jo_art_num),
           'jo_is_invite' => trim($request->jo_is_invite),
           'jo_title'     => trim($request->jo_title)
       ];
       $judge_datas = judgeJoinmeetField($datas);
       if($judge_datas->code == 1){
           return $judge_datas;
       }
       return JoinmeetDatas::updateJoinmeetDatas($datas);
    }
    //修改会议图注信息
    public function updateJoinmeetinject(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $update_inject = $request->file('joinmeet_inject');
        $judge_inject  = judgeFileImage($update_inject);
        if($judge_inject->code == 1){
            return $judge_inject;
        }
        $disk                = UploadSubjectionConfig::JOIN_MEET;
        $subjection_joinmeet = UploadSubjectionConfig::JOIN_INJECTION;
        $jo_id               = $request->jo_id;
        $old_inject_road     = JoinmeetDatas::selectJoinmeetInjectRoad($jo_id);
        $new_inject_road     = UploadFiles($subjection_joinmeet,$update_inject,$disk);
        $reset_inject_raod   = JoinmeetDatas::updateJoinmeetInjectRoad($jo_id,$new_inject_road);
        if($reset_inject_raod){
            deletefiles($disk,$old_inject_road);
            return showMsg(0,'修改参加会议图注成功');
        }
        deletefiles($disk,$new_inject_road);
        return showMsg(1,'修改参加会议图注失败');
    }
}