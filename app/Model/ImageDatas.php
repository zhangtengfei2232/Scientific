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
            return ($validate) ? showMsg(0,'添加会议图片成功') :showMsg(1,'添加会议图片失败',$fails);
        }
        //删除图片
        public static function deleteImagesDatas($delete_im_id){
            $delete_status = true;
            for($i = 0; $i < count($delete_im_id); $i++){
                $response = DB::table('image')->where('im_id',$delete_im_id[$i])->delete();
                if($response != 1) $delete_status = false;
            }
            return ($delete_status) ? showMsg(0,'删除成功')
                   : showMsg(1,'删除失败');
        }
        //查看所有图片路径====>删除图片时候需要路径
        public static function selectAllImageRoadDatas($ho_id_datas){
            $delete_images_road = [];
            for($i =0; $i < count($ho_id_datas); $i++){
                $image_road = DB::table('image')->select('meet_img_road')->where('im_id',$ho_id_datas[$i])->first();
                $delete_images_road[$i] = $image_road->meet_img_road;
            }
            return $delete_images_road;
        }
        //查某个会议或者讲学的全部图片
        public static function selectAllOwnerImage($owner_id,$image_status){
            $result = DB::table('image')
                      ->where([
                          ['owner_id','=',$owner_id],
                          ['image_status','=',$image_status],
                      ])
                      ->get();
            foreach ($result as $datas){
                $result->create_time = date('Y-m-d',$datas->create_time);
            }
            return $result;
        }
}