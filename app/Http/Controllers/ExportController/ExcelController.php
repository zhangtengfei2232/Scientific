<?php
namespace App\Http\Controllers\ExportController;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Excel;
class ExcelController extends Controller
{
    //导出Excel表格
    public function exportExcel(){
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
        return json_encode('导出成功');
    }
}