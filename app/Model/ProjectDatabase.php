<?php
namespace App\Model;



use Illuminate\Support\Facades\DB;

class ProjectDatabase extends ModelDatabase
{
    //添加项目信息
    public static function addProjectDatas($datas){
        $response = DB::table('project')
            ->insert([
                'teacher_id'        => $datas->teacher_id,
                'pro_host'          => $datas->pro_host,
                'pro_all_author'    => $datas->pro_all_author,
                'entry_name'        => $datas->entry_name,
                'project_category'  => $datas->project_category,
                'approval_unit'     => $datas->approval_unit,
                'approval_funds'    => $datas->approval_funds,
                'account_outlay'    => $datas->account_outlay,
                'pro_cate_research' => $datas->pro_cate_research,
                'pro_sub_category'  => $datas->pro_sub_category,
                'form_cooperate'    => $datas->form_cooperate,
                'social_eco_goal'   => $datas->social_eco_goal,
                'na_eco_industry'   => $datas->na_eco_industry,
                'pro_integral'      => $datas->pro_integral,
                'pro_road'          => $datas->pro_road,
                'project_year'      => $datas->project_year,
                'pro_remarks'        => $datas->pro_remarks
            ]);
        return $response;
    }
    //删除项目信息
    public static function delectProjectDatas(){

    }
    //查找单个项目信息
    public static function selectProjectDatas($project_id){
      $result = DB::table('project')->where('pro_id',$project_id)->get();
      $result->project_year = date('Y-m-d',$result->project_year);
      return $result;
    }
    //查找所有项目信息
    public static function selectAllProjectDatas($teacher_id){
      $result = DB::table('project')->where('teacher_id',$teacher_id)->get();
      foreach ($result as $datas){
          $result->project_year = date('Y-m-d',$datas->project_year);
      }
      return $result;
    }
    //修改老师项目和项目合同信息
    public static function updateProjectImage($datas){
        $response = DB::table('project')->where('pro_id',$datas->pro_id)
                  ->update([
                      'pro_host'          => $datas->pro_host,
                      'pro_all_author'    => $datas->pro_all_author,
                      'entry_name'        => $datas->entry_name,
                      'project_category'  => $datas->project_category,
                      'approval_unit'     => $datas->approval_unit,
                      'approval_funds'    => $datas->approval_funds,
                      'account_outlay'    => $datas->account_outlay,
                      'pro_cate_research' => $datas->pro_cate_research,
                      'pro_sub_category'  => $datas->pro_sub_category,
                      'form_cooperate'    => $datas->form_cooperate,
                      'social_eco_goal'   => $datas->social_eco_goal,
                      'na_eco_industry'   => $datas->na_eco_industry,
                      'pro_integral'      => $datas->pro_integral,
                      'pro_road'          => $datas->pro_road,
                      'project_year'      => $datas->project_year,
                      'pro_remarks'        => $datas->pro_remarks
                  ]);
        return ($response != 1) ? false : true;

    }
    //修改老师项目信息
    public static function updateProjectDatas($datas){
        $response = DB::table('project')->where('pro_id',$datas->pro_id)
            ->update([
                'pro_host'          => $datas->pro_host,
                'pro_all_author'    => $datas->pro_all_author,
                'entry_name'        => $datas->entry_name,
                'project_category'  => $datas->project_category,
                'approval_unit'     => $datas->approval_unit,
                'approval_funds'    => $datas->approval_funds,
                'account_outlay'    => $datas->account_outlay,
                'pro_cate_research' => $datas->pro_cate_research,
                'pro_sub_category'  => $datas->pro_sub_category,
                'form_cooperate'    => $datas->form_cooperate,
                'social_eco_goal'   => $datas->social_eco_goal,
                'na_eco_industry'   => $datas->na_eco_industry,
                'pro_integral'      => $datas->pro_integral,
                'project_year'      => $datas->project_year,
                'pro_remarks'        => $datas->pro_remarks
            ]);
        return ($response != 1) ? false : true;

    }
    //查找以前项合同图片路径
    public static function selectImageRoad($project_id){
        $result = DB::table('project')->select('pro_road')->where('pro_id',$project_id)->first();
        return $result->pro_road;
    }
}