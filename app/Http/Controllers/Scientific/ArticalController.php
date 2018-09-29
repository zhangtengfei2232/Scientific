<?php
namespace App\Http\Controllers\Scientific;


use App\Http\Controllers\Controller;
use App\Model\ArticalDatabase;
use Illuminate\Http\Request;

class ArticalController extends Controller
{
     //添加论文
     public function addArtical(Request $request)
     {

     }
     //删除论文
     public function deleteArtical(Request $request)
     {

     }
     //查找论文信息
     public function selectArtical()
     {
         $result =  ArticalDatabase::selectArtical();
         return showMsg(0,'查询成功',$result);
     }
     //修改论文
     public function updateArtical(Request $request)
     {

     }
}