<?php
namespace App\Http\Controllers\Scientific;


use App\Http\Controllers\Controller;
use App\Model\ArticalDatabase;

class ArticalController extends Controller
{
     public function seartical(){

         $result =  ArticalDatabase::selectArtical();
         return showMsg(0,'查询成功',$result);

     }
}