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
    //删除老师，根据老师工号去查询老师上传的文件路径
    public static function byTeacherIdSelect($teacher_id,$id_field,$table_name,$first_field,$second_field = '',$image_status = 0,$injection_field = ''){
        $file_road      = [];
        $id_datas       = [];
        $image_id_datas = [];
        if(empty($second_field)){
            //查文件路径，如果是举行会议，参加会议，专家讲学是查ID
            if(empty($id_field)){
                $result = DB::table($table_name)->select($first_field,$injection_field)->where('teacher_id',$teacher_id)->get();
                foreach ($result as $id){
                    $image_road_datas = DB::table('image')->select('image_road','im_id')
                        ->where([['owner_id',$id->$first_field],['image_status',$image_status]])->get();
                    foreach ($image_road_datas as $datas){
                        //举行会议，参加会议，专家讲学图片路径
                        if(!empty($datas->image_road)) array_push($file_road,$datas->image_road);
                        array_push($image_id_datas,$datas->im_id);//举行会议，参加会议，专家讲学图片ID
                    }
                    if(!empty($id->$injection_field)) array_push($file_road,$id->$injection_field);
                    array_push($id_datas,$id->$first_field);       //举行会议，参加会议，专家讲学ID
                }
            }else{
                $result = DB::table($table_name)->select($first_field,$id_field)->where('teacher_id',$teacher_id)->get();
                foreach ($result as $datas){
                    if(!empty($datas->$first_field)) array_push($file_road,$datas->$first_field);
                    array_push($id_datas,$datas->$id_field);
                }
            }
        }else{
           $road_result = DB::table($table_name)->select($first_field,$second_field,$id_field)->where('teacher_id',$teacher_id)->get();
           foreach($road_result as $road){
               if(!empty($road->$first_field))  array_push($file_road,$road->$first_field);
               if(!empty($road->$second_field)) array_push($file_road,$road->$second_field);
               array_push($id_datas,$road->$id_field);
           }
        }
        $data['file_road'] = $file_road;
        $data['id_datas'] = $id_datas ;
        if(empty($id_field)){
            $data['image_id_datas'] = $image_id_datas;
        }
        return $data;
    }
    //删除多个数据
    public static function deleteAllDatas($table_name,$id_field,$id_datas){
         $response = DB::table($table_name)->whereIn($id_field,$id_datas)->delete();
         return ($response == count($id_datas)) ? true : false;
    }
    //根据字段组合查询数据
    public static function combinationSelectDatas($condition_datas,$second_field = '',$second_datas = [],$third_field = '',$third_datas = []){
//         $table_name  = $condition_datas['table_name'];
         $first_field = $condition_datas['first_field'];
         $first_datas = $condition_datas['first_datas'];
         $time_field  = $condition_datas['time_field'];
         $result = DB::table($condition_datas['table_name']);
         if(!empty($first_datas)){
             $result = $result->whereIn($first_field,$first_datas);
         }
         if(!empty($second_datas)){
             $result = $result->whereIn($second_field,$second_datas);
         }
         if(!empty($third_datas)){
             $result = $result->whereIn($third_field,$third_datas);
         }
         $result = $result->paginate($condition_datas['total']);
         foreach ($result as $datas){
             $datas->$time_field = date('Y-m-d',$datas->$time_field/1000);
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
    public static function selectAllDatas($datas){
        $table_name = $datas['table_name'];
        if(!empty($datas['time_field'])){
            $time_field = $datas['time_field'];
        }
        $result = DB::table($table_name)->paginate($datas['total']);
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
    /**根据时间区间搜索单个信息
     * @param $start_time
     * @param $end_time
     * @param $table_name
     * @param $time_field
     * @param string $teacher_id
     * @return \Illuminate\Http\JsonResponse
     */
    public static function timeSelectInformation($start_time,$end_time,$table_name,$time_field,$teacher_id = '',$total = 10){
        if(empty($teacher_id)){
            $result = DB::table($table_name)->whereBetween($time_field,[$start_time,$end_time])->paginate($total);
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
    public static function categorySelectInformation($datas){
        $result = DB::table($datas['table_name'])->where($datas['field'],$datas['value'])->paginate($datas['value']);
        $time_field = $datas['time_field'];
        if(!empty($time_field)){
            foreach ($result as $datas){
                $datas->$time_field = date('Y-m-d',$datas->$time_field/1000);
            }
        }
        return responseTojson(0,'查询成功','',$result);
    }
    //分页查询
    public static function pagingQueryDatas($datas){
        $result = DB::table($datas['table_name'])
                  ->where($datas['field'],'like',"%".$datas['value']."%")
                  ->paginate($datas['total']);
        if($datas['table_name'] == 'duties'){
            return self::changeDutiesTimeDatas($result);
        }
        $time_field = $datas['time_field'];
        foreach ($result as $datas){
            $datas->$time_field = date('Y-m-d',$datas->$time_field);
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
        $datas['total'] = $result->total;
        $result = $result->data;
        for($i = 0; $i < count($result); $i++){
            $result[$i] = (array)$result[$i];  //把数据强制转化为数组
            $duties_time_datas        = explode(',',$result[$i]['du_year_num']);
            $result[$i]['start_time'] = date('Y-m-d',$duties_time_datas[0]/1000);
            $result[$i]['end_time']   = date('Y-m-d',$duties_time_datas[1]/1000);
        }
        $datas['du_datas'] = $result;
        return responseTojson(0,'查询成功','',$datas);
    }
    /**根据字段进行分组======>按字段 '升序' 分组返回个数
     * 饼图：师资（学历，职称，学缘），论文（期刊级别），
     * 项目（证书级别），著作（著作类别），获奖（获奖级别）
     * @param $table_name
     * @param $field
     * @return \Illuminate\Http\JsonResponse
     */
    public static function groupByAndCountDatas($table_name,$field,$number,$time_field = '',$time_datas = []){
        $count_datas = [];
        if($table_name == 'project'){
            $approval_funds_money_datas = [];
            $account_outlay_money_datas = [];
            for($i = 0; $i < $number; $i++){
                $count_num = DB::table($table_name)->where($field,$i);
                $count_approval_funds_money = DB::table($table_name)->where($field,$i);
                $count_account_outlay_money = DB::table($table_name)->where($field,$i);
                if(!empty($time_field)){
                    $count_num = $count_num->whereBetween($time_field,[$time_datas['start_time'],$time_datas['end_time']]);
                    $count_approval_funds_money = $count_approval_funds_money->whereBetween($time_field,[$time_datas['start_time'],$time_datas['end_time']]);
                    $count_account_outlay_money = $count_account_outlay_money->whereBetween($time_field,[$time_datas['start_time'],$time_datas['end_time']]);
                }
                $approval_funds_money_datas[$i] = $count_approval_funds_money->sum('approval_funds');
                $account_outlay_money_datas[$i] = $count_account_outlay_money->sum('account_outlay');
                $count_datas[$i] = $count_num;
            }
            $datas['count_num']      = $count_datas;
            $datas['approval_funds'] = $approval_funds_money_datas;
            $datas['account_outlay'] = $account_outlay_money_datas;
            $datas['sum_approval_funds_money'] = array_sum($datas['approval_funds']);
            $datas['sum_account_outlay_money'] = array_sum($datas['account_outlay']);
            return responseTojson(0,'查询成功','',$datas);
        }
        for($i = 0; $i < $number; $i++){
            $count = DB::table($table_name)->where($field,$i);
            if(!empty($time_field)){
                $count = $count->whereBetween($time_field,[$time_datas['start_time'],$time_datas['end_time']]);
            }
            $count_datas[$i] = $count->count();
        }
        return responseTojson(0,'查询成功','',$count_datas);
    }
    //查询某个表的最小时间和最大时间
    public static function selectMinAndMaxTime($table_name,$time_field){
        $min_time = DB::table($table_name)->select($time_field)->min();
        $max_time = DB::table($table_name)->select($time_field)->max();
        $time_datas['start_time'] = $min_time->$time_field - 5;
        $time_datas['end_time']   = $max_time->$time_field + 5;
        return $time_datas;
    }
    /**
     *统计每个模块的记录总条数
     */
    public static function countEveryModularDatas(){
        $count_datas = [];
        $table_name_datas = ['artical','project','opus','award','patent','appraisal','holdmeet','joinmeet','lecture','duties'];
        for($i = 0; $i < count($table_name_datas); $i++){
            $count_datas[$i] = DB::table($table_name_datas[$i])->count();
        }
        return responseTojson(0,'查询成功','',$count_datas);
    }
    /**
     * 导出表格所需数据
     */
    public static function selectExportExcelDatas($table_name,$id_field,$art_id_datas){
        return DB::table($table_name)->whereIn($id_field,$art_id_datas)->get();
    }

}
