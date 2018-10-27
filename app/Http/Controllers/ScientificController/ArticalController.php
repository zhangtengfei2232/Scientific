<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ArticalDatabase;
use Illuminate\Http\Request;
use config\UploadSubjectionConfig;
class ArticalController extends Controller
{
     //添加论文
     public function addArtical(Request $request){
         if(!$request->isMethod('POST')){
              return showMsg(1,'你请求的方式不对');

         }
         $artical_file  = $request->file('art_pdf');                    //接论文文件
         $artical_sci   = $request->file('art_sci');                    //接收sci索引报告
         $judge_artical = showResponse(judgeReceiveFiles($artical_file));    //验证论文
         if($judge_artical->code == 1){
             return showMsg(1,'论文'.$judge_artical->message);
         }
         $judge_sci = showResponse(judgeReceiveFiles($artical_sci));        //验证论文SCI
         if($judge_sci->code == 1){
             return showMsg(1,'论文SCI索引报告'.$judge_sci->message);
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
             'art_remarks'       => trim($request->art_remarks),              //论文备注
             'art_time'          => trim($request->art_time),                 //发表时间
         ];
//         $respose = showResponse(judgeArticalField($datas));
//         //判断论文字段是否合法
//         if($respose->code == 1){
//             return $respose;
//         }
         $disk               = UploadSubjectionConfig::ARTICAL;
         $subjection         = UploadSubjectionConfig::ARTICAL_IMG;
         $artical_name       = $artical_file->getClientOriginalName();        //获取文件名字
         ArticalDatabase::beginTraction();
         $subjection_artical = UploadSubjectionConfig::ARTICAL_PDF;
         $subjection_sci     = UploadSubjectionConfig::ARTICAL_SCI;
         $artical_road       = uploadFiles($subjection_artical,$artical_file,$disk);
         $artical_sci_road   = uploadFiles($subjection_sci,$artical_sci,$disk);
         $artical_first_road = pdfToPngUpload($disk,$artical_road,$subjection,$artical_name,1);
         $datas['art_road']       = $artical_road;
         $datas['home_page_road'] = $artical_first_road;
         $datas['art_sci_road']   = $artical_sci_road;
         $add_artical = ArticalDatabase::addArticalDatas($datas);
         if($add_artical){
             ArticalDatabase::commit();
             return showMsg(0,'添加论文成功');
         }
         ArticalDatabase::rollback();
         deletefiles($disk,$artical_road);
         deletefiles($disk,$artical_sci_road);
         deletefiles($disk,$artical_first_road);
         return showMsg(1,'添加论文失败');
     }
     //删除论文
     public function deleteArtical(Request $request){
         $artical_id          = $request->artical_id;
         $disk                = UploadSubjectionConfig::ARTICAL;
         $select_artical_road = ArticalDatabase::selectArticalRoad($artical_id);
         $delete_artical      = ArticalDatabase::deleteArticalDatas($artical_id);
         if(!$delete_artical){
             return showMsg(0,'删除文章失败');
         }
         deletefiles($disk,$select_artical_road->art_road);
         deletefiles($disk,$select_artical_road->home_page_road);
         deletefiles($disk,$select_artical_road->art_sci_road);
         return showMsg(0,'删除文章成功');
     }
     //查找个人一篇论文信息
     public function selectArtical(Request $request){
         $result =  ArticalDatabase::selectArticalDatas($request->art_id);
         return showMsg(0,'查询成功',$result);
     }
     //查找个人全部论文信息
     public function selectAllAttical(){
         $teacher_id = session('usercount');
         $result     = ArticalDatabase::selectAllArticalDatas($teacher_id);
         return showMsg(0,'查询成功',$result);
     }
     //修改论文
     public function updateArtical(Request $request){
         if(!$request->isMethod('POST')) {
             return showMsg(1,'你请求的方式不对');
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
         $respose = showResponse(judgeArticalField($datas));                  //判断论文字段是否合法
         if($respose->code == 1){
             return $respose;
         }
         if(!$request->is_change_artical){                                    //判断老师是否修改论文
             return ArticalDatabase::updateArticalDatas($datas);              //直接修改数据库论文信息
         }
         $artical_file  = $request->file('pdf');                          //接论文文件
         $artical_sci   = $request->file('sci');
         $judge_artical = showResponse(judgeReceiveFiles($artical_file));     //验证论文
         if($judge_artical->code == 1){
             return showMsg(1,'论文'.$judge_artical);
         }
         $judge_sci     = showResponse(judgeReceiveFiles($artical_sci));      //验证论文SCI
         if($judge_sci->code == 1){
             return showMsg(1,'论文SCI索引'.$judge_sci);
         }
         $old_artical_road      = ArticalDatabase::selectArticalRoad($artical_id);
         $disk                  = UploadSubjectionConfig::ARTICAL;
         $subjection_pdf        = uploadSubjectionConfig::ARTICAL_PDF;
         $subjection_sci        = uploadSubjectionConfig::ARTICAL_SCI;
         $subjection_img        = UploadSubjectionConfig::ARTICAL_IMG;
         ArticalDatabase::beginTraction();
         $reset_artical_road      = uploadfiles($subjection_pdf,$artical_file,$disk);
         $reset_sci_road          = uploadFiles($subjection_sci,$artical_sci,$disk);
         $artical_name            = $artical_file->getClientOriginalName();
         $reset_first_page_road   = pdfToPngUpload($disk,$reset_artical_road,$subjection_img,$artical_name,1);
         $datas['home_page_road'] = $reset_first_page_road;
         $datas['art_road']       = $reset_artical_road;
         $datas['art_sci_road']   = $reset_sci_road;
         $retUpdate  = ArticalDatabase::updateArticalImage($datas);
         if (!$retUpdate){
             ArticalDatabase::rollback();
             deletefiles($disk,$reset_artical_road);
             deletefiles($disk,$reset_sci_road);
             deletefiles($disk,$reset_first_page_road);
             return showMsg(1,'修改文章失败');
         }
         ArticalDatabase::commit();
         deletefiles($disk,$old_artical_road->art_road);            //删除原来的首页
         deletefiles($disk,$old_artical_road->home_page_road);      //删除原来的论文
         deletefiles($disk,$old_artical_road->art_sci_road);        //删除原来的论文SCI
         return showMsg(0,'修改论文信息成功');
     }
     //根据时间查询论文
     public function dateSelectArtical(Request $request){

     }
     //导出单个论文
     public function exportArtical(Request $request){

     }
     //同时导出多个论文，取每个论文的第一页，形成一个新的PDF论文
     public function exportAllArtical(){

     }
}