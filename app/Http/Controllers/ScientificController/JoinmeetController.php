<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use Illuminate\Http\Request;
use App\Model\ImageDatas;
use App\Model\JoinmeetDatas;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
class JoinmeetController  extends Controller
{
    //添加参加会议信息
    public function addJoinmeet(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $datas = [
            'teacher_id'   => session('usercount'),
            'join_people'  => trim($request->join_people),
            'jo_name'      => trim($request->jo_name),
            'jo_hold_unit' => trim($request->jo_hold_unit),
            'jo_take_unit' => trim($request->jo_take_unit),
            'jo_level'     => trim($request->jo_level),
            'jo_time'      => trim($request->jo_time),
            'jo_place'     => trim($request->jo_place),
            'jo_art_num'   => trim($request->jo_art_num),
            'jo_is_invite' => trim($request->jo_is_invite),
            'jo_title'     => trim($request->jo_title)
        ];
        $judge_datas = judgeJoinmeetField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        if(!$request->hasFile('joinmeet_inject')){
            $datas['jo_graph_inject'] = '';
            return JoinmeetDatas::addJoinmeetDatas($datas);
        }
        $joinmeet_inject = $request->file('joinmeet_inject');
        $judge_inject    = judgeFileImage($joinmeet_inject);
        if($judge_inject['code'] == 1){
            return responseTojson(1,$judge_inject['message']);
        }
        $disk                = UploadSubjectionConfig::JOIN_MEET;
        $subjection_joinmeet = UploadSubjectionConfig::JOIN_INJECTION;
        $new_inject_road     = uploadFiles($subjection_joinmeet,$judge_inject,$disk);
        $datas['jo_graph_inject'] = $new_inject_road;
        $add_joinmeet = JoinmeetDatas::addJoinmeetDatas($datas);
        if($add_joinmeet > 0){
            return responseTojson(0,'添加参加会议成功','',$add_joinmeet);
        }
        deletefiles($disk,$new_inject_road);
        return responseTojson(1,'添加参加会议信息失败');
    }
    //删除参加会议信息
    public function deleteJoinmeet(Request $request){
        $jo_id_datas     = $request->jo_id_datas;
        $old_inject_road = JoinmeetDatas::selectJoinmeetInjectRoad($jo_id_datas);
        $status          = UploadSubjectionConfig::JOIN_IMG_STATUS;
        $old_image_road  = ImageDatas::selectAllOwnerImage($jo_id_datas,$status);
        JoinmeetDatas::beginTraction();
        $delete_joinmeet = JoinmeetDatas::deleteJoinmeetDatas($jo_id_datas);
        $delete_image    = ImageDatas::byOwnerdeleteImagesDatas($jo_id_datas);
        if($delete_image && $delete_joinmeet){
            JoinmeetDatas::commit();
            $image_road      = array_merge($old_inject_road,$old_image_road);     //参加会议图片和图注合并
            deleteAllFiles(UploadSubjectionConfig::JOIN_MEET,$image_road);
            return responseTojson(0,'参加会议删除成功');
        }
        JoinmeetDatas::rollback();
    }
    //查看单个参加会议信息
    public function selectJoinmeet(Request $request){
        $jo_id          = $request->jo_id;
        $information    = JoinmeetDatas::selectJoinmeetDatas($jo_id);
        $image_status   = UploadSubjectionConfig::JOIN_IMG_STATUS;
        $joinmeet_image = ImageDatas::selectImageDatas($jo_id,$image_status);
        $datas['information'] = $information;
        $datas['image'] = $joinmeet_image;
        return responseTojson(0,'查询成功','',$datas);
    }
    //查看所有参加会议信息
    public function selectAllJoinmeet(){
        $result = JoinmeetDatas::selectAllJoinmeetDatas(session('usercount'));
        return responseTojson(0,'查询成功','',$result);
    }
    //根据时间区间搜索参加会议信息
    public function timeSelectJoinmeet(Request $request){
        $teacher_id = session('usercount');
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::JOIN_MEET_TABLE;
        $time_field = SearchMessageConfig::JO_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
    //修改参加会议信息
    public function updateJoinmeet(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'请求的方式不对');
        }
        $jo_id[0]          = trim($request->jo_id);
        $datas = [
            'jo_id'        => $jo_id[0],
            'join_people'  => trim($request->join_people),
            'jo_name'      => trim($request->jo_name),
            'jo_hold_unit' => trim($request->jo_hold_unit),
            'jo_take_unit' => trim($request->jo_take_unit),
            'jo_level'     => trim($request->jo_level),
            'jo_time'      => trim($request->jo_time),
            'jo_place'     => trim($request->jo_place),
            'jo_art_num'   => trim($request->jo_art_num),
            'jo_is_invite' => trim($request->jo_is_invite),
            'jo_title'     => trim($request->jo_title)
        ];
        $judge_datas = judgeJoinmeetField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        $reset_inject_status = false;
        if(!$request->hasFile('joinmeet_inject')){
            $datas['jo_graph_inject'] = trim($request->jo_graph_inject);
            return JoinmeetDatas::updateJoinmeetDatas($datas,$reset_inject_status);
        }
        $reset_inject_status = true;
        $update_inject = $request->file('joinmeet_inject');
        $judge_inject  = judgeFileImage($update_inject);
        if($judge_inject['code'] == 1){
            return responseTojson(1,$judge_inject['message']);
        }
        $disk                = UploadSubjectionConfig::JOIN_MEET;
        $subjection_joinmeet = UploadSubjectionConfig::JOIN_INJECTION;
        $old_inject_road     = JoinmeetDatas::selectJoinmeetInjectRoad($jo_id);
        $new_inject_road     = UploadFiles($subjection_joinmeet,$update_inject,$disk);
        $datas['jo_graph_inject'] = $new_inject_road;
        $reset_joinmeet =  JoinmeetDatas::updateJoinmeetDatas($datas,$reset_inject_status);
        if($reset_joinmeet){
            deletefiles($disk,$old_inject_road[0]);
            return responseTojson(0,'修改参加会议信息成功');
        }
        deletefiles($disk,$new_inject_road);
        return responseTojson(1,'修改参加会议信息失败');
    }
    //添加会议图片
    public function addJoinmeetImage(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        if(!$request->is_add_joinmeet){
            return responseTojson(1,'请你先添加参加会议信息');
        }
        if(!$request->hasFile('jo_image')){
            return responseTojson(1,'请你添加参加会议图片');
        }
        $join_images = $request->file('jo_image');
        $judge_images = judgeAllFileImage($join_images);
        if($judge_images['code'] == 1){
            return responseTojson(1,'上传图片失败');
        }
        $disk = UploadSubjectionConfig::JOIN_MEET;
        $success_images = $judge_images['success_images'];
        $subjection     = UploadSubjectionConfig::JOIN_IMG;
        $ho_id          = $request->ho_id;
        $all_image_road = uploadAllImgs($subjection,$success_images,$disk);
        $image_status   = UploadSubjectionConfig::JOIN_IMG_STATUS;
        return ImageDatas::addImagesDatas($all_image_road,$ho_id,$image_status);
    }
    //删除参加会议图片
    public function deleteJoinmeetImage(Request $request){
        $delete_im_id = $request->im_id_datas;
        //先去查询所有删除的图片路径
        $all_images_road = ImageDatas::selectAllImageRoadDatas($delete_im_id);
        ImageDatas::beginTraction();                                  //开启事务处理
        $delete_images = ImageDatas::deleteImagesDatas($delete_im_id);//删除数据库图片路径
        if($delete_images){
            ImageDatas::commit();
            deleteAllFiles(uploadSubjectionConfig::LECTURE,$all_images_road);
            return responseTojson(0,'删除讲学图片成功');
        }
        ImageDatas::rollback();
        return responseTojson(1,'删除讲学图片失败');
    }
}