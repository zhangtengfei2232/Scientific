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
    //根据时间区间搜索信息
    public static function timeSelectInformation($start_time,$end_time,$table_name,$time_field){
        $result = DB::table($table_name)->whereBetween($time_field,[$start_time,$end_time])->get();
        return responseTojson(0,'查询成功','',$result);
    }
}