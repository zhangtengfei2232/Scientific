<?php
namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use App\Model\ArticalDatabase;
use Illuminate\Http\Request;

class ArticalController extends Controller
{
     //添加论文
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

     }
}