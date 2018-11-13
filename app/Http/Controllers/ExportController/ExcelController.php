<?php
namespace App\Http\Controllers\ExportController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use config\SearchMessageConfig;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
class ExcelController extends Controller
{
    private $serial_number = 0;
    //导出论文Excel表格
    public function exportArticalExcel(Request $request){
        $cell_datas = [
            ['序号','第一作者或通讯作者','全部作者','论文题目','发表刊物名称','刊号','年,卷(期)','字数','期刊级别',
             '所属项目','研究类别','学科门类','积分','学校认定刊物级别','发表时间']
        ];
        $art_id_datas       = $request->art_id_datas;
        $artical_table_name = SearchMessageConfig::ARTICAL_TABLE;
        $artical_id_field   = SearchMessageConfig::ARTICAL_ID;
        $artical_datas      = ModelDatabase::selectExportExcelDatas($artical_table_name,$artical_id_field,$art_id_datas);
        foreach ($artical_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $datas->author,
                $datas->art_all_author,
                $datas->title,
                $datas->publication_name,
                $datas->publication_num,
                $datas->period,
                $datas->num_words,
                $datas->percal_cate,
                $datas->belong_project,
                SearchMessageConfig::ART_CATE_RESEARCH_DATAS[$datas->art_cate_research],
                SearchMessageConfig::ART_SUB_CATEGORY_DATAS[$datas->art_sub_category],
                $datas->art_integral,
                $datas->sch_percal_cate,
                date('Y-m-d',$datas->art_time)
            ];
        }
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