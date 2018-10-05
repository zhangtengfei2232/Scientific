<?php
namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatentController extends Controller
{
     //添加专利信息
     public function addPatent()
     {

     }
     //删除专利信息
     public function deletePatent()
     {

     }
     //查看专利信息
     public function selectPatent()
     {

     }
     //修改专利信息
     public function updatePatent(Request $request)
     {
        $first_inventor   = trim($request->first_inventor);
        $pa_all_author    = trim($request->pa_all_author);
        $pa_type          = trim($request->pa_type);
        $pa_name          = trim($request->pa_name);
        $pa_imple_situ    = trim($request->pa_imple_situ);
        $author_num       = trim($request->author_num);
        $author_cert_num  = trim($request->author_cert_num);
        $author_notic_day = trim($request->author_notic_day);
        $pa_integral      = trim($request->pa_integral);
        $pa_remarks       = trim($request->pa_remarks);

     }
}