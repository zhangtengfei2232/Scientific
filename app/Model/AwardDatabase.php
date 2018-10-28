<?php

namespace App\Model;


use Illuminate\Support\Facades\DB;

class AwardDatabase extends ModelDatabase
{
    //添加获奖信息
    public static function addAwardDatas($datas){
        $aw_road = $datas['aw_road'];
        $add_award =  DB::table('award')
                ->insert([
                    'teacher_id'       => $datas['teacher_id'],
                    'aw_first_author'  => $datas['aw_first_author'],
                    'aw_all_author'    => $datas['aw_all_author'],
                    'prize_win_name'   => $datas['prize_win_name'],
                    'award_name'       => $datas['award_name'],
                    'form_achievement' => $datas['form_achievement'],
                    'aw_level'         => $datas['aw_level'],
                    'aw_grade'         => $datas['aw_grade'],
                    'aw_grant_unit'    => $datas['aw_grant_unit'],
                    'aw_grant_time'    => $datas['aw_grant_time'],
                    'aw_certi_number'  => $datas['aw_certi_number'],
                    'aw_sch_rank'      => $datas['aw_sch_rank'],
                    'aw_integral'      => $datas['aw_integral'],
                    'aw_road'          => $aw_road
                ]);
        if(empty($aw_road)){
            return ($add_award) ? responseTojson(0,'添加成功')
                : responseTojson(1,'添加失败');
        }
        return $add_award;
    }
    //删除多个获奖信息
    public static function deleteAwardDatas($aw_id_datas){
        for($i = 0; $i < count($aw_id_datas); $i++){
            DB::table('award')->where('award')->where('award',$aw_id_datas[$i])->delete();
        }
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
            $datas->aw_grant_time = date('Y-m-d',$datas->aw_grant_time);
        }
        return $result;
    }
    //查询获奖图片路径
    public static function selectAwardRoadDatas($aw_id_datas){
        $aw_road_datas = [];
        for($i = 0; $i < count($aw_id_datas); $i++){
            $road = DB::table('award')->select('aw_road')->where('aw_id',$aw_id_datas[$i])->first();
            $aw_road_datas[$i] = $road['aw_road'];
        }
    }
    //修改获奖信息
    public static function updateAwardDatas($datas){
        $aw_id = $datas['aw_id'];
        $response = DB::table('award')->where('aw_id',$aw_id)
            ->update([
                'aw_first_author'  => $datas['aw_first_author'],
                'aw_all_author'    => $datas['aw_all_author'],
                'prize_win_name'   => $datas['prize_win_name'],
                'award_name'       => $datas['award_name'],
                'form_achievement' => $datas['form_achievement'],
                'aw_level'         => $datas['aw_level'],
                'aw_grade'         => $datas['aw_grade'],
                'aw_grant_unit'    => $datas['aw_grant_unit'],
                'aw_grant_time'    => $datas['aw_grant_time'],
                'aw_certi_number'  => $datas['aw_certi_number'],
                'aw_sch_rank'      => $datas['aw_sch_rank'],
                'aw_integral'      => $datas['aw_integral'],
            ]);
        if(array_key_exists('aw_road',$datas)){
            $reset_image = DB::table('award')->where('aw_id',$aw_id)
                           ->update(['aw_road' => $datas['aw_road']]);
            return ($response != 1 || $reset_image != 1) ? false :true;
        }
        return ($response != 1) ? responseTojson(1,'修改获奖信息失败')
            : responseTojson(0,'修改获奖信息成功');
    }
}