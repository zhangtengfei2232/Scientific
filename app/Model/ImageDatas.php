<?php
namespace App\Model;


use Illuminate\Support\Facades\DB;

class ImageDatas extends ModelDatabase
{
        //添加图片
        public static function addImagesDatas($all_images_road,$owner_id,$image_status){
            $fails = [];
            $validate = true;
            for($i = 0; $i < count($all_images_road); $i++){
                 $result = DB::table('image')
                     ->insert([
                        'owner_id'       => $owner_id,
                         'meet_img_road' => $all_images_road[$i],
                         'create_time'   => time(),
                         'image_status'  => $image_status
                     ]);
                 if(!$result){
                     array_push($i,$fails);
                 }else{
                     $validate = false;
                 }
            }
            return ($validate) ? showMsg(0,'修改成功') :showMsg(1,'',$fails);
        }
        //删除图片
        public static function deleteImagesDatas(){

        }
        //查看所有图片路径
        public static function selectAllImage(){

        }
        //查看图片路径
        public static function selectImageRoadDatas(){

        }
        //修改图片
        public static function updateImageDatas(){

        }

}