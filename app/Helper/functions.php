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
    function objectToArray($e)
    {
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
    //上传PDF文件
    function uploadfiles($subjection,$filename)
    {

    }
    //上传图片
    function uploadimg($subjection,$filename)
    {

    }