<?php


function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status'  => $status,
        'message' => $message,
        'datas'    => $data
    );
    exit(json_encode($result));

}