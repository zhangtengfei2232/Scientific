<?php


function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status'  => $status,
        'message' => $message,
        'datas'    => $data
    );
    exit(json_encode($result));

}
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