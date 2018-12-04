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
    private $disk         = UploadSubjectionConfig::OPUS;
    private   $subjection = UploadSubjectionConfig::OPUS_IMG;
    //添加著作信息
    public function addOpus(Request $request)
    {
        if(!$request->isMethod('POST')){
            return responseTojson(1,'你请求的方式不对');
        }
        $op_total_words = trim($request->op_total_words);
        if(!empty($op_total_words)) {
            if (!is_numeric( $op_total_words)
                || strlen($op_total_words) > 9) {
                return responseTojson(1, '你输入的著作总字数必须为数字，且不能超过9位');
            }
        }else{
            $op_total_words = 0;
        }
        $op_self_words  = trim($request->op_self_words);
        if(!empty($op_self_words)) {
            if (!is_numeric($op_self_words)
                || strlen($op_self_words) > 9) {
                return responseTojson(1, '你输入的著作本人字数必须为数字，且不能超过9位');
            }
        }else{
            $op_self_words = 0;
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
            'op_cate_work'     => trim($request->op_cate_work),
            'op_integral'      => trim($request->op_integral),
            'op_cate_research' => trim($request->op_cate_research),
            'op_sub_category'  => trim($request->op_sub_category)
        ];
        $judge_datas = judgeOpusField($datas);
        if($judge_datas['code'] == 1){
            return responseTojson(1,$judge_datas['message']);
        }
        $datas['op_total_words'] = $op_total_words;
        $datas['op_self_words']  = $op_self_words;
        $datas['op_remarks'] = trim($request->op_remarks);
        if(!$request->hasFile('op_road')){
            $datas['op_road'] = '';
            return OpusDatabase::addOpusDatas($datas);
        }
        $opus_image = $request->file('op_road');
        $judge_image = judgeReceiveFiles($opus_image);
        if($judge_image['code'] == 1){
            return responseTojson(1,$judge_image['message']);
        }
        $new_image_road   = uploadFiles($this->subjection,$opus_image,$this->disk);
        $datas['op_road'] = $new_image_road;
        $add_opus         = OpusDatabase::addOpusDatas($datas);
        if($add_opus){
            return responseTojson(0,'添加著作信息成功');
        }
        deletefiles($this->disk,$new_image_road);
        return responseTojson(0,'添加著作信息成功');
    }
    //删除著作信息
    public function deleteOpus(Request $request)
    {
        $op_id_datas         = $request->op_id_datas;
        $table_name          = SearchMessageConfig::OPUS_TABLE;
        $id_field            = SearchMessageConfig::OPUS_ID;
        $old_images_road     = OpusDatabase::selectOpusAllImageDatas($op_id_datas);
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
        $op_total_words = trim($request->op_total_words);
        $op_total_words = intval($op_total_words);
        if(!empty($op_total_words)) {
            if (!is_numeric($op_total_words)
                || strlen($op_total_words) > 9) {
                return responseTojson(1, '你输入的著作总字数必须为数字，且不能超过9位');
            }
        }else{
            $op_total_words = 0;
        }
        $op_self_words  = trim($request->op_self_words);
        if(!empty($op_self_words)) {
            if (!is_numeric( $op_self_words)
                || strlen($op_self_words) > 9) {
                return responseTojson(1, '你输入的著作本人字数必须为数字，且不能超过9位');
            }
        }else{
            $op_self_words = 0;
        }
        $op_id[0]              = trim($request->op_id);
        $opus_road             = OpusDatabase::selectOpusAllImageDatas($op_id);
        (empty($opus_road)) ? $opus_road = '' : $opus_road = $opus_road[0];
        $datas = [
            'op_id'            => $op_id[0],
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
        $datas['op_total_words'] = $op_total_words;
        $datas['op_self_words']  = $op_self_words;
        $datas['op_remarks'] = trim($request->op_remarks);
        $reset_image_status = false;
        if(!$request->hasFile('op_road')){
            $datas['op_road']   = $opus_road;
            return OpusDatabase::updateOpusDatas($datas,$reset_image_status);
        }
        $reset_image_status = true;
        $opus_image = $request->file('op_road');
        $judge_image = judgeReceiveFiles($opus_image);
        if($judge_image['code'] == 1){
            return responseTojson(1,$judge_image['message']);
        }
        $new_image_road = uploadFiles($this->subjection,$opus_image,$this->disk);
        $datas['op_road'] = $new_image_road;
        OpusDatabase::beginTraction();
        $reset_opus = OpusDatabase::updateOpusDatas($datas,$reset_image_status);
        if($reset_opus){
             OpusDatabase::commit();
             if(!empty($opus_road)){
                 deletefiles($this->disk,$opus_road);
             }
             return responseTojson(0,'修改著作信息成功');
        }
        deletefiles($this->disk,$new_image_road);
        return responseTojson(1,'修改著作信息失败');
    }

}
