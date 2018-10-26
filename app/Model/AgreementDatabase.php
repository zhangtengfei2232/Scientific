<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class AgreementDatabase extends ModelDatabase
{
    //添加教学科研合作协议信息
    public static function addAgreementDatas($datas){
        return  DB::table('agreement')
                    ->insert([
                        'agree_name'           => $datas->agree_name,
                        'agree_cooperate_unit' => $datas->agree_cooperate_unit,
                        'agree_road'           => $datas->agree_road
                    ]);
    }
    //删除单个教学科研合作协议信息
    public static function deleteAgreementDatas($agreement_id){
        $response = DB::table('agreement')->where('agree_id',$agreement_id)->delete();
        return ($response != 1) ? false : true;
    }
    //删除多个教学科研合作协议信息
    public static function deleteAllAgreementDatas($agreement_id_datas){
        $fail_agreement_id = [];
        $validate = true;
        for($i = 0; $i < count($agreement_id_datas); $i++){
            $response = DB::table('agreement')->where('agree_id',$agreement_id_datas[$i])->delete();
            if($response != 1){
                $validate = false;
                array_push($fail_agreement_id,$agreement_id_datas[$i]);
            }
        }
        if($validate){
            return showMsg(0,'教学科研合作协议删除成功');
        }
        $count_id = count($fail_agreement_id);
        return showMsg(1,'有'.$count_id.'个教学科研合作协议删除失败',$fail_agreement_id);
    }
    //修改教学科研合作协议信息
    public static function updateAgreementDatas($datas){
        $response = DB::table('agreement')->where('agree_id',$datas->agree_id)
                    ->update([
                        'agree_name' => $datas->agree_name,
                        'agree_cooperate_unit' => $datas->agree_cooperate_unit,
                        'agree_time'           => $datas->agree_time,
                        'agree_road'           => $datas->agree_road
                    ]);
        return ($response != 1) ? false :true;
    }
    //查询单个教学科研合作协议信息
    public static function selectAgreementDatas($agreement_id){
       $result = DB::table('agreement')->where('agree_id',$agreement_id)->first();
       $result->agree_time = date('Y-m-d',$result->agree_time);
       return $result;
    }
    //查询所有教学科研合作协议信息
    public static function selectAllAgreementDatas(){
       $result = DB::table('agreement')->orderBy('agree_time','desc')->get();
       foreach ($result as $datas){
           $result->agree_time = date('Y-m-d',$datas->agree_time);
       }
       return $result;
    }
    //查询多个教学科研合作协议路径
    public static function selectAllAgreementRoad($agreement_id_datas){
        $agreement_road = array();
        for($i = 0; $i < count($agreement_id_datas); $i++){
            $result = DB::table('agreement')->select('agree_road')->where('agree_id',$agreement_id_datas[$i])->first();
            $agreement_id = $agreement_id_datas[$i];
            //用教学科研合作协议ID作为键，路径作为值存入
            $agreement_road[$agreement_id] = $result->agree_road;
        }
        return $agreement_road;
    }
    //查询单个教学科研合作协议路径
    public static function selectAgreementRoad($agree_id){
        $result = DB::table('agreement')->select('agree_road')->where('agree_id',$agree_id)->first();
        return $result->agree_road;
    }
    //查询教学科研合作协议名称
    public static function selectAgreementName($delete_agreement){
        $agreement_name = [];
        for($i = 0; $i < count($delete_agreement); $i++){
            $name = DB::table('agreement')->select('agree_name')
                    ->where('agree_id',$delete_agreement[$i])
                    ->first();
            $agreement_name[$i] = $name->agree_name;
        }
    }
}