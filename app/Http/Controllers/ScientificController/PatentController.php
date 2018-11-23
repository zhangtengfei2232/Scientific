<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use Illuminate\Http\Request;
use App\Model\PatentDatabase;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
class PatentController extends Controller
{
     //添加专利信息
     public function addPatent(Request $request)
     {
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         $datas = [
             'teacher_id'       => session('usercount'),
             'patent_person'    => trim($request->patent_person),
             'first_inventor'   => trim($request->first_inventor),
             'pa_all_author'    => trim($request->pa_all_author),
             'pa_type'          => trim($request->pa_type),
             'pa_name'          => trim($request->pa_name),
             'pa_imple_situ'    => trim($request->pa_imple_situ),
             'author_num'       => trim($request->author_num),
             'author_cert_num'  => trim($request->author_cert_num),
             'author_notic_day' => trim($request->author_notic_day),
             'pa_integral'      => trim($request->pa_integral)
         ];
         $judge_datas = judgePatenField($datas);
         if($judge_datas['code'] == 1){
             return responseTojson(1,$judge_datas['message']);
         }
         $datas['pa_remarks'] = trim($request->pa_remarks);
         if(!$request->hasFile('pa_road')){                    //判断是否添加图片
             $datas['pa_road'] = '';
             return PatentDatabase::addPatentDatas($datas);
         }
         $patent_image = $request->file('pa_road');
         $judge_image  = judgeFileImage($patent_image);
         if($judge_image['code'] == 1){
             return responseTojson(1,$judge_image['message']);
         }
         $disk              = UploadSubjectionConfig::PATENT;
         $subjection_patent = UploadSubjectionConfig::PATENT_IMG;
         $add_image_road    = uploadFiles($subjection_patent,$patent_image,$disk);
         $datas['pa_road']  = $add_image_road;
         $add_patent        = PatentDatabase::addPatentDatas($datas);
         if($add_patent){
             return responseTojson(0,'添加专利信息成功');
         }
         deletefiles($disk,$add_image_road);
         return responseTojson(1,'添加专利信息失败');
     }
     //删除专利信息
     public function deletePatent(Request $request){
         $pa_id_datas = $request->pa_id_datas;
         $table_name          = SearchMessageConfig::PATENT_TABLE;
         $id_field            = SearchMessageConfig::PATENT;
         $old_image_road = PatentDatabase::selectImageRoadDatas($pa_id_datas);
         ModelDatabase::beginTraction();
         $delete_patent  = ModelDatabase::deleteAllDatas($table_name,$id_field,$pa_id_datas);
         if($delete_patent) {
             ModelDatabase::commit();
             deleteAllFiles(UploadSubjectionConfig::PATENT, $old_image_road);
             return responseTojson(0, '删除成功');
         }
         ModelDatabase::rollback();
         return responseTojson(1,'删除失败');
     }
     //查看单个专利信息
     public function selectPatent(Request $request){
         $result = PatentDatabase::selectPatentDatas($request->pa_id);
         return responseTojson(0,'查询成功','',$result);
     }
     //查看所有专利信息
     public function selectAllPatent(){
         $result = PatentDatabase::selectPatenAllDatas(session('usercount'));
         return responseTojson(0,'查询成功','',$result);
     }
    //根据时间区间搜索成果鉴定
    public function timeSelectPatent(Request $request){
        $teacher_id = session('usercount');
        $start_time = $request->start_time;
        $end_time   = $request->end_time;
        $table_name = SearchMessageConfig::PATENT_TABLE;
        $time_field = SearchMessageConfig::AUTHOR_NOTIC_DAY;
        return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
    }
     //修改专利信息
     public function updatePatent(Request $request){
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         $pa_id[0] = trim($request->pa_id);
         $pa_road  = PatentDatabase::selectImageRoadDatas($pa_id);
         (empty($pa_road)) ? $pa_road = '' : $pa_road = $pa_road[0];
         $datas  = [
            'pa_id'            => $pa_id,
            'patent_person'    => trim($request->patent_person),
            'first_inventor'   => trim($request->first_inventor),
            'pa_all_author'    => trim($request->pa_all_author),
            'pa_type'          => trim($request->pa_type),
            'pa_name'          => trim($request->pa_name),
            'pa_imple_situ'    => trim($request->pa_imple_situ),
            'author_num'       => trim($request->author_num),
            'author_cert_num'  => trim($request->author_cert_num),
            'author_notic_day' => trim($request->author_notic_day),
            'pa_integral'      => trim($request->pa_integral)
         ];
         $judge_datas = judgePatenField($datas);
         if($judge_datas['code'] == 1){
             return responseTojson(1,$judge_datas['message']);
         }
         $reset_image_status = false;
         $datas['pa_road']   = $pa_road;
         $datas['pa_remarks'] = trim($request->pa_remarks);
         if(!$request->hasFile('pa_road')){
             return PatentDatabase::updatePatentDatas($datas,$reset_image_status);
         }
         $reset_image_status = true;
         $patent_image = $request->file('pa_road');
         $judge_image  = judgeFileImage($patent_image);
         if($judge_image['code'] ==1){
             return responseTojson(1,$judge_image['message']);
         }
         $disk              = UploadSubjectionConfig::PATENT;
         $subjection_patent = UploadSubjectionConfig::PATENT_IMG;
         $new_image_road    = uploadFiles($subjection_patent,$patent_image,$disk);
         $datas['pa_road']  = $new_image_road;
         PatentDatabase::beginTraction();
         $reset_patent      = PatentDatabase::updatePatentDatas($datas,$reset_image_status);
         if($reset_patent){
             PatentDatabase::commit();
             if(!empty($pa_road)){
                 deletefiles($disk,$pa_road);
             }
             return responseTojson(0,'修改专利信息成功');
         }
         PatentDatabase::rollback();
         deletefiles($disk,$new_image_road);
         return responseTojson(1,'修改信息失败');
     }
}