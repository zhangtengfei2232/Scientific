<?php
namespace App\Model;



use Illuminate\Support\Facades\DB;

class ProjectDatabase extends ModelDatabase
{
    //添加项目信息
    public static function addProjectDatas($datas){
        return  DB::table('project')
            ->insert([
                'teacher_id'        => $datas['teacher_id'],
                'pro_host'          => $datas['pro_host'],
                'pro_all_author'    => $datas['pro_all_author'],
                'entry_name'        => $datas['entry_name'],
                'project_category'  => $datas['project_category'],
                'approval_unit'     => $datas['approval_unit'],
                'approval_funds'    => $datas['approval_funds'],
                'account_outlay'    => $datas['account_outlay'],
                'pro_cate_research' => $datas['pro_cate_research'],
                'pro_sub_category'  => $datas['pro_sub_category'],
                'form_cooperate'    => $datas['form_cooperate'],
                'social_eco_goal'   => $datas['social_eco_goal'],
                'na_eco_industry'   => $datas['na_eco_industry'],
                'pro_integral'      => $datas['pro_integral'],
                'pro_road'          => $datas['pro_road'],
                'project_year'      => $datas['project_year'],
                'pro_remarks'       => $datas['pro_remarks']
            ]);
    }
    //删除多个项目信息
    public static function deleteAllProjectDatas($pro_id_datas){
      DB::table('project')->whereIn('pro_id',$pro_id_datas)->delete();
    }
    //查找单个项目信息
    public static function selectProjectDatas($project_id){
      $result = DB::table('project')->where('pro_id',$project_id)->first();
      $result->project_year = date('Y-m-d',$result->project_year);
      return $result;
    }
    //查找所有项目信息
    public static function selectAllProjectDatas($teacher_id){
      $result = DB::table('project')->where('teacher_id',$teacher_id)->orderBy('project_year','desc')->get();
      foreach ($result as $datas){
          $datas->project_year = date('Y-m-d',$datas->project_year);
      }
      return $result;
    }
    //修改老师项目和项目合同信息
    public static function updateProjectDatas($datas){
        $reset_image = 1;
        $resetinfor = DB::table('project')->where('pro_id',$datas->pro_id)
                  ->update([
                      'pro_host'          => $datas['pro_host'],
                      'pro_all_author'    => $datas['pro_all_author'],
                      'entry_name'        => $datas['entry_name'],
                      'project_category'  => $datas['project_category'],
                      'approval_unit'     => $datas['approval_unit'],
                      'approval_funds'    => $datas['approval_funds'],
                      'account_outlay'    => $datas['account_outlay'],
                      'pro_cate_research' => $datas['pro_cate_research'],
                      'pro_sub_category'  => $datas['pro_sub_category'],
                      'form_cooperate'    => $datas['form_cooperate'],
                      'social_eco_goal'   => $datas['social_eco_goal'],
                      'na_eco_industry'   => $datas['na_eco_industry'],
                      'pro_integral'      => $datas['pro_integral'],
                      'project_year'      => $datas['project_year'],
                      'pro_remarks'       => $datas['pro_remarks']
                  ]);
        if(array_key_exists('pro_road',$datas)){
            $reset_image = DB::table('project')->where('pro_id')->update(['pro_road' => $datas['pro_road']]);
            return ($resetinfor != 1 || $reset_image != 1) ? false : true;
        }
        return ($resetinfor != 1) ? responseTojson(1,'修改失败') : responseTojson(0,'修改成功') ;
    }
    //查找以前多个项目合同路径
    public static function selectImagesRoadDatas($project_id_datas){
        $images_road_datas = [];
        for($i = 0; $i < count($project_id_datas); $i++){
            $road = DB::table('project')->select('pro_road')->where('pro_id',$project_id_datas[$i])->first();
            $images_road_datas[$i] = $road->pro_road;
        }
        return $images_road_datas;
    }
}