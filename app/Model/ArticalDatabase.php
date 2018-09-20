<?php
namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticalDatabase  extends Model
{
     public  static function selectArtical()
     {
         return DB::table('artical')->get();
     }
}