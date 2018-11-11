<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ModelDatabase  extends  Model
{
    //开启事务
    public static function beginTraction(){
        return DB::beginTransaction();
    }
    // 没有异常，提交
    public static function commit(){
        return DB::commit();
    }
    //回滚
    public static function rollback(){
        return DB::rollback();
    }
    //删除多个数据
    public static function deleteAllDatas($table_name,$id_field,$id_datas){
         $response = DB::table($table_name)->whereIn($id_field,$id_datas)->delete();
         return ($response == count($id_datas)) ? true : false;
    }
    //根据字段组合查询数据
    public static function combinationSelectDatas($condition_datas,$second_field = '',$second_datas = [],$third_field = '',$third_datas = []){
         $table_name  = $condition_datas['table_name'];
         $first_field = $condition_datas['first_field'];
         $first_datas = $condition_datas['first_datas'];
         if(count($first_datas) == 0 && count($second_datas) == 0 && count($third_datas) == 0){          //三个字段都为空
                 $result = DB::table($table_name)->get();
         }elseif (count($first_datas) != 0 && count($second_datas) != 0 && count($third_datas) != 0){ //三个字段都不为空
             $result = DB::table($table_name)
                 ->whereIn($first_field,$first_datas)
                 ->whereIn($second_field,$second_datas)
                 ->whereIn($third_field,$third_datas)
                 ->get();
         }elseif (count($first_datas) != 0 && count($second_datas) == 0 && count($third_datas) == 0){
             $result = DB::table($table_name)
                 ->whereIn($first_field,$first_datas)
                 ->get();
         }elseif (count($first_datas) == 0 && count($second_datas) != 0 && count($third_datas) == 0){
             $result = DB::table($table_name)
                 ->whereIn($second_field,$second_datas)
                 ->get();
         }elseif (count($first_datas) == 0 && count($second_datas) == 0 && count($third_datas) != 0){
             $result = DB::table($table_name)
                 ->whereIn($third_field,$third_datas)
                 ->get();
         }elseif (count($first_datas) != 0 && count($second_datas) != 0 && count($third_datas) == 0){
             $result = DB::table($table_name)
                 ->whereIn($first_field,$first_datas)
                 ->whereIn($second_field,$second_datas)
                 ->get();
         }elseif (count($first_datas) != 0 && count($second_datas) == 0 && count($third_datas) != 0){
             $result = DB::table($table_name)
                 ->whereIn($first_field,$first_datas)
                 ->whereIn($third_field,$third_datas)
                 ->get();
         }elseif(count($first_datas) == 0 && count($second_datas) != 0 && count($third_datas) != 0){
             $result = DB::table($table_name)
                 ->whereIn($second_field,$second_datas)
                 ->whereIn($third_field,$third_datas)
                 ->get();
         }
         foreach ($result as $datas){
             $datas->$condition_datas['time_field'] = date('Y-m-d',$datas->$condition_datas['time_field']/1000);
         }
         return responseTojson(0,'查询成功','',$result);
    }
    //查老师所有信息
    public static function selectAllteacherDatas(){
        $result = DB::table('teacher')->get();
        foreach ($result as $datas){
            $datas->borth                 = date('Y-m-d',$datas->borth/1000);
            $datas->admin_tenure_time     = date('Y-m-d',$datas->admin_tenure_time/1000);
            $datas->review_time           = date('Y-m-d',$datas->review_time/1000);
            $datas->appointment_time      = date('Y-m-d',$datas->appointment_time/1000);
            $datas->working_hours         = date('Y-m-d',$datas->working_hours/1000);
            $datas->first_graduation_time = date('Y-m-d',$datas->first_graduation_time/1000);
            $datas->most_graduation_time  = date('Y-m-d',$datas->most_graduation_time/1000);
            $datas->master_time           = date('Y-m-d',$datas->master_time/1000);
        }
        return responseTojson(0,'查询成功','',$result);
    }
    /**查询某个表的所有数据
     * @param $table_name
     * @param $time_field
     * @return \Illuminate\Http\JsonResponse
     */
    public static function selectAllDatas($table_name,$time_field){
        $result = DB::table($table_name)->get();
        if($table_name == 'duties'){
            return  self::changeDutiesTimeDatas($result);
        }
        if(!empty($time_field)){
            foreach ($result as $datas){
                $datas->$time_field = date('Y-m-d',$datas->$time_field/1000);
            }
        }
        return responseTojson(0,'查询成功','',$result);
    }
    /**根据时间区间搜索单个信息
     * @param $start_time
     * @param $end_time
     * @param $table_name
     * @param $time_field
     * @param string $teacher_id
     * @return \Illuminate\Http\JsonResponse
     */
    public static function timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id = ''){
        if(empty($teacher_id)){
            $result = DB::table($table_name)->whereBetween($time_field,[$start_time,$end_time])->get();
        }else{
            $result = DB::table($table_name)
                ->where('teacher_id',$teacher_id)
                ->whereBetween($time_field,[$start_time,$end_time])
                ->get();
        }
        foreach ($result as $datas){
            $datas->$time_field = date('Y-m-d',$datas->$time_field/1000);
        }
        return responseTojson(0,'查询成功','',$result);
    }
    /**根据级别,类别，门类，编著形式,名次检索
     * @param $table_name
     * @param $field
     * @param $cetificate
     * @param $time_field
     * @return \Illuminate\Http\JsonResponse
     */
    public static function categorySelectInformation($table_name,$field,$cetificate,$time_field){
        $result = DB::table($table_name)->where($field,$cetificate)->get();
        if(!empty($time_field)){
            foreach ($result as $datas){
                $datas->$time_field = date('Y-m-d',$datas->$time_field/1000);
            }
        }
        return responseTojson(0,'查询成功','',$result);
    }
    /**根据名称模糊查询
     * @param $table_name
     * @param $field
     * @param $name
     * @param $time_field
     * @return mixed
     */
    public static function byNameSelectDatas($table_name,$field,$name,$time_field){
       $result = DB::table($table_name)->where($field,'like',"%".$name."%")->get();
       if($table_name == 'duties'){
           return self::changeDutiesTimeDatas($result);
       }
       if(!empty($time_field)){
           foreach ($result as $datas){
               $datas->$time_field = date('Y-m-d',$datas->$time_field/1000);
           }
       }
       return responseTojson(0,'查询成功','',$result);
    }
    public static function changeDutiesTimeDatas($result){
        $result = json_decode(json_encode($result));
        for($i = 0; $i < count($result); $i++){
            $duties_time_datas        = explode(',',$result[$i]->du_year_num);
            $result[$i]['start_time'] = date('Y-m-d',$duties_time_datas[0]);
            $result[$i]['end_time']   = date('Y-m-d',$duties_time_datas[1]);
        }
        return responseTojson(0,'查询成功','',$result);
    }
    /**根据字段进行分组======>按字段 '升序' 分组返回个数
     * 饼图：师资（学历，职称，学缘），论文（期刊级别），
     * 项目（证书级别），著作（著作类别），获奖（获奖级别）
     * @param $table_name
     * @param $field
     * @return \Illuminate\Http\JsonResponse
     */
    public static function groupByAndCountDatas($table_name,$field){
        $result = DB::table($table_name)->select(DB::raw('COUNT('.$field.') as num'))->groupBy($field)->get();
        return responseTojson(0,'查询成功','',$result);
    }
}