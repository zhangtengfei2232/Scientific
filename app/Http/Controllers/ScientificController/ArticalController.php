<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ArticalDatabase;
use App\Model\ModelDatabase;
use Illuminate\Http\Request;
use config\UploadSubjectionConfig;
use config\SearchMessageConfig;
class ArticalController extends Controller
{
     private $disk               = UploadSubjectionConfig::ARTICAL;
     private $subjection_sci     = UploadSubjectionConfig::ARTICAL_SCI;
     private $subjection_artical = UploadSubjectionConfig::ARTICAL_PDF;
     //添加论文
     public function addArtical(Request $request){
         if(!$request->isMethod('POST')){
              return responseTojson(1,'你请求的方式不对',1);
         }
         $num_words = trim($request->num_words);
         if(!empty($num_words)) {
             if (!preg_match("/^[0-9]*$/", $num_words)
                 || strlen($num_words) > 9) {
                 return responseTojson(1, '你输入的论文字数必须为数字，且不能超过9位');
             }
         }else{
             $num_words = 0;
         }
         $teacher_id = session('usercount');
         $datas = [
             'teacher_id'        => $teacher_id,                              //老师工号
             'author'            => trim($request->author),                   //作者
             'art_all_author'    => trim($request->art_all_author),           //全部作者
             'title'             => trim($request->title),                    //题目
             'publication_name'  => trim($request->publication_name),         //刊物名称
             'period'            => trim($request->period),                   //年卷期
             'percal_cate'       => trim($request->percal_cate),              //期刊级别
             'art_cate_research' => trim($request->art_cate_research),        //研究类别
             'art_sub_category'  => trim($request->art_sub_category),         //学科门类
             'art_integral'      => trim($request->art_integral),             //学科积分
             'sch_percal_cate'   => trim($request->sch_percal_cate),          //学校认证期刊级别
             'art_time'          => trim($request->art_time),                 //发表时间
         ];
         $respose = judgeArticalField($datas);
         if($respose['code'] == 1){                                          //判断论文字段是否合法
             return responseTojson(1,$respose['message']);
         }
         if(!$request->hasFile('art_road')){
             return responseTojson(1,'请你上传PDF格式的论文');
         }
         $artical_sci_road   = '';
         if($request->hasFile('art_sci_road')){
             $artical_sci   = $request->file('art_sci_road');              //接收sci索引报告
             $judge_sci = judgeReceiveFiles($artical_sci);                     //验证论文SCI
             if($judge_sci['code'] == 1){
                 return responseTojson(1,'论文SCI索引报告'.$judge_sci['message']);
             }
             $artical_sci_road = uploadFiles($this->subjection_sci,$artical_sci,$this->disk);
         }
         $artical_file  = $request->file('art_road');                     //接论文文件
         $judge_artical = judgeReceiveFiles($artical_file);                   //验证论文
         if($judge_artical['code'] == 1){
             return responseTojson(1,'论文'.$judge_artical['message']);
         }
         ArticalDatabase::beginTraction();
         $artical_road             = uploadFiles($this->subjection_artical,$artical_file,$this->disk);
         $datas['belong_project']  = trim($request->belong_project);         //所属项目
         $datas['publication_num'] = trim($request->publication_num);        //刊号
         $datas['num_words']       = $num_words;                             //论文字数
         $datas['art_road']        = $artical_road;
         $datas['art_sci_road']    = $artical_sci_road;
         $datas['art_remarks']     = trim($request->art_remarks);
         $add_artical = ArticalDatabase::addArticalDatas($datas);
         if($add_artical){
             ArticalDatabase::commit();
             return responseTojson(0,'添加论文成功');
         }
         ArticalDatabase::rollback();
         deletefiles($this->disk,$artical_road);
         if(!empty($artical_sci_road)) deletefiles($this->disk,$artical_sci_road);
         return responseTojson(1,'添加论文失败');
     }
     //删除论文
     public function deleteArtical(Request $request){
         $art_id_datas        = $request->art_id_datas;
         $disk                = UploadSubjectionConfig::ARTICAL;
         $select_artical_road = ArticalDatabase::selectArticalRoad($art_id_datas,0);
         $delete_artical      = ArticalDatabase::deleteArticalDatas($art_id_datas);
         if(!$delete_artical){
             return responseTojson(1,'删除文章失败');
         }
         if(!empty($select_artical_road)){
             deleteAllFiles($disk,$select_artical_road);
         }
         return responseTojson(0,'删除文章成功');
     }
     //查找个人一篇论文信息
     public function selectArtical(Request $request){
         $result =  ArticalDatabase::selectArticalDatas($request->art_id);
         return responseTojson(0,'查询成功','',$result);
     }
     //查找个人全部论文信息
     public function selectAllArtical(){
         $teacher_id = session('usercount');
         $result     = ArticalDatabase::selectAllArticalDatas($teacher_id);
         return responseTojson(0,'查询成功','',$result);
     }
    //根据时间区间搜索文章信息
     public function timeSelectArtical(Request $request){
         $teacher_id = session('usercount');
         $start_time = $request->start_time;
         $end_time   = $request->end_time;
         $table_name = SearchMessageConfig::ARTICAL_TABLE;
         $time_field = SearchMessageConfig::ART_TIME;
         return ModelDatabase::timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id);
     }
     //修改论文信息
     public function updateArticalInformation(Request $request){
         if(!$request->isMethod('POST')) {
             return responseTojson(1,'你请求的方式不对');
         }
         $num_words = trim($request->num_words);
         if(!empty($num_words)) {
             if (!preg_match("/^[0-9]*$/", $num_words)
                 || strlen($num_words) > 9) {
                 return responseTojson(1, '你输入的论文字数必须为数字，且不能超过9位');
             }
         }else{
             $num_words = 0;
         }
         $artical_id        = trim($request->art_id);
         $datas = [
             'art_id'            => $artical_id,                              //论文ID
             'author'            => trim($request->author),                   //作者
             'art_all_author'    => trim($request->art_all_author),           //全部作者
             'title'             => trim($request->title),                    //题目
             'publication_name'  => trim($request->publication_name),         //刊物名称
             'period'            => trim($request->period),                   //年卷期
             'percal_cate'       => trim($request->percal_cate),              //期刊级别
             'art_cate_research' => trim($request->art_cate_research),        //研究类别
             'art_sub_category'  => trim($request->art_sub_category),         //学科门类
             'art_integral'      => trim($request->art_integral),             //学科积分
             'sch_percal_cate'   => trim($request->sch_percal_cate),          //学校认证期刊级别
             'art_time'          => trim($request->art_time),                 //发表时间
         ];
         $judge_datas = judgeArticalField($datas);                            //判断论文字段是否合法
         if($judge_datas['code'] == 1){
             return responseTojson(1,$judge_datas['message']);
         }
         $datas['belong_project']  = trim($request->belong_project);         //所属项目
         $datas['publication_num'] = trim($request->publication_num);        //刊号
         $datas['num_words']       = $num_words;                             //论文字数
         $datas['art_remarks']     = trim($request->art_remarks);            //论文备注
         return ArticalDatabase::updateArticalDatas($datas);
     }
     //修改论文本身和论文sci索引报告
     public function updateArticalSelf(Request $request){
         if(!$request->isMethod('POST')){
             return responseTojson(1,'你请求的方式不对');
         }
         if(!$request->hasFile('art_road') && !$request->hasFile('art_sci_road')){                                    //判断老师是否修改论文
             return responseTojson(1,'请你上传你要修改的PDF格式的论文或SCI索引报告');
         }
         $artical_id = trim($request->art_id);
         if($request->hasFile('art_road')){
             $update_artical_status = 1;
             $artical_file   = $request->file('art_road');                          //接论文文件
             $subjection_pdf = $this->subjection_artical;
         }else{
             $update_artical_status = 2;
             $artical_file   = $request->file('art_sci_road');
             $subjection_pdf = $this->subjection_sci;
         }
         $judge_artical = judgeReceiveFiles($artical_file);           //验证论文
         if($judge_artical['code'] == 1){
             return responseTojson(1,$judge_artical['messgae']);
         }
         $old_artical_road   = ArticalDatabase::selectArticalRoad($artical_id,$update_artical_status);
         ArticalDatabase::beginTraction();
         $reset_artical_road = uploadfiles($subjection_pdf,$artical_file,$this->disk);
         $retset_artical     = ArticalDatabase::updateArticalSelfDatas($reset_artical_road,$update_artical_status,$artical_id);
         if ($retset_artical){
             ArticalDatabase::commit();
             deletefiles($this->disk,$old_artical_road);               //删除原来的论文
             return responseTojson(0,'修改论文信息成功');
         }
         ArticalDatabase::rollback();
         deletefiles($this->disk,$reset_artical_road);
         return responseTojson(1,'修改论文失败');
     }
}
