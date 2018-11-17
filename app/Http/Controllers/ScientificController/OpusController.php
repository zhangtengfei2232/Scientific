<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use Illuminate\Http\Request;
use App\Model\OpusDatabase;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
class OpusController  extends Controller
{
    //添加著作信息
    public function addOpus(Request $request)
    {
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $datas = [
            'teacher_id'       => session('usercount'),
            'op_first_author'  => trim($request->op_first_author),
            'op_all_author'    => trim($request->op_all_author),
            'op_name'          => trim($request->op_name),
            'op_form_write'    => trim($request->op_form_write),
            'op_publish'       => trim($request->op_publish),
            'op_publish_time'  => trim($request->op_publish_time),
            'op_number'        => trim($request->op_number),
            'op_total_words'   => trim($request->op_total_words),
            'op_self_words'    => trim($request->op_self_words),
            'op_cate_work'     => trim($request->op_cate_work),
            'op_integral'      => trim($request->op_integral),
            'op_cate_research' => trim($request->op_cate_research),
            'op_sub_category'  => trim($request->op_sub_category)
        ];
        $judge_datas = judgeOpusField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        $datas['op_remarks'] = trim($request->op_remarks);
        return OpusDatabase::addOpusDatas($datas);
    }
    //添加著作封面和版权图片
    public function addOpusImage(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        if(!$request->is_add_opus){
            return responseTojson(1,'请你先添加著作信息');
        }
        if(!$request->hasFile('op_cover_road') && !$request->hasFile('op_coright_road')){
            return responseTojson(1,'请你上传著作证书图片');
        }
        if($request->hasFile('op_cover_road')){
            $add_image_status = 1;
            $opus_image = $request->file('op_cover_road');
            $subjection = UploadSubjectionConfig::OPUS_COVER_IMG;
        }else{
            $add_image_status = 2;
            $opus_image = $request->file('op_coright_road');
            $subjection = UploadSubjectionConfig::COPYRIGHT_IMG;
        }
        $judge_opu_iamge  = judgeFileImage($opus_image);
        if($judge_opu_iamge['code'] == 1){
            return responseTojson(1,$judge_opu_iamge['message']);
        }
        $op_id       = $request->op_id;
        $disk        = UploadSubjectionConfig::OPUS;
        $new_image_road = uploadFiles($subjection,$opus_image,$disk);
        $add_image      = OpusDatabase::updateImageDatas($new_image_road,$add_image_status,$op_id);
        if($add_image){
            return responseTojson(0,'上传图片成功','',$new_image_road);
        }
        deletefiles($disk,$new_image_road);
        return responseTojson(1,'上传图片失败');
    }
    //删除著作信息
    public function deleteOpus(Request $request)
    {
        $op_id_datas = $request->op_id_datas;
        $table_name          = SearchMessageConfig::OPUS_TABLE;
        $id_field            = SearchMessageConfig::OPUS_ID;
        $old_images_road = OpusDatabase::selectOpusAllImageDatas($op_id_datas);
        ModelDatabase::beginTraction();
        $delete_opus     = ModelDatabase::deleteAllDatas($table_name,$id_field,$op_id_datas);
        if($delete_opus) {
            ModelDatabase::commit();
            deleteAllFiles(UploadSubjectionConfig::OPUS, $old_images_road);
            return responseTojson(0, '删除成功');
        }
        ModelDatabase::rollback();
        return responseTojson(1,'删除失败');
    }
    //查看著作信息
    public function selectOpus(Request $request)
    {
       $op_id = $request->op_id;
       $opus  = OpusDatabase::selectOpusDatas($op_id);
       return responseTojson(0,'查询成功','',$opus);
    }
    //查看所有著作信息
    public function selectAllOpus()
    {
        $teacher_id = session('usercount');
        $all_opus   = OpusDatabase::selectOpusAllDatas($teacher_id);
        return responseTojson(0,'查询成功','',$all_opus);
    }
    //根据时间区间搜索成果鉴定
    public function timeSelectOpus(Request $request){
        $teacher_id = session('usercount');
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::OPUS_TABLE;
        $time_field = SearchMessageConfig::OP_PUBLISH_TIME;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
    //修改著作信息
    public function updateOpus(Request $request)
    {
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $op_id                 = trim($request->op_id);
        $datas = [
            'op_id'            => $op_id,
            'op_first_author'  => trim($request->op_first_author),
            'op_all_author'    => trim($request->op_all_author),
            'op_name'          => trim($request->op_name),
            'op_form_write'    => trim($request->op_form_write),
            'op_publish'       => trim($request->op_publish),
            'op_publish_time'  => trim($request->op_publish_time),
            'op_number'        => trim($request->op_number),
            'op_total_words'   => trim($request->op_total_words),
            'op_self_words'    => trim($request->op_self_words),
            'op_cate_work'     => trim($request->op_cate_work),
            'op_integral'      => trim($request->op_integral),
            'op_cate_research' => trim($request->op_cate_research),
            'op_sub_category'  => trim($request->op_sub_category)
        ];
        $judge_datas = judgeOpusField($datas);
        if($judge_datas['code'] == 1){
            return $judge_datas;
        }
        $datas['op_remarks'] = trim($request->op_remarks);
        return  OpusDatabase::updateOpusDatas($datas);
    }
    //修改著作图片信息
    public function updateOpusImage(Request $request){
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $op_id               = $request->op_id;
        if(!$request->hasFile('op_cover_road') && !$request->hasFile('op_coright_road')){
            return responseTojson(1,'请你上传著作证书图片');
        }
        if($request->hasFile('op_cover_road')){
            $update_image_status = 1;
            $opus_image = $request->file('op_cover_road');
            $subjection = UploadSubjectionConfig::OPUS_COVER_IMG;
        }else{
            $update_image_status = 2;
            $opus_image = $request->file('op_coright_road');
            $subjection = UploadSubjectionConfig::COPYRIGHT_IMG;
        }
        $judge_image       = judgeFileImage($opus_image);
        if($judge_image['code'] == 1){
            return responseTojson(1,$judge_image['message']);
        }
        $disk = UploadSubjectionConfig::OPUS;
        $old_image_road = OpusDatabase::selectOpusImageRoad($op_id,$update_image_status);
        OpusDatabase::beginTraction();
        $new_image_road = uploadFiles($subjection,$opus_image,$disk);
        $reset_image    = OpusDatabase::updateImageDatas($new_image_road,$update_image_status,$op_id);
        if($reset_image){
            OpusDatabase::commit();
            if(!empty($old_image_road)){
                deletefiles($disk,$old_image_road);
            }
            return responseTojson(0,'修改图片成功');
        }
        OpusDatabase::rollback();
        deletefiles($disk,$new_image_road);
        return responseTojson(1,'修改图片失败');
    }
}