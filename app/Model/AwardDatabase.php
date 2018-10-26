<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class AwardDatabase extends ModelDatabase
{
    //添加获奖信息
    public static function addAwardDatas($datas){
        return DB::table('award')
                ->insert([
                    'teacher_id'      => $datas->teacher_id,
                    'aw_first_author' => $datas->aw_first_author,
                    'aw_all_author'   => $datas->aw_all_author,
                    'prize_win_name'  => $datas->prize_win_name,
                    'award_name'      => $datas->award_name,
                    'form_achievement' => $datas->form_achievement,
                    'aw_level'        => $datas->aw_level,
                    'aw_grade'        => $datas->aw_grade,
                    'aw_grant_unit'   => $datas->aw_grant_unit,
                    'aw_grant_time'   => $datas->aw_grant_time,
                    'aw_certi_number'  => $datas->aw_certi_number,
                    'aw_sch_rank'     => $datas->aw_sch_rank,
                    'aw_integral'     => $datas->aw_integral,
                    'aw_road'         => $datas->aw_road
                ]);
    }
    //删除获奖信息
    public static function deleteAwardDatas(){

    }
    //查询获奖信息
    public static function selectAwardDatas($aw_id){
        $result =  DB::table('award')->where('aw_id',$aw_id)->first();
        $result->aw_grant_time = date('Y-m-d',$result->aw_grant_time);
        return $result;
    }
    //查询全部获奖信息
    public static function selectAllAwardDatas($teacher_id){
        $result =  DB::table('award')->where('teacher_id',$teacher_id)->orderBy('aw_grant_time','desc')->get();
        foreach ($result as $datas){
            $result->aw_grant_time = date('Y-m-d',$datas->aw_grant_time);
        }
        return $result;
    }
    //查询获奖图片路径
    public static function selectAwardRoadDatas($aw_id){
        $result =  DB::table('award')->select('aw_road')->where('aw_id',$aw_id)->first();
        return $result->aw_road;
    }
    //修改获奖信息
    public static function updateAwardDatas($datas){
        $response = DB::table('award')->where('aw_id',$datas->aw_id)
            ->update([
                'aw_first_author' => $datas->aw_first_author,
                'aw_all_author'   => $datas->aw_all_author,
                'prize_win_name'  => $datas->prize_win_name,
                'award_name'      => $datas->award_name,
                'form_achievement' => $datas->form_achievement,
                'aw_level'        => $datas->aw_level,
                'aw_grade'        => $datas->aw_grade,
                'aw_grant_unit'   => $datas->aw_grant_unit,
                'aw_grant_time'   => $datas->aw_grant_time,
                'aw_certi_number'  => $datas->aw_certi_number,
                'aw_sch_rank'     => $datas->aw_sch_rank,
                'aw_integral'     => $datas->aw_integral,
            ]);
        return ($response != 1) ? showMsg(1,'修改获奖信息失败')
            : showMsg(0,'修改获奖信息成功');
    }
    //修改获奖和证书图片信息
    public static function updateAwardImage($datas){
      $response = DB::table('award')->where('aw_id',$datas->aw_id)
                  ->update([
                      'aw_first_author' => $datas->aw_first_author,
                      'aw_all_author'   => $datas->aw_all_author,
                      'prize_win_name'  => $datas->prize_win_name,
                      'award_name'      => $datas->award_name,
                      'form_achievement' => $datas->form_achievement,
                      'aw_level'        => $datas->aw_level,
                      'aw_grade'        => $datas->aw_grade,
                      'aw_grant_unit'   => $datas->aw_grant_unit,
                      'aw_grant_time'   => $datas->aw_grant_time,
                      'aw_certi_number'  => $datas->aw_certi_number,
                      'aw_sch_rank'     => $datas->aw_sch_rank,
                      'aw_integral'     => $datas->aw_integral,
                      'aw_road'         => $datas->aw_road
                  ]);
        return ($response != 1) ? false : true;
    }


}