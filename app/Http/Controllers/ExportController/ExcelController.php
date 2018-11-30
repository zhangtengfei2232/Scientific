<?php
namespace App\Http\Controllers\ExportController;

use App\Http\Controllers\Controller;
use App\Model\ModelDatabase;
use config\SearchMessageConfig;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ExcelController extends Controller
{
    //导出表格序号
    private $serial_number = 0;
    //设置老师所在部门单元格,累加器
    private $count_table_list = 0;
    private $date_formate = 'Y年-m月-d日';

    //导出老师信息EXCEL表格
    public function exportTeacherExcel(Request $request){
        $teacher_information = [[],[],[],[],[],[]];
        $department_count = [];
        $teacher_cell_datas = SearchMessageConfig::TEACHER_CELL_DATAS;
        $tea_id_datas       = explode(',',$request->tea_id_datas);
        $teacher_table_name = SearchMessageConfig::TEACHER_TABLE;
        $teacher_id_field   = SearchMessageConfig::TEACHER_ID;
        $teacher_datas      = ModelDatabase::selectExportExcelDatas($teacher_table_name,$teacher_id_field,$tea_id_datas);
        foreach ($teacher_datas as $information){
            switch ($information->teacher_department){
                case 0:
                    array_push($teacher_information[0],$information);
                    break;
                case 1:
                    array_push($teacher_information[1],$information);
                    break;
                case 2:
                    array_push($teacher_information[2],$information);
                    break;
                case 3:
                    array_push($teacher_information[3],$information);
                    break;
                case 4:
                    array_push($teacher_information[4],$information);
                    break;
                case 5:
                    array_push($teacher_information[5],$information);
                    break;
            }
        }
        for ($i = 0; $i < count($teacher_information); $i++){
            $count = count($teacher_information[$i]);  //统计每个部门的老师个数是否大于1
            if($count > 0){
                array_push($department_count,$count);
                for($j = 0; $j < count($teacher_information[$i]); $j++){
                    ++$this->serial_number;   //序号
                    $teacher_cell_datas[] = [
                        $this->serial_number,
                        SearchMessageConfig::TEACHER_DEPARTMENT[$teacher_information[$i][$j]->teacher_department],
                        $teacher_information[$i][$j]->name,
                        $teacher_information[$i][$j]->office_phone,
                        $teacher_information[$i][$j]->home_phone,
                        $teacher_information[$i][$j]->phone,
                        $teacher_information[$i][$j]->number,
                        SearchMessageConfig::SEX_DATAS[$teacher_information[$i][$j]->sex],
                        $teacher_information[$i][$j]->nation,
                        date($this->date_formate,$teacher_information[$i][$j]->borth/1000),
                        SearchMessageConfig::TEA_POLIT_OUTLOOK_DATAS[$teacher_information[$i][$j]->polit_outlook],
                        $teacher_information[$i][$j]->native_place,
                        SearchMessageConfig::TEA_ADMIN_DUTIES_DATAS[$teacher_information[$i][$j]->admin_duties],
                        date($this->date_formate,$teacher_information[$i][$j]->admin_tenure_time/1000),
                        SearchMessageConfig::TEA_JOB_LEVEL_DATAS[ $teacher_information[$i][$j]->job_level],
                        SearchMessageConfig::TEA_TECHNICAL_POSITION[$teacher_information[$i][$j]->technical_position],
                        SearchMessageConfig::ACADEMIC_DATAS[$teacher_information[$i][$j]->academic_title],
                        date($this->date_formate,$teacher_information[$i][$j]->review_time/1000),
                        date($this->date_formate,$teacher_information[$i][$j]->appointment_time/1000),
                        $teacher_information[$i][$j]->series,
                        $teacher_information[$i][$j]->company,
                        $teacher_information[$i][$j]->te_re_department,
                        date($this->date_formate,$teacher_information[$i][$j]->working_hours/1000),
                        $teacher_information[$i][$j]->origin_work_unit,
                        $teacher_information[$i][$j]->certificate_num,
                        $teacher_information[$i][$j]->identity_card,
                        $teacher_information[$i][$j]->edu_school,
                        SearchMessageConfig::TEA_FIRST_ACADEMIC_DATAS[$teacher_information[$i][$j]->first_academic],
                        $teacher_information[$i][$j]->first_graduate_school,
                        $teacher_information[$i][$j]->first_study_major,
                        date($this->date_formate,$teacher_information[$i][$j]->first_graduation_time/1000),
                        SearchMessageConfig::TEA_MOST_ACADEMIC_DATAS[$teacher_information[$i][$j]->most_academic],
                        $teacher_information[$i][$j]->most_graduate_school,
                        $teacher_information[$i][$j]->most_study_major,
                        date($this->date_formate,$teacher_information[$i][$j]->working_hours/1000),
                        $teacher_information[$i][$j]->work_major,
                        $teacher_information[$i][$j]->belong_subject,
                        $teacher_information[$i][$j]->teach_course,
                        $teacher_information[$i][$j]->master_company,
                        date($this->date_formate,$teacher_information[$i][$j]->master_time/1000)
                    ];
                }
            }
        }
        $new_teacher_cell_datas = [$department_count,$teacher_cell_datas];
        Excel::create('老师信息',function ($excel) use ($new_teacher_cell_datas){
            $excel->sheet('生命科技学院教工信息表',function ($sheet) use ($new_teacher_cell_datas){
                $sheet->rows($new_teacher_cell_datas[1]);
                for($i = 0; $i < 40;$i++){
                    if($i < 27 || ($i > 34 && $i < 38)){
                        //前26个表格单元格格式，合并每一列的前两行
                        $table_list = intToChr($i);
                        $sheet->mergeCells($table_list.'1:'.$table_list.'2');
                    }elseif ($i == 27){
                        //设置老师的第一学历和最高学历单元格格式
                        $sheet->mergeCells(intToChr($i).'1:'.intToChr($i + 3).'1');
                        $sheet->mergeCells(intToChr($i + 4).'1:'.intToChr($i + 7).'1');
                        $i += 7;  //跳格
                    }elseif($i == 38){
                        //设置老师的硕(博)导的单元格格式
                        $sheet->mergeCells(intToChr($i).'1:'.intToChr($i + 1).'1');
                    }
                }
                //设置老师所在部门单元格格式
                for($k = 0; $k < count($new_teacher_cell_datas[0]); $k++){
                    if($k != 0){
                        $sheet->mergeCells('B'.$this->count_table_list.':B'.($this->count_table_list + $new_teacher_cell_datas[0][$k] - 1));
                    }else{
                        $sheet->mergeCells('B3:B'.($new_teacher_cell_datas[0][$k] + 2));
                        $new_teacher_cell_datas[0][$k] = $new_teacher_cell_datas[0][$k] + 3;//第一次比较特殊，需要 + 3
                    }
                    $this->count_table_list += $new_teacher_cell_datas[0][$k]; //从下一行开始，设置单元格格式
                }
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出论文Excel表格
    public function exportArticalExcel(Request $request){
        $artical_cell_datas = SearchMessageConfig::ARTICAL_CELL_DATAS;
        $art_id_datas       = explode(',',$request->art_id_datas);
        $artical_table_name = SearchMessageConfig::ARTICAL_TABLE;
        $artical_id_field   = SearchMessageConfig::ARTICAL_ID;
        $artical_datas      = ModelDatabase::selectExportExcelDatas($artical_table_name,$artical_id_field,$art_id_datas);
        foreach ($artical_datas as $datas){
            ++$this->serial_number;//序号
            $artical_cell_datas[] = [
                $this->serial_number,
                $datas->author,
                $datas->art_all_author,
                $datas->title,
                $datas->publication_name,
                $datas->publication_num,
                $datas->period,
                $datas->num_words,
                SearchMessageConfig::ARTI_PERCAL_CATE_DATAS[$datas->percal_cate],
                $datas->belong_project,
                SearchMessageConfig::CATE_RESEARCH_DATAS[$datas->art_cate_research],
                SearchMessageConfig::SUB_CATEGORY_DATAS[$datas->art_sub_category],
                $datas->art_integral,
                $datas->sch_percal_cate,
                date($this->date_formate,$datas->art_time/1000),
                $datas->art_remarks
            ];
        }
        Excel::create('论文信息数据',function ($excel) use ($artical_cell_datas){
            $excel->sheet('论文',function ($sheet) use ($artical_cell_datas){
                $sheet->rows($artical_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出项目Excel表格
    public function exportProjectExcel(Request $request){
        $project_cell_datas = SearchMessageConfig::PROJECT_CELL_DATAS;
        $pro_id_datas       = explode(',',$request->pro_id_datas);
        $project_table_name = SearchMessageConfig::PROJECT_TABLE;
        $project_id_field   = SearchMessageConfig::PROJECT_ID;
        $project_datas      = ModelDatabase::selectExportExcelDatas($project_table_name,$project_id_field,$pro_id_datas);
        foreach ($project_datas as $datas){
            ++$this->serial_number;//序号
            $project_cell_datas[] = [
                $this->serial_number,
                $datas->pro_host,
                $datas->pro_all_author,
                $datas->entry_name,
                $datas->project_category,
                $datas->approval_unit,
                $datas->approval_funds,
                $datas->account_outlay,
                SearchMessageConfig::PROJECT_LEVEL_DATAS[$datas->pro_level],
                SearchMessageConfig::PRO_PRO_CATE_RESEARCH_DATAS[$datas->pro_cate_research],
                SearchMessageConfig::SUB_CATEGORY_DATAS[$datas->pro_sub_category],
                SearchMessageConfig::PRO_FORM_COOPERATE_DATAS[$datas->form_cooperate],
                $datas->social_eco_goal,
                $datas->na_eco_industry,
                $datas->pro_integral,
                date($this->date_formate,$datas->project_year/1000),
                $datas->pro_remarks
            ];
        }
        Excel::create('项目信息数据',function ($excel) use ($project_cell_datas){
            $excel->sheet('项目',function ($sheet) use ($project_cell_datas){
                $sheet->rows($project_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出著作Excel表格
    public function exportOpusExcel(Request $request){
        $opus_cell_datas = SearchMessageConfig::OPUS_CELL_DATAS;
        $op_id_datas     = explode(',',$request->op_id_datas);
        $opus_table_name = SearchMessageConfig::OPUS_TABLE;
        $opus_id_field   = SearchMessageConfig::OPUS_ID;
        $opus_datas      = ModelDatabase::selectExportExcelDatas($opus_table_name,$opus_id_field,$op_id_datas);
        foreach ($opus_datas as $datas){
            ++$this->serial_number;//序号
            $opus_cell_datas[] = [
                $this->serial_number,
                $datas->op_first_author,
                $datas->op_all_author,
                $datas->op_name,
                SearchMessageConfig::OP_FORM_WRITE_DATAS[$datas->op_form_write],
                $datas->op_publish,
                date($this->date_formate,$datas->op_publish_time/1000),
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
        Excel::create('著作信息数据',function ($excel) use ($opus_cell_datas){
            $excel->sheet('著作',function ($sheet) use ($opus_cell_datas){
                $sheet->rows($opus_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出获奖Excel表格
    public function exportAwardExcel(Request $request){
        $award_cell_datas = SearchMessageConfig::AWARD_CELL_DATAS;
        $aw_id_datas      = explode(',',$request->aw_id_datas);
        $award_table_name = SearchMessageConfig::AWARD_TABLE;
        $award_id_field   = SearchMessageConfig::AWARD_ID;
        $award_datas      = ModelDatabase::selectExportExcelDatas($award_table_name,$award_id_field,$aw_id_datas);
        foreach ($award_datas as $datas){
            ++$this->serial_number;//序号
            $award_cell_datas[] = [
                $this->serial_number,
                $datas->aw_first_author,
                $datas->aw_all_author,
                $datas->prize_win_name,
                $datas->award_name,
                SearchMessageConfig::AW_FORM_ACHIEVEMENT_DATAS[$datas->form_achievement],
                SearchMessageConfig::AW_LEVEL_DATAS[$datas->aw_level],
                SearchMessageConfig::AW_GRADE_DATAS[$datas->aw_grade],
                $datas->aw_grant_unit,
                date($this->date_formate,$datas->aw_grant_time/1000),
                $datas->aw_certi_number,
                $datas->aw_sch_rank,
                $datas->aw_integral,
            ];
        }
        Excel::create('获奖信息数据',function ($excel) use ($award_cell_datas){
            $excel->sheet('获奖',function ($sheet) use ($award_cell_datas){
                $sheet->rows($award_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出专利Excel表格
    public function exportPatentExcel(Request $request){
        $patent_cell_datas  = SearchMessageConfig::PATENT_CELL_DATAS;
        $pa_id_datas        = explode(',',$request->pa_id_datas);
        $patent_table_name  = SearchMessageConfig::PATENT_TABLE;
        $patent_id_field    = SearchMessageConfig::PATENT;
        $patent_datas       = ModelDatabase::selectExportExcelDatas($patent_table_name,$patent_id_field,$pa_id_datas);
        foreach ($patent_datas as $datas){
            ++$this->serial_number;//序号
            $patent_cell_datas[] = [
                $this->serial_number,
                $datas->patent_person,
                $datas->first_inventor,
                $datas->pa_all_author,
                SearchMessageConfig::PA_TYPE_DATAS[$datas->pa_type],
                $datas->pa_name,
                SearchMessageConfig::PA_IMPLE_SITU_DATAS[$datas->pa_imple_situ],
                $datas->author_num,
                $datas->author_cert_num,
                date($this->date_formate,$datas->author_notic_day/1000),
                $datas->pa_integral,
                $datas->pa_remarks
            ];
        }
        Excel::create('专利信息数据',function ($excel) use ($patent_cell_datas){
            $excel->sheet('专利',function ($sheet) use ($patent_cell_datas){
                $sheet->rows($patent_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出成果鉴定Excel表格
    public function exportAppraisalExcel(Request $request){
        $appraisal_cell_datas = SearchMessageConfig::APPRAISAL_CELL_DATAS;
        $ap_id_datas          = explode(',',$request->ap_id_datas);
        $appraisal_table_name = SearchMessageConfig::APPRAISAL_TABLE;
        $appraisal_id_field   = SearchMessageConfig::APPRAISAL_ID;
        $appraisal_datas      = ModelDatabase::selectExportExcelDatas($appraisal_table_name,$appraisal_id_field,$ap_id_datas);
        foreach ($appraisal_datas as $datas){
            ++$this->serial_number;//序号
            $appraisal_cell_datas[] = [
                $this->serial_number,
                $datas->ap_first_author,
                $datas->ap_all_author,
                $datas->ap_res_name,
                $datas->ap_form,
                $datas->ap_num,
                $datas->ap_conclusion,
                date($this->date_formate,$datas->ap_time/1000),
                SearchMessageConfig::AP_LEVEL_DATAS[$datas->ap_level],
                $datas->ap_integral,
                $datas->ap_remarks
            ];
        }
        Excel::create('成果鉴定信息数据',function ($excel) use ($appraisal_cell_datas){
            $excel->sheet('成果鉴定',function ($sheet) use ($appraisal_cell_datas){
                $sheet->rows($appraisal_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出举行会议Excel表格
    public function exportHoldmeetExcel(Request $request){
        $holdmeet_cell_datas = SearchMessageConfig::HOLDMEET_CELL_DATAS;
        $ho_id_datas         = explode(',',$request->ho_id_datas);
        $holdmeet_table_name = SearchMessageConfig::HOLD_MEET_TABLE;
        $holdmeet_id_field   = SearchMessageConfig::HOLDMEET_ID;
        $holdmeet_datas      = ModelDatabase::selectExportExcelDatas($holdmeet_table_name,$holdmeet_id_field,$ho_id_datas);
        foreach ($holdmeet_datas as $datas){
            ++$this->serial_number;//序号
            $holdmeet_cell_datas[] = [
                $this->serial_number,
                $datas->ho_name,
                SearchMessageConfig::HO_ART_STATUS_DATAS[$datas->ho_art_status],
                $datas->people_num,
                $datas->ho_unit,
                $datas->undertake_unit,
                SearchMessageConfig::MEETING_LEVEL_DATAS[$datas->ho_level],
                date($this->date_formate,$datas->ho_time/1000),
            ];
        }
        Excel::create('举办会议信息数据',function ($excel) use ($holdmeet_cell_datas){
            $excel->sheet('举办会议',function ($sheet) use ($holdmeet_cell_datas){
                $sheet->rows($holdmeet_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出参加会议Excel表格
    public function exportJoinmeetExcel(Request $request){
        $joinmeet_cell_datas = SearchMessageConfig::JOINMEET_CELL_DATAS;
        $jo_id_datas         = explode(',',$request->jo_id_datas);
        $joinmeet_table_name = SearchMessageConfig::JOIN_MEET_TABLE;
        $joinmeet_id_field   = SearchMessageConfig::JOINMEET_ID;
        $joinmeet_datas      = ModelDatabase::selectExportExcelDatas($joinmeet_table_name,$joinmeet_id_field,$jo_id_datas);
        foreach($joinmeet_datas as $datas){
            ++$this->serial_number;//序号
            $joinmeet_cell_datas[] = [
                $this->serial_number,
                $datas->join_people,
                $datas->jo_name,
                $datas->jo_hold_unit,
                $datas->jo_take_unit,
                SearchMessageConfig::MEETING_LEVEL_DATAS[$datas->jo_level],
                date($this->date_formate,$datas->jo_time/1000),
                $datas->jo_place,
                $datas->jo_art_num,
                $datas->jo_is_invite,
                $datas->jo_title
            ];
        }
        Excel::create('参加会议信息数据',function ($excel) use ($joinmeet_cell_datas){
            $excel->sheet('参加会议',function ($sheet) use ($joinmeet_cell_datas){
                $sheet->rows($joinmeet_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出讲学Excel表格
    public function exportLectureExcel(Request $request){
        $lecture_cell_datas = SearchMessageConfig::LECTURE_CELL_DATAS;
        $le_id_datas        = explode(',',$request->le_id_datas);
        $lecture_table_name = SearchMessageConfig::LECTURE_TABLE;
        $lecture_id_field   = SearchMessageConfig::LECTURE_ID;
        $lecture_datas      = ModelDatabase::selectExportExcelDatas($lecture_table_name,$lecture_id_field,$le_id_datas);
        foreach ($lecture_datas as $datas){
            ++$this->serial_number;//序号
            $lecture_cell_datas[] = [
                $this->serial_number,
                $datas->le_expert_name,
                SearchMessageConfig::LE_EXPERT_LEVEL_DATAS[$datas->le_expert_level],
                $datas->le_report_name,
                SearchMessageConfig::LE_INVITE_STATUS_DATAS[$datas->le_invite_status],
                $datas->le_invite_unit,
                date($this->date_formate,$datas->le_time/1000)
            ];
        }
        Excel::create('专家讲学信息数据',function ($excel) use ($lecture_cell_datas){
            $excel->sheet('专家讲学',function ($sheet) use ($lecture_cell_datas){
                $sheet->rows($lecture_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出担任团体职务Excel表格
    public function exportDutiesExcel(Request $request){
        $cell_datas = [
            ['序号','姓名','职称','学历','学位','年龄','担任学术团体名称','所任职务','担任职务年限','备注']
        ];
        $du_id_datas       = explode(',',$request->du_id_datas);
        $duties_table_name = SearchMessageConfig::DUTIES_TABLE;
        $duties_id_field   = SearchMessageConfig::DUTIES_ID;
        $duties_datas      = ModelDatabase::selectExportExcelDatas($duties_table_name,$duties_id_field,$du_id_datas);
        foreach($duties_datas as $datas){
            $duties_time = explode(',', $datas->du_year_num);
            ++$this->serial_number;//序号
            $cell_datas[] = [
                $this->serial_number,
                $datas->teacher_name,
                SearchMessageConfig::ACADEMIC_DATAS[$datas->du_academic],
                SearchMessageConfig::DU_EDUCATION_DATAS[$datas->du_education],
                SearchMessageConfig::DU_DEGREE_DATAS[$datas->du_degree],
                $datas->du_age,
                $datas->du_name,
                $datas->du_duty,
                date($this->date_formate,$duties_time[0]/1000).'——'.date($this->date_formate,$duties_time[1]/1000),
                $datas->du_remark
            ];
        }
        Excel::create('担任学术团体信息数据',function ($excel) use ($cell_datas){
            $excel->sheet('担任学术团体',function ($sheet) use ($cell_datas){
                $sheet->rows($cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出校发文件Excel表格
    public function exportSchoolFileExcel(Request $request){
        $school_file_cell_datas = SearchMessageConfig::SCHOOL_FILE_CELL_DATAS;
        $schfile_id_datas       = explode(',',$request->schfile_id_datas);
        $school_file_table_name = SearchMessageConfig::SCHOOL_FILE_TABLE;
        $school_file_id_field   = SearchMessageConfig::SCHOOLFILE_ID;
        $school_file_datas      = ModelDatabase::selectExportExcelDatas($school_file_table_name,$school_file_id_field,$schfile_id_datas);
        foreach($school_file_datas as $datas){
            ++$this->serial_number;//序号
            $school_file_cell_datas[] = [
                $this->serial_number,
                $datas->schfile_name,
                $datas->schfile_num,
                date($this->date_formate,$datas->schfile_down_time/1000)
            ];
        }
        Excel::create('校发文件信息数据',function ($excel) use ($school_file_cell_datas){
            $excel->sheet('校发文件',function ($sheet) use ($school_file_cell_datas){
                $sheet->rows($school_file_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
    //导出合作协议Excel表格
    public function exportAgreementExcel(Request $request){
        $agreement_cell_datas = SearchMessageConfig::AGREEMENT_CELL_DATAS;
        $agree_id_id_datas    = explode(',',$request->agree_id_datas);
        $agreement_table_name = SearchMessageConfig::AGREEMENT_TABLE;
        $agreement_id_field   = SearchMessageConfig::AGREEMENT_ID;
        $agreement_datas      = ModelDatabase::selectExportExcelDatas($agreement_table_name,$agreement_id_field,$agree_id_id_datas);
        foreach($agreement_datas as $datas){
            ++$this->serial_number;//序号
            $agreement_cell_datas[] = [
                $this->serial_number,
                $datas->agree_name,
                $datas->agree_cooperate_unit,
                date($this->date_formate,$datas->agree_time/1000)
            ];
        }
        Excel::create('教学科研等合作协议信息数据',function ($excel) use ($agreement_cell_datas){
            $excel->sheet('教学科研等合作协议',function ($sheet) use ($agreement_cell_datas){
                $sheet->rows($agreement_cell_datas);
            });
        })->export('xlsx');
        return responseTojson(0,'导出成功');
    }
}