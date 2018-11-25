<?php
namespace App\Http\Controllers\ExportController;

use App\Http\Controllers\Controller;
use App\Model\AppraisalDatabase;
use App\Model\ArticalDatabase;
use App\Model\AwardDatabase;
use App\Model\OpusDatabase;
use App\Model\PatentDatabase;
use App\Model\ProjectDatabase;
use Illuminate\Http\Request;
use config\UploadSubjectionConfig;
class PdfController extends Controller
{
    //同时导出多个论文，取每个论文的第一页，形成一个新的PDF论文
    public function exportArticalPdfs(Request $request){
        $art_id_datas   = explode(',',$request->art_id_datas);
        $art_road_datas = ArticalDatabase::selectArticalToPdfRoadDatas($art_id_datas);
        $disk = UploadSubjectionConfig::ARTICAL;
        selectionFirstPageToNewPdf($disk,$art_road_datas);
    }
    //选多个项目文件导出
    public function exportProjectPdfs(Request $request){
        $pro_id_datas   = explode(',',$request->pro_id_datas);
        $pro_road_datas = ProjectDatabase::selectImagesRoadDatas($pro_id_datas);
    }
    //选多个著作文件导出
    public function exportOpusPdfs(Request $request){
        $op_id_datas = $request->op_id_datas;
        $op_road_datas = OpusDatabase::selectOpusAllImageDatas($op_id_datas);
    }
    //选多个获奖著作文件导出
    public function exportAwardPdfs(Request $request){
        $aw_id_datas = $request->aw_id_datas;
        $aw_road_datas = AwardDatabase::selectAwardRoadDatas($aw_id_datas);
    }
    //选多个专利文件导出
    public function exportPatentPdfs(Request $request){
        $pa_id_datas = $request->pa_id_datas;
        $pa_road_datas = PatentDatabase::selectImageRoadDatas($pa_id_datas);
    }
    //选多个成果鉴定文件导出
    public function exportAppraisalPdfs(Request $request){
        $ap_id_datas = $request->ap_id_datas;
        $ap_road_datas = AppraisalDatabase::selectAllAppraisalImageRoad($ap_id_datas);
    }
}