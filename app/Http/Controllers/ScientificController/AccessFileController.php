<?php

namespace App\Http\Controllers\ScientificController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class AccessFileController extends Controller
{
    /**请求laravel/storage/app/data/下的文件资源
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function showFile(Request $request){
        $disk       = $request->disk;
        $subjection = $request->subjection;
        $fileName   = explode('/',$subjection);  //把传来的数据用'/'分割
        if(count($fileName) != 2) return redirect('showemptyview');
        $fileName = $fileName[1]; //取出文件的名字
        if(!file_exists(storage_path('app/data/'.$disk.'/'.$subjection))){//判断请求的文件是否存在
            return redirect('showemptyview');
        }
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
        if(!file_exists(storage_path($file))) return redirect('showemptyview');//判断文件是否存在
        return response()->download(storage_path($file));
    }
}
