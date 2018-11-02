<?php
namespace App\Model;

use Illuminate\Support\Facades\DB;
class ImageDatas extends ModelDatabase
{
        //添加图片
        public static function addImagesDatas($all_images_road,$owner_id,$image_status){
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
                     $validate = false;
                     break;
                 }
            }
            return ($validate) ? responseTojson(0,'添加会议图片成功')
                   :responseTojson(1,'添加会议图片失败');
        }
        //删除图片
        public static function deleteImagesDatas($delete_im_id){
            $response = DB::table('image')->whereIn('im_id',$delete_im_id)->delete();
            return ($response > 0) ? true : false;
        }
        //根据owner_id删除图片
        public static function byOwnerdeleteImagesDatas($owner_id_datas){
            $response = DB::table('image')->whereIn('owner_id',$owner_id_datas)->delete();
            return ($response > 0) ? true : false;
        }
        //查看所有图片路径====>删除图片时候需要路径
        public static function selectAllImageRoadDatas($ho_id_datas){
            $delete_images_road = [];
            for($i =0; $i < count($ho_id_datas); $i++){
                $image_road = DB::table('image')->select('image_road')->where('im_id',$ho_id_datas)->get();
                $delete_images_road[$i] = $image_road->image_road;
            }
            return $delete_images_road;
        }
        public static function selectImageDatas($owner_id,$image_status){
            return DB::table('image')->select('im_id','image_road')
                ->where([
                    ['owner_id',$owner_id],
                    ['image_status','=',$image_status]
                ])->orderBy('create_time','desc')->get();
        }
        //查会议或者讲学的全部图片
        //删除会议和讲学时，需要先查出图片路径
        public static function selectAllOwnerImage($owner_id_datas,$image_status){
            $image_road_datas = [];
            for($i = 0; $i < count($owner_id_datas); $i++){
                $result = DB::table('image')->select('image_road')
                    ->where([
                        ['owner_id','=',$owner_id_datas[$i]],
                        ['image_status','=',$image_status]
                    ])->orderBy('create_time','desc')
                    ->get();
                foreach ($result as $road){
                    array_push($image_road_datas,$road->image_road);//所有图片放到一个数组
                }
            }
            return $image_road_datas;
        }
}