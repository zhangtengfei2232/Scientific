<?php
namespace App\Http\Controllers\ScientificController;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //添加项目信息
    public function addProject()
    {

    }
    //删除项目信息
    public function deleteProject()
    {

    }
    //查看项目信息
    public function selectProject()
    {

    }
    //修改项目信息
    public function updateProject(Request $request)
    {
        $entry_name        = trim($request->entry_name);
        $pro_remarks       = trim($request->pro_remarks);
        $na_eco_industry   = trim($request->na_eco_industry);
        $pro_sub_category  = trim($request->pro_sub_category);
        $project_year      = trim($request->project_year);
        $approval_unit     = trim($request->approval_unit);
        $approval_funds    = trim($request->approval_funds);
        $account_outlay    = trim($request->account_outlay);
        $pro_host          = trim($request->pro_host);
        $pro_integral      = trim($request->pro_integral);
        $form_cooperate    = trim($request->form_cooperate);
        $pro_all_author    = trim($request->pro_all_author);
        $social_eco_goal   = trim($request->social_eco_goal);
        $pro_cate_research = trim($request->pro_cate_research);
        $pro_cate_research = trim($request->pro_cate_research);
    }
}