<?php
namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PatentDatabase;
use config\uploadsubjectionconfig;
class PatentController extends Controller
{
     //添加专利信息
     public function addPatent(Request $request)
     {
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         $datas = [
             'teacher_id'       => session('usercount'),
             'first_inventor'   => trim($request->first_inventor),
             'pa_all_author'    => trim($request->pa_all_author),
             'pa_type'          => trim($request->pa_type),
             'pa_name'          => trim($request->pa_name),
             'pa_imple_situ'    => trim($request->pa_imple_situ),
             'author_num'       => trim($request->author_num),
             'author_cert_num'  => trim($request->author_cert_num),
             'author_notic_day' => strtotime(trim($request->author_notic_day)),
             'pa_integral'      => trim($request->pa_integral),
             'pa_remarks'       => trim($request->pa_remarks)
         ];
         $judge_datas = judgePatenField($datas);
         if($judge_datas->code == 1){
             return $judge_datas;
         }
         $patent_image = $request->file('patent_image');
         $judge_image  = judgeFileImage($patent_image);
         if($judge_image->code == 1){
             return $judge_image;
         }
         $add_image_road   = uploadFiles(uploadsubjectionconfig::PATENT_IMG,$patent_image);
         $datas['pa_road'] = $add_image_road;
         $add_patent       = PatentDatabase::addPatentDatas($datas);
         if($add_patent){
             return showMsg(0,'添加专利信息成功');
         }
         deletefiles(uploadsubjectionconfig::PATENT,$add_image_road);
         return showMsg(1,'添加专利信息失败');
     }
     //删除专利信息
     public function deletePatent(){

     }
     //删除多个专利信息
     public function deleteAllPatent(){

     }
     //查看单个专利信息
     public function selectPatent(Request $request){
         $result = PatentDatabase::selectPatentDatas($request->pa_id);
         return showMsg(0,'查询成功',$result);
     }
     //查看所有专利信息
     public function selectAllPatent(){
         $result = PatentDatabase::selectPatenAllDatas(session('usercount'));
         return showMsg(0,'查询成功',$result);
     }
     //修改专利信息
     public function updatePatent(Request $request){
         if(!$request->isMethod('POST')){
             return showMsg(1,'你请求的方式不对');
         }
         $pa_id  = $request->pa_id;
         $datas  = [
            'pa_id'            => $pa_id,
            'first_inventor'   => trim($request->first_inventor),
            'pa_all_author'    => trim($request->pa_all_author),
            'pa_type'          => trim($request->pa_type),
            'pa_name'          => trim($request->pa_name),
            'pa_imple_situ'    => trim($request->pa_imple_situ),
            'author_num'       => trim($request->author_num),
            'author_cert_num'  => trim($request->author_cert_num),
            'author_notic_day' => strtotime(trim($request->author_notic_day)),
            'pa_integral'      => trim($request->pa_integral),
            'pa_remarks'       => trim($request->pa_remarks)
         ];
         $judge_datas = judgePatenField($datas);
         if($judge_datas->code == 1){
             return $judge_datas;
         }
         $is_reset_image = $request->is_reset_image;
         if(!$is_reset_image){
             return PatentDatabase::updatePatentDatas($datas);
         }
         $patent_image = $request->file('patent_image');
         $judge_iamge  = judgeFileImage($patent_image);
         if($judge_iamge->code ==1){
             return $judge_iamge;
         }
         $disk = uploadsubjectionconfig::PATENT;
         $old_image_road = PatentDatabase::selectImageRoad($pa_id);
         $new_image_road = uploadFiles(uploadsubjectionconfig::PATENT_IMG,$patent_image);
         $datas['pa_road'] = $new_image_road;
         $reset_patent = PatentDatabase::updatePatentImage($datas);
         if($reset_patent){
             deletefiles($disk,$old_image_road);
             return showMsg(0,'修改专利信息成功');
         }
         deletefiles($disk,$new_image_road);
         return showMsg(1,'修改信息失败');
     }
}