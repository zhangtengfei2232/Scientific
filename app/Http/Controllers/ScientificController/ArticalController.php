<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ArticalDatabase;
use Illuminate\Http\Request;

class ArticalController extends Controller
{
     //添加论文
    /**@param
     * @param Request $request
     */
     public function addArtical(Request $request)
     {
          if($request->isMethod('POST')){
              $file = $request->file('pdf-art');
              if($file->isValid()){
                   $extension = $file->extension();
                   $filename  = time().'.'.$extension;
                   uploadfiles('artical',$filename);
              }
          }
     }
     //删除论文
     public function deleteArtical(Request $request)
     {

     }
     //查找个人一篇论文信息
     public function selectArtical(Request $request)
     {
         $result =  ArticalDatabase::selectArticalDatas($request->art_id);
         return showMsg(0,'查询成功',$result);
     }
     //查找个人全部论文信息
     public function selectAllAttical()
     {
         $teacher_id = session('usercount');
         $result     = ArticalDatabase::selectAllArticalDatas($teacher_id);
         return showMsg(0,'查询成功',$result);
     }
     //修改论文
     public function updateArtical(Request $request)
     {
         $title             = trim($request->title);
         $author            = trim($request->author);
         $art_all_author    = trim($request->art_all_author);
         $publication_name  = trim($request->publication_name);
         $publication_num   = trim($request->publication_num);
         $period            = trim($request->period);
         $num_words         = trim($request->num_words);
         $periodical_cate   = trim($request->periodical_cate);
         $belong_project    = trim($request->belong_project);
         $art_cate_research = trim($request->art_cate_research);
         $art_sub_category  = trim($request->art_sub_category);
         $art_integral      = trim($request->art_integral);
         $art_time          = trim($request->art_time);
         $datas = [
              'title'             => $title,               //题目
              'author'            => $author ,             //作者
              'art_all_author'    => $art_all_author ,     //全部作者
              'publication_name'  => $publication_name,    //刊物名称
              'publication_num'   => $publication_num ,    //刊号
              'period'            => $period ,             //年卷期
              'num_words'         => $num_words,           //论文字数
              'periodical_cate'   => $periodical_cate,     //期刊类别
              'belong_project'    => $belong_project,      //所属项目
              'art_cate_research' => $art_cate_research,   //研究类别
              'art_sub_category'  => $art_sub_category,    //学科门类
              'art_integral'      => $art_integral ,       //学科积分
              'art_time'          => $art_time ,           //发表时间
          ];
         $respose = judgeArticalField($datas);             //判断论文字段是否合法
         if($respose->code == 1){
             return showMsg($respose);
         }else{
             return ArticalDatabase::updateArticalDatas($datas);
         }
     }
     //根据时间查询论文
     public function dateSelectArtical(Request $request)
     {

     }
     //导出单个论文
     public function exportArtical(Request $request)
     {

     }
     //同时导出多个论文，取每个论文的第一页，形成一个新的PDF论文
     public function exportSomeArtical()
     {

     }
}