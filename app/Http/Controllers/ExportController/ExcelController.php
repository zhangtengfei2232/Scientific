<?php
namespace App\Http\Controllers\ExportController;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Excel;
class ExcelController extends Controller
{
    //导出论文Excel表格
    public function exportArticalExcel(){
        $cell_datas = [
            ['姓名','手机号']
        ];
        $information = [
            'infor' => 'ztf',
            'phone' => '123'
        ];
        $cell_datas[] = [
            $information['infor'],
            $information['phone']
        ];
        Excel::create('老师信息',function ($excel) use ($cell_datas){
            $excel->sheet('information',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });

        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出项目Excel表格
    public function exportProjectExcel(){

    }
    //导出著作Excel表格
    public function exportOpusExcel(){

    }
    //导出获奖Excel表格
    public function exportAwardExcel(){

    }
    //导出专利Excel表格
    public function exportPatentExcel(){

    }
    //导出成果鉴定Excel表格
    public function exportAppraisalExcel(){

    }
    //导出举行会议Excel表格
    public function exportHoldmeetExcel(){

    }
    //导出参加会议Excel表格
    public function exportJoinmeetExcel(){

    }
    //导出讲学Excel表格
    public function exportLectureExcel(){

    }
    //导出担任团体职务Excel表格
    public function exportDutiesExcel(){

    }
    //导出校发文件Excel表格
    public function exportSchoolFileExcel(){

    }
    //导出合作协议Excel表格
    public function exportAgreementExcel(){

    }

}