<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class AgreementDatabase extends ModelDatabase
{
    //添加教学科研合作协议信息
    public static function addAgreementDatas($datas){
        return  DB::table('agreement')
                    ->insert([
                        'agree_name'           => $datas['agree_name'],
                        'agree_cooperate_unit' => $datas['agree_cooperate_unit'],
                        'agree_road'           => $datas['agree_road']
                    ]);
    }
    //修改教学科研合作协议信息
    public static function updateAgreementDatas($datas,$reset_file_status){
        $response = DB::table('agreement')->where('agree_id',$datas['agree_id'])
                    ->update([
                        'agree_name'           => $datas['agree_name'],
                        'agree_cooperate_unit' => $datas['agree_cooperate_unit'],
                        'agree_time'           => $datas['agree_time'],
                        'agree_road'           => $datas['agree_road']
                    ]);
        if($reset_file_status){
            return ($response != 1) ? false :true;
        }
        return ($response != 1) ? responseTojson(1,'修改合作协议文件信息失败') :
               responseTojson(0,'修改合作协议文件信息成功');
    }
    //查询单个教学科研合作协议信息
    public static function selectAgreementDatas($agreement_id){
       return DB::table('agreement')->where('agree_id',$agreement_id)->first();
    }
    //查询所有教学科研合作协议信息
    public static function selectAllAgreementDatas(){
       $result = DB::table('agreement')->orderBy('agree_time','desc')->get();
       foreach ($result as $datas){
           $datas->agree_time = date('Y-m-d',$datas->agree_time/1000);
       }
       return $result;
    }
    //查询教学科研合作协议路径
    public static function selectAgreementRoad($agreement_id_datas){
        $agreement_road = [];
        for($i = 0; $i < count($agreement_id_datas); $i++){
            $result = DB::table('agreement')->select('agree_road')->where('agree_id',$agreement_id_datas[$i])->first();
            $agreement_id_datas[$i] = $result->agree_road;
        }
        return $agreement_road;
    }
}