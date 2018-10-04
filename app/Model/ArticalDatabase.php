<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ArticalDatabase  extends Model
{
     public  static function selectArtical($art_id)
     {
         return DB::table('artical')->where('art_id',$art_id)->get();
     }
}