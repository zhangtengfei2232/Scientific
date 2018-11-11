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
     //添加论文
     public function addArtical(Request $request){
         if(!$request->isMethod('POST')){
              return responseTojson(1,'你请求的方式不对',1);

         }
         $teacher_id = session('usercount');
         $datas = [
             'teacher_id'        => $teacher_id,                              //老师工号
             'author'            => trim($request->author),                   //作者
             'art_all_author'    => trim($request->art_all_author),           //全部作者
             'title'             => trim($request->title),                    //题目
             'publication_name'  => trim($request->publication_name),         //刊物名称
             'publication_num'   => trim($request->publication_num),          //刊号
             'period'            => trim($request->period),                   //年卷期
             'num_words'         => trim($request->num_words),                //论文字数
             'periodical_cate'   => trim($request->periodical_cate),          //期刊级别
             'belong_project'    => trim($request->belong_project),           //所属项目
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
         if(!$request->hasFile('art_sci_road')){
             return responseTojson(1,'请你上传PDF格式的SCI索引报告');
         }
         $artical_file  = $request->file('art_road');                     //接论文文件
         $artical_sci   = $request->file('art_sci_road');                 //接收sci索引报告
         $judge_artical = judgeReceiveFiles($artical_file);                   //验证论文
         if($judge_artical['code'] == 1){
             return responseTojson(1,'论文'.$judge_artical['message']);
         }
         $judge_sci = judgeReceiveFiles($artical_sci);                       //验证论文SCI
         if($judge_sci['code'] == 1){
             return responseTojson(1,'论文SCI索引报告'.$judge_sci['message']);
         }
         $disk               = UploadSubjectionConfig::ARTICAL;
         ArticalDatabase::beginTraction();
         $subjection_artical = UploadSubjectionConfig::ARTICAL_PDF;
         $subjection_sci     = UploadSubjectionConfig::ARTICAL_SCI;
         $artical_road       = uploadFiles($subjection_artical,$artical_file,$disk);
         $artical_sci_road   = uploadFiles($subjection_sci,$artical_sci,$disk);
         $datas['art_road']       = $artical_road;
         $datas['art_sci_road']   = $artical_sci_road;
         $datas['art_remarks']    = trim($request->art_remarks);
         $add_artical = ArticalDatabase::addArticalDatas($datas);
         if($add_artical){
             ArticalDatabase::commit();
             return responseTojson(0,'添加论文成功');
         }
         ArticalDatabase::rollback();
         deletefiles($disk,$artical_road);
         deletefiles($disk,$artical_sci_road);
         return responseTojson(1,'添加论文失败');
     }
     //删除论文
     public function deleteArtical(Request $request){
         $art_id_datas        = $request->art_id_datas;
         $disk                = UploadSubjectionConfig::ARTICAL;
         $select_artical_road = ArticalDatabase::selectArticalRoad($art_id_datas);
         $delete_artical      = ArticalDatabase::deleteArticalDatas($art_id_datas);
         if(!$delete_artical){
             return responseTojson(0,'删除文章失败');
         }
         deletefiles($disk,$select_artical_road->art_road);
         deletefiles($disk,$select_artical_road->art_sci_road);
         return responseTojson(0,'删除文章成功');
     }
     //查找个人一篇论文信息
     public function selectArtical(Request $request){
         $result =  ArticalDatabase::selectArticalDatas($request->art_id);
         return responseTojson(0,'查询成功','',$result);
     }
     //查找个人全部论文信息
     public function selectAllAttical(){
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
     //修改论文
     public function updateArtical(Request $request){
         if(!$request->isMethod('POST')) {
             return responseTojson(1,'你请求的方式不对');
         }
         $artical_id        = trim($request->artical_id);
         $datas = [
             'artical_id'        => $artical_id,                              //论文ID
             'author'            => trim($request->author),                   //作者
             'art_all_author'    => trim($request->art_all_author),           //全部作者
             'title'             => trim($request->title),                    //题目
             'publication_name'  => trim($request->publication_name),         //刊物名称
             'publication_num'   => trim($request->publication_num),          //刊号
             'period'            => trim($request->period),                   //年卷期
             'num_words'         => trim($request->num_words),                //论文字数
             'periodical_cate'   => trim($request->periodical_cate),          //期刊级别
             'belong_project'    => trim($request->belong_project),           //所属项目
             'art_cate_research' => trim($request->art_cate_research),        //研究类别
             'art_sub_category'  => trim($request->art_sub_category),         //学科门类
             'art_integral'      => trim($request->art_integral),             //学科积分
             'sch_percal_cate'   => trim($request->sch_percal_cate),          //学校认证期刊级别
             'art_remarks'       => trim($request->art_remarks),              //论文备注
             'art_time'          => trim($request->art_time),                 //发表时间
         ];
         $judge_datas = judgeArticalField($datas);                  //判断论文字段是否合法
         if($judge_datas['code'] == 1){
             return responseTojson(1,$judge_datas['message']);
         }
         if(!$request->is_change_artical){                                    //判断老师是否修改论文
             return ArticalDatabase::updateArticalImage($datas);              //直接修改数据库论文信息
         }
         $artical_file  = $request->file('pdf');                          //接论文文件
         $artical_sci   = $request->file('sci');
         $judge_artical = judgeReceiveFiles($artical_file);     //验证论文
         if($judge_artical['code'] == 1){
             return responseTojson(1,'论文'.$judge_artical);
         }
         $judge_sci     = judgeReceiveFiles($artical_sci);      //验证论文SCI
         if($judge_sci['code'] == 1){
             return responseTojson(1,'论文SCI索引'.$judge_sci);
         }
         $old_artical_road      = ArticalDatabase::selectArticalRoad($artical_id);
         $disk                  = UploadSubjectionConfig::ARTICAL;
         $subjection_pdf        = uploadSubjectionConfig::ARTICAL_PDF;
         $subjection_sci        = uploadSubjectionConfig::ARTICAL_SCI;
         ArticalDatabase::beginTraction();
         $reset_artical_road      = uploadfiles($subjection_pdf,$artical_file,$disk);
         $reset_sci_road          = uploadFiles($subjection_sci,$artical_sci,$disk);
         $datas['art_road']       = $reset_artical_road;
         $datas['art_sci_road']   = $reset_sci_road;
         $retUpdate  = ArticalDatabase::updateArticalImage($datas);
         if (!$retUpdate){
             ArticalDatabase::rollback();
             deletefiles($disk,$reset_artical_road);
             deletefiles($disk,$reset_sci_road);
             return responseTojson(1,'修改文章失败');
         }
         ArticalDatabase::commit();
         deletefiles($disk,$old_artical_road->art_road);            //删除原来的首页
         deletefiles($disk,$old_artical_road->art_sci_road);        //删除原来的论文SCI
         return responseTojson(0,'修改论文信息成功');
     }
     //根据时间查询论文
     public function dateSelectArtical(Request $request){
         $start_time = $request->start_time;
         $end_time   = $request->end_time;


     }
     //导出单个论文
     public function exportArtical(Request $request){

     }
     //同时导出多个论文，取每个论文的第一页，形成一个新的PDF论文
     public function exportAllArtical(Request $request){
         $art_id_datas = $request->art_id_datas;
         $art_road_datas = ArticalDatabase::selectArticalRoad($art_id_datas);
         $disk = UploadSubjectionConfig::ARTICAL;
         selectionFirstPageToNewPdf($disk,$art_road_datas);
         return ;
     }
}