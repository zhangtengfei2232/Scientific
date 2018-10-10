<?php
    //返回前台的信息，全部转化为JSON数据
    function showMsg($code,$message = '',$datas = ''){
        return json_encode([
            'code'    => $code,
            'message' => $message,
            'datas'   => $datas
        ]);
    }
    //对象转化为数组
    function objectToArray($e){
        $e = (array)$e;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'resource') return;
            if (gettype($v) == 'object' || gettype($v) == 'array')
                $e[$k] = (array)objectToArray($v);
        }
     return $e;
    }
    //数组转化为对象
    function arrayToObject($e){
        if( gettype($e)!='array' ) return;
        foreach($e as $k=>$v){
            if( gettype($v)=='array' || getType($v)=='object' )
                $e[$k]=(object)arrayToObject($v);
        }
        return (object)$e;
    }
    //循环遍历数组是否存在空值
    function emptyarray($datas){
         foreach ($datas as $key => $data){
             if(empty($data)) return 1;
         }
         return 0;
    }
    //判断论文字段是否合法
    function judgeArticalField($datas){
         if(emptyarray($datas)){
             return showMsg(1,'你填写的的论文信息不全');
         }else{
             if(strlen($datas->title) > 90){
                 return showMsg(1,'你输入的论文题目不合法');
             }elseif (strlen($datas->author) > 12){
                 return showMsg(1,'你输入作者姓名不合法');
             }elseif (strlen($datas->publication_name) > 30){
                 return showMsg(1,'你输入刊物名称不合法');
             }elseif (strlen($datas->publication_num) > 20){
                 return showMsg(1,'你输入的刊号不合法');
             }elseif (!is_numeric($datas->num_words)
                     || strlen($datas->num_words) > 11){
                 return showMsg(1,'你输入的论文字数不合法');
             }elseif (strlen($datas->periodical_cate) > 10){
                 return showMsg(1,'你输入的期刊类别不合法');
             }elseif (strlen($datas->belong_project) > 20){
                 return showMsg(1,'你输入的所属项目名称不合法');
             }elseif (strlen($datas->art_cate_research) > 20){
                 return showMsg(1,'你输入的研究类别名称不合法');
             }elseif (strlen($datas->art_sub_category) > 10){
                 return showMsg(1,'你输入的学科门类名称不合法');
             }elseif (!is_numeric($datas->art_integral)
                 || strlen($datas->art_integral) > 11){
                 return showMsg(1,'你输入的积分不合法');
             }
         }
    }
    //上传文件
    function uploadfiles($subjection,$filename){

    }
    //删除文件
    function deletefiles(){

    }
    //上传图片
    function uploadimg($subjection,$filename){

    }
    //删除图片
    function deleteimg(){

    }

