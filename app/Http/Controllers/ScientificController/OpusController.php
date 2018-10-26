<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OpusDatabase;
use config\UploadSubjectionConfig;
class OpusController  extends Controller
{
    //添加著作信息
    public function addOpus(Request $request)
    {
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $datas = [
            'teacher_id'       => session('usercount'),
            'op_first_author'  => trim($request->op_first_author),
            'op_all_author'    => trim($request->op_all_author),
            'op_name'          => trim($request->op_name),
            'op_form_write'    => trim($request->op_form_write),
            'op_publish'       => trim($request->op_publish),
            'op_publish_time'  => strtotime(trim($request->op_publish_time)),
            'op_number'        => trim($request->op_number),
            'op_total_words'   => trim($request->op_total_words),
            'op_self_words'    => trim($request->op_self_words),
            'op_cate_work'     => trim($request->op_cate_works),
            'op_integral'      => trim($request->op_integral),
            'op_cate_research' => trim($request->op_cate_research),
            'op_sub_category'  => trim($request->op_sub_category),
            'op_remarks'       => trim($request->op_remarks)
        ];
        $judge_datas = judgeOpusField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        return OpusDatabase::addOpusDatas($datas);
    }
    //添加著作封面和版权图片
    public function addOpusImage(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg('1','你请求的方式不对');
        }
        if(!$request->is_add_opus){
            return showMsg(1,'请你先添加著作信息');
        }
        $add_image_status = $request->add_image_status;
        if($add_image_status == 1){
            $opus_image = $request->file('op_cover_image');
            $subjection = UploadSubjectionConfig::OPUS_COVER_IMG;
        }else{
            $opus_image = $request->file('op_coright_image');
            $subjection = UploadSubjectionConfig::COPYRIGHT_IMG;
        }
        $judge_opu_iamge  = judgeFileImage($opus_image);
        if($judge_opu_iamge->code == 1){
            return $judge_opu_iamge;
        }
        if($add_image_status == 1){
            $subjection   = UploadSubjectionConfig::OPUS_COVER_IMG;
        }elseif ($add_image_status == 2){
            $subjection   = UploadSubjectionConfig::COPYRIGHT_IMG;
        }
        $op_id       = $request->op_id;
        $disk        = UploadSubjectionConfig::OPUS;
        $new_image_road = uploadFiles($subjection,$opus_image,$disk);
        $add_image      = OpusDatabase::updateImageDatas($new_image_road,$add_image_status,$op_id);
        if($add_image){
            return showMsg(0,'上传图片成功');
        }
        deletefiles($disk,$new_image_road);
        return showMsg(1,'上传图片失败');
    }
    //删除单个著作信息
    public function deleteOpus(Request $request)
    {

    }
    //删除多个著作信息
    public function deleteAllOpus(){

    }
    //查看著作信息
    public function selectOpus(Request $request)
    {
       $op_id = $request->op_id;
       $opus  = OpusDatabase::selectOpusDatas($op_id);
       return showMsg(0,'查询成功',$opus);
    }
    //查看所有著作信息
    public function selectAllOpus()
    {
        $teacher_id = session('usercount');
        $all_opus   = OpusDatabase::selectOpusAllDatas($teacher_id);
        return showMsg(0,'查询成功',$all_opus);
    }
    //修改著作信息
    public function updateOpus(Request $request)
    {
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $op_id            = trim($request->op_id);
        $datas = [
            'op_id'            => $op_id,
            'op_first_author'  => trim($request->op_first_author),
            'op_all_author'    => trim($request->op_all_author),
            'op_name'          => trim($request->op_name),
            'op_form_write'    => trim($request->op_form_write),
            'op_publish'       => trim($request->op_publish),
            'op_publish_time'  => strtotime(trim($request->op_publish_time)),
            'op_number'        => trim($request->op_number),
            'op_total_words'   => trim($request->op_total_words),
            'op_self_words'    => trim($request->op_self_words),
            'op_cate_work'     => trim($request->op_cate_works),
            'op_integral'      => trim($request->op_integral),
            'op_cate_research' => trim($request->op_cate_research),
            'op_sub_category'  => trim($request->op_sub_category),
            'op_remarks'       => trim($request->op_remarks)
        ];
        $judge_datas = judgeOpusField($datas);
        if($judge_datas->code == 1){
            return $judge_datas;
        }
        return  OpusDatabase::updateOpusDatas($datas);
    }
    //修改著作图片信息
    public function updateOpusImage(Request $request){
        if(!$request->isMethod('POST')){
            return showMsg(1,'你请求的方式不对');
        }
        $op_id               = $request->op_id;
        $update_image_status = $request->update_image_status;
        if($update_image_status == 1){
            $opus_image = $request->file('op_cover_image');
            $subjection = UploadSubjectionConfig::OPUS_COVER_IMG;
        }else{
            $opus_image = $request->file('op_coright_image');
            $subjection = UploadSubjectionConfig::COPYRIGHT_IMG;
        }
        $response       = judgeFileImage($opus_image);
        if($response->code == 1){
            return $response;
        }
        $disk = UploadSubjectionConfig::OPUS;
        $old_image_road = OpusDatabase::selectOpusImageRoad($op_id,$update_image_status);
        OpusDatabase::beginTraction();
        $new_image_road = uploadFiles($subjection,$opus_image,$disk);
        $reset_image    = OpusDatabase::updateImageDatas($new_image_road,$update_image_status,$op_id);
        if(!$reset_image){
            OpusDatabase::rollback();
            deletefiles($disk,$new_image_road);
            return showMsg(1,'修改图片失败');
        }else{
            OpusDatabase::commit();
            deletefiles($disk,$old_image_road);
            return showMsg(0,'修改图片成功');
        }
    }
}