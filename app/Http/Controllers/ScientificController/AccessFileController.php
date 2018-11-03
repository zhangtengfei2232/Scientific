<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class AccessFileController extends Controller
{
    /**请求laravel/strorage/app/data/下的文件资源
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function showFile(Request $request){
        $disk       = $request->disk;
        $subjection = $request->subjection;
        $fileName   = explode('/',$subjection);  //把传来的数据用'/'分割
        $fileName   = $fileName[1];                       //取出文件的名字
        $temp_path  = tempnam(sys_get_temp_dir(), $fileName);
        file_put_contents($temp_path, Storage::disk($disk)->get($subjection));
        $downResponse = new BinaryFileResponse($temp_path);
        return $downResponse;
    }

    /**从Storage文件下，下载PDF文件
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function downloadFile(Request $request){
        $file = 'app/data/'.$request->file;
        return response()->download(storage_path($file));
    }
}