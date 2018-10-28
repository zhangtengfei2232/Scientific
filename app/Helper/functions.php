<?php
use Illuminate\Support\Facades\Storage;
   //后台验证处理返回信息
    function responseTojson($code = 0,$message = '',$status = '',$datas = ''){
        $response["code"] = $code;
        if(!empty($datas)){
            $response["datas"] = $datas;
        }
        if(!empty($message)){
            $response["message"] = $message;
        }
        if(!empty($status))   return $response;
        return response()->json($response);
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


    //上传文件
    function uploadFiles($subjection,$files,$disk){
        $fileTypes = array('jpg','png','jpeg');
        $extension = $files->getClientOriginalExtension();
        $isInFileType = in_array($extension,$fileTypes);
        if($isInFileType){
            $originalName = time();
        }else{
            $originalName = $files->getClientOriginalName();
        }
        $files->storeAs($subjection,$originalName,$disk);
        $certificate_road = $subjection.'/'.$originalName;
        return $certificate_road;
    }
    //删除文件
    function deletefiles($disk,$certificate_road){
        if($certificate_road == null){
            return ;
        }
        Storage::disk($disk)->delete($certificate_road);
    }
    //删除多个文件
    function deleteAllFiles($disk,$files_raod){
        for($i = 0; $i < count($files_raod); $i++){
            deletefiles($disk,$files_raod[$i]);
        }
    }
    //上传多个图片
    function uploadAllImgs($subjection,$files,$disk){
        $image_road = [];
        for($i = 0; $i < count($files); $i++){
            $new_image_road = uploadFiles($subjection,$files[$i],$disk);
            $image_road[$i] = $new_image_road;
        }
        return $image_road;
    }
//    //删除多个图片
//    function deleteAllImgs($disk,$files_road){
//        for($i = 0; $i < count($files_road); $i++){
//            deletefiles($disk,$files_road[$i]);
//        }
//    }
    //生成PDF第一页缩略图
    function pdfToPngUpload($disk,$artical_road,$subjection,$artical_name,$page){
        $pdf  = $disk.'/'.$artical_road;
        if(!file_exists($pdf)){
            return showMsg(1,'没有找到PDF文件');
        }
        $path = $subjection.'/'.$artical_name.'首页.png';
        $im   = new Imagick();
        $im->setResolution(120,120);   //设置图像分辨率
        $im->setCompressionQuality(80);                //压缩比
        $im->readImage($pdf."[".$page."]");           //设置读取pdf的第一页
        //$im->thumbnailImage(200, 100, true);                // 改变图像的大小
        $im->scaleImage(200,100,true);       //缩放大小图像
        $filename = $disk.'/'.$path;
        if($im->writeImage($filename) == true)
        {
            return  $path;
        }
        return false;
    }


