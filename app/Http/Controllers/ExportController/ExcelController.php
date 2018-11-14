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
             '所属项目','研究类别','学科门类','积分','学校认定刊物级别','发表时间','备注']
        ];
        $art_id_datas       = $request->art_id_datas;
        $artical_table_name = SearchMessageConfig::ARTICAL_TABLE;
        $artical_id_field   = SearchMessageConfig::ARTICAL_ID;
        $artical_datas      = ModelDatabase::selectExportExcelDatas($artical_table_name,$artical_id_field,$art_id_datas);
        foreach ($artical_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->author,
                $datas->art_all_author,
                $datas->title,
                $datas->publication_name,
                $datas->publication_num,
                $datas->period,
                $datas->num_words,
                $datas->percal_cate,
                $datas->belong_project,
                SearchMessageConfig::CATE_RESEARCH_DATAS[$datas->art_cate_research],
                SearchMessageConfig::SUB_CATEGORY_DATAS[$datas->art_sub_category],
                $datas->art_integral,
                $datas->sch_percal_cate,
                date('Y-m-d',$datas->art_time),
                $datas->art_remarks
            ];
        }
        Excel::create('论文信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('论文',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出项目Excel表格
    public function exportProjectExcel(Request $request){
        $cell_datas = [
            ['序号','主持人','所有参加人','项目名称','项目类别','批准单位','批准经费','当年到账经费','研究类别',
                '学科门类','合作形式','社会经济目标','服务的国民经济行业','积分','备注']
        ];
        $pro_id_datas       = $request->pro_id_datas;
        $project_table_name = SearchMessageConfig::PROJECT_TABLE;
        $project_id_field   = SearchMessageConfig::PROJECT_ID;
        $project_datas      = ModelDatabase::selectExportExcelDatas($project_table_name,$project_id_field,$pro_id_datas);
        foreach ($project_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->pro_host,
                $datas->pro_all_author,
                $datas->title,
                $datas->entry_name,
                $datas->project_category,
                $datas->approval_unit,
                $datas->approval_funds,
                $datas->account_outlay,
                SearchMessageConfig::PROJECT_PRO_CATE_RESEARCH[$datas->pro_cate_research],
                SearchMessageConfig::SUB_CATEGORY_DATAS[$datas->pro_sub_category],
                SearchMessageConfig::PRO_FORM_COOPERATE_DATAS[$datas->form_cooperate],
                $datas->social_eco_goal,
                $datas->na_eco_industry,
                $datas->pro_integral,
                date('Y-m-d',$datas->project_year),
                $datas->pro_remarks
            ];
        }
        Excel::create('项目信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('项目',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出著作Excel表格
    public function exportOpusExcel(Request $request){
        $cell_datas = [
            ['序号','第一作者','全部作者','著作名称','编著形式','出版社','出版时间','书号','总字数',
                '本人字数','著作类别','积分','研究类别','学科门类','备注']
        ];
        $op_id_datas     = $request->op_id_datas;
        $opus_table_name = SearchMessageConfig::OPUS_TABLE;
        $opus_id_field   = SearchMessageConfig::OPUS_ID;
        $opus_datas      = ModelDatabase::selectExportExcelDatas($opus_table_name,$opus_id_field,$op_id_datas);
        foreach ($opus_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->op_first_author,
                $datas->op_all_author,
                $datas->op_name,
                $datas->op_form_write,
                $datas->op_publish,
                date('Y-m-d',$datas->op_publish_time),
                $datas->op_number,
                $datas->op_total_words,
                $datas->op_self_words,
                SearchMessageConfig::OP_CATE_WORK_DATAS[$datas->op_cate_work],
                $datas->op_integral,
                SearchMessageConfig::CATE_RESEARCH_DATAS[$datas->op_cate_research],
                SearchMessageConfig::SUB_CATEGORY_DATAS[$datas->op_sub_category],
                $datas->op_remarks
            ];
        }
        Excel::create('著作信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('著作',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出获奖Excel表格
    public function exportAwardExcel(Request $request){
        $cell_datas = [
            ['序号','第一获奖人','全部获奖人','获奖成果名称','奖励名称','成果形式','奖励级别','等级','授奖单位',
                '授奖时间','证书编号','我校名次','积分']
        ];
        $aw_id_datas      = $request->aw_id_datas;
        $award_table_name = SearchMessageConfig::AWARD_TABLE;
        $award_id_field   = SearchMessageConfig::AWARD_ID;
        $award_datas      = ModelDatabase::selectExportExcelDatas($award_table_name,$award_id_field,$aw_id_datas);
        foreach ($award_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->aw_first_author,
                $datas->aw_all_author,
                $datas->prize_win_name,
                $datas->award_name,
                SearchMessageConfig::AW_FORM_ACHIEVEMENT_DATAS[$datas->form_achievement],
                SearchMessageConfig::AW_LEVEL_DATAS[$datas->aw_level],
                SearchMessageConfig::AW_GRADE_DATAS[$datas->aw_grade],
                $datas->aw_grant_unit,
                date('Y-m-d',$datas->aw_grant_time),
                $datas->aw_certi_number,
                $datas->aw_sch_rank,
                $datas->aw_integral,
            ];
        }
        Excel::create('获奖信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('获奖',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出专利Excel表格
    public function exportPatentExcel(Request $request){
        $cell_datas = [
            ['序号','专利权人','第一发明人','全部发明人','专利类型','专利名称','实施情况','授权编号或申请号','授权证书编号',
                '授权公告日或受理日期','积分','备注']
        ];
        $pa_id_datas        = $request->pa_id_datas;
        $patent_table_name  = SearchMessageConfig::AWARD_TABLE;
        $patent_id_field    = SearchMessageConfig::AWARD_ID;
        $patent_datas       = ModelDatabase::selectExportExcelDatas($patent_table_name,$patent_id_field,$pa_id_datas);
        foreach ($patent_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->patent_person,
                $datas->first_inventor,
                $datas->pa_all_author,
                SearchMessageConfig::PA_TYPE_DATAS[$datas->pa_type],
                $datas->pa_name,
                SearchMessageConfig::PA_IMPLE_SITU_DATAS[$datas->pa_imple_situ],
                $datas->author_num,
                $datas->author_cert_num,
                date('Y-m-d',$datas->author_notic_day),
                $datas->pa_integral,
                $datas->pa_remarks,
            ];
        }
        Excel::create('专利信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('专利',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出成果鉴定Excel表格
    public function exportAppraisalExcel(Request $request){
        $cell_datas = [
            ['序号','主持人','全部完成(参与)人','鉴定成果报告','鉴定形式','鉴定编号','鉴定结论','鉴定时间','鉴定级别','积分','备注']
        ];
        $ap_id_datas          = $request->ap_id_datas;
        $appraisal_table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $appraisal_id_field   = SearchMessageConfig::APPRAISAL_ID;
        $appraisal_datas      = ModelDatabase::selectExportExcelDatas($appraisal_table_name,$appraisal_id_field,$ap_id_datas);
        foreach ($appraisal_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->ap_first_author,
                $datas->ap_all_author,
                $datas->ap_res_name,
                $datas->ap_form,
                $datas->ap_num,
                $datas->ap_conclusion,
                date('Y-m-d',$datas->ap_time),
                SearchMessageConfig::AP_LEVEL_DATAS[$datas->ap_level],
                $datas->ap_integral,
                $datas->ap_remarks
            ];
        }
        Excel::create('成果鉴定信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('成果鉴定',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出举行会议Excel表格
    public function exportHoldmeetExcel(Request $request){
        $cell_datas = [
            ['序号','学术会议名称','有无论文集','参加人数','主办单位','承办单位','会议级别','会议时间']
        ];
        $ho_id_datas         = $request->ap_id_datas;
        $holdmeet_table_name = SearchMessageConfig::HOLD_MEET_TABLE;
        $holdmeet_id_field   = SearchMessageConfig::HOLDMEET_ID;
        $holdmeet_datas      = ModelDatabase::selectExportExcelDatas($holdmeet_table_name,$holdmeet_id_field,$ho_id_datas);
        foreach ($holdmeet_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->ho_name,
                SearchMessageConfig::HO_ART_STATUS_DATAS[$datas->ho_art_status],
                $datas->people_num,
                $datas->ho_unit,
                $datas->undertake_unit,
                SearchMessageConfig::MEETING_LEVEL_DATAS[$datas->ho_level],
                date('Y-m-d',$datas->ho_time),
            ];
        }
        Excel::create('举办会议信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('举办会议',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出参加会议Excel表格
    public function exportJoinmeetExcel(Request $request){
        $cell_datas = [
            ['序号','参会人','学术会议名称','主办单位','承办单位','会议级别','会议时间','会议地点','提交论文数',
                '是否被邀大会或分会场报告','报告题目']
        ];
        $jo_id_datas         = $request->ap_id_datas;
        $joinmeet_table_name = SearchMessageConfig::JOIN_MEET_TABLE;
        $joinmeet_id_field   = SearchMessageConfig::JOINMEET_ID;
        $joinmeet_datas      = ModelDatabase::selectExportExcelDatas($joinmeet_table_name,$joinmeet_id_field,$jo_id_datas);
        foreach ($joinmeet_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->join_people,
                $datas->jo_name,
                $datas->jo_hold_unit,
                $datas->jo_take_unit,
                SearchMessageConfig::MEETING_LEVEL_DATAS[$datas->jo_level],
                date('Y-m-d',$datas->jo_time),
                $datas->jo_place,
                $datas->jo_art_num,
                $datas->jo_is_invite,
                $datas->jo_title
            ];
        }
        Excel::create('参加会议信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('参加会议',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出讲学Excel表格
    public function exportLectureExcel(Request $request){
        $cell_datas = [
            ['序号','专家姓名','专家级别','报告名称','邀请/被邀','邀请单位','讲学时间']
        ];
        $le_id_datas        = $request->le_id_datas;
        $lecture_table_name = SearchMessageConfig::LECTURE_TABLE;
        $lecture_id_field   = SearchMessageConfig::LECTURE_ID;
        $lecture_datas      = ModelDatabase::selectExportExcelDatas($lecture_table_name,$lecture_id_field,$le_id_datas);
        foreach ($lecture_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->le_expert_name,
                SearchMessageConfig::LE_EXPERT_LEVEL_DATAS[$datas->le_expert_level],
                $datas->le_report_name,
                SearchMessageConfig::LE_INVITE_STATUS_DATAS[$datas->le_invite_status],
                $datas->le_invite_unit,
                date('Y-m-d',$datas->le_time)
            ];
        }
        Excel::create('专家讲学信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('专家讲学',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出担任团体职务Excel表格
    public function exportDutiesExcel(Request $request){
        $cell_datas = [
            ['序号','姓名','职称','学历','学位','年龄','担任学术团体名称','所任职务','担任职务年限','备注']
        ];
        $du_id_datas       = $request->du_id_datas;
        $duties_table_name = SearchMessageConfig::LECTURE_TABLE;
        $duties_id_field   = SearchMessageConfig::LECTURE_ID;
        $duties_datas      = ModelDatabase::selectExportExcelDatas($duties_table_name,$duties_id_field,$du_id_datas);
        foreach ($duties_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->teacher_name,
                SearchMessageConfig::ACADEMIC_DATAS[$datas->du_academic],
                $datas->le_report_name,
                SearchMessageConfig::LE_INVITE_STATUS_DATAS[$datas->le_invite_status],
                $datas->le_invite_unit,
                date('Y-m-d',$datas->le_time)
            ];
        }
        Excel::create('专家讲学信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('专家讲学',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');
    }
    //导出校发文件Excel表格
    public function exportSchoolFileExcel(Request $request){
        $cell_datas = [
            ['序号','名称','编号','文件下发时间']
        ];
        $schfile_id_datas  = $request->schfile__id_datas;
        $school_file_table_name = SearchMessageConfig::SCHOOL_FILE_TABLE;
        $school_file_id_field   = SearchMessageConfig::SCHOOLFILE_ID;
        $school_file_datas      = ModelDatabase::selectExportExcelDatas($school_file_table_name,$school_file_id_field,$schfile_id_datas);
        foreach ($school_file_datas as $datas){
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->schfile_name,
                $datas->schfile_num,
                date('Y-m-d',$datas->schfile_down_time)
            ];
        }
        Excel::create('校发文件信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('校发文件',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xls');
        return responseTojson(0,'导出成功');

    }
    //导出合作协议Excel表格
    public function exportAgreementExcel(){

    }

}