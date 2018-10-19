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
    //出现异常删除文件
    public static function unlink(){
        unlink();
    }
}