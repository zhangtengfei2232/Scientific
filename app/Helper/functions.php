<?php
    //返回前台的信息，全部转化为JSON数据
    function showMsg($code = 0,$message = '',$datas = ''){
        $response["code"] = $code;
        if(!empty($datas)){
            $response["datas"] = $datas;
        }
        if(!empty($message)){
            $response["message"] = $message;
        }
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
    //循环遍历数组是否存在空值
    function emptyarray($datas){
         foreach ($datas as $key => $data){
             if(empty($data)) return true;
         }
         return false;
    }
    //判断老师字段是否合法
    function judgeTeacherField($datas){
         if(emptyarray($datas)){
             return showMsg(1,'你填写的个人信息不全');
         }
         $isMob="/^1[3-5,8]{1}[0-9]{9}$/";
         $isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";
         $preg_card='/^\d{15}$)|(^\d{17}([0-9]|X)$/isu';
         if(array_key_exists('teacher_id',$datas)){
             if(strlen($datas->teacher_id) > 7){
                 return showMsg(1,'你输入的工号有误');
             }
         }
         if(strlen($datas->name) > 15){
             return showMsg(1,'你填写的老师姓名不合法');
         }elseif (strlen($datas->office_phone) > 30
             || !preg_match($isMob, $datas->office_phone)
             || !preg_match($isTel, $datas->office_phone)){
             return showMsg(1,'你填写的办公电话有误');
         }elseif (strlen($datas->home_phone) > 20
             || !preg_match($isTel, $datas->home_phone)
             || !preg_match($isMob, $datas->home_phone)){
             return showMsg(1,'你填写的住宅电话有误');
         }elseif (strlen($datas->phone) > 11
             || !preg_match($isMob, $datas->phone)){
             return showMsg(1,'你输入的手机号有误');
         }elseif (strlen($datas->nation) > 40){
             return showMsg(1,'你输入的民族有误');
         }elseif (strlen($datas->admin_duties) > 30){
             return showMsg(1,'你输入的行政职务有误');
         }elseif (strlen($datas->technical_position) > 30){
             return showMsg(1,'你输入的专业技术职务有误');
         }elseif (strlen($datas->series) > 20){
             return showMsg(1,'你输入的系列有误');
         }elseif (strlen($datas->company) > 20){
             return showMsg(1,'你输入的单位有误');
         }elseif (strlen($datas->te_re_department) > 30){
             return showMsg(1,'你输入的所属教研室和实验室有误');
         }elseif (strlen($datas->origin_work_unit) > 20){
             return showMsg(1,'你输入的原工作单位有误');
         }elseif (strlen($datas->certificate_num) > 20){
             return showMsg(1,'你输入的教师资格证编号有误');
         }elseif (strlen($datas->identity_card) > 18
             || !preg_match($preg_card, $datas->identity_card)){
             return showMsg(1,'你输入的身份证号有误');
         }elseif (strlen($datas->edu_school) > 30){
             return showMsg(1,'你输入的毕业院校有误');
         }elseif (strlen($datas->work_major) > 30){
             return showMsg(1,'你输入的从事专业有误');
         }elseif (strlen($datas->belong_subject) > 30){
             return showMsg(1,'你输入的从事专业所属学科有误');
         }elseif (strlen($datas->teach_course) > 20){
             return showMsg(1,'你输入的任教课程有误');
         }elseif (strlen($datas->first_graduate_school) > 30){
            return showMsg(1,'你输入的老师第一学历毕业学校有误');
        }elseif (strlen($datas->first_study_major) > 20){
            return showMsg(1,'你输入的老师第一学历专业有误');
        }elseif (strlen($datas->most_graduate_school) > 30){
            return showMsg(1,'你输入的老师最高学历专业有误');
        }elseif (strlen($datas->most_study_major) > 20){
            return showMsg(1,'你输入的老师最高学历专业有误');
        }elseif (strlen($datas->master_company) > 100){
             return showMsg(1,'你输入的老师硕博导授予单位有误');
         }else{
            return showMsg(0,'验证通过');
        }
    }
    //判断论文字段是否合法
    function judgeArticalField($datas){
         if(emptyarray($datas)){
             return showMsg(1,'你填写的的论文信息不全');
         }
         if(strlen($datas->title) > 90){
             return showMsg(1,'你输入的论文题目不合法');
         }elseif (strlen($datas->author) > 12){
             return showMsg(1,'你输入作者姓名不合法');
         }elseif (strlen($datas->publication_name) > 30){
             return showMsg(1,'你输入刊物名称不合法');
         }elseif (strlen($datas->publication_num) > 20){
             return showMsg(1,'你输入的刊号不合法');
         }elseif (!is_numeric($datas->num_words)
                 || strlen($datas->num_words) > 11){
             return showMsg(1,'你输入的论文字数不合法');
         }elseif (strlen($datas->periodical_cate) > 10){
             return showMsg(1,'你输入的期刊类别不合法');
         }elseif (strlen($datas->belong_project) > 20){
             return showMsg(1,'你输入的所属项目名称不合法');
         }elseif (strlen($datas->art_cate_research) > 20){
             return showMsg(1,'你输入的研究类别名称不合法');
         }elseif (!is_numeric($datas->art_integral)
             || strlen($datas->art_integral) > 11){
             return showMsg(1,'你输入的积分不合法');
         }elseif (strlen($datas->sch_percal_cate) > 20){
             return showMsg(1,'你输入的学校认证期刊级别有误');
         }else{
             return showMsg(0,'验证通过');
         }
    }
    //验证项目字段
    function judgeProjectField($datas){
        if(emptyarray($datas)){
            return showMsg(1,'你填写的的项目信息不全');
        }
        if(strlen($datas->pro_host) > 10){
            return showMsg(1,'你输入的主持人有误');
        }elseif (strlen($datas->entry_name) > 40){
            return showMsg(1,'你输入的项目名称过长');
        }elseif (strlen($datas->project_category) > 20){
            return showMsg(1,'你输入的项目类别名过长');
        }elseif (strlen($datas->approval_unit) > 20){
            return showMsg(1,'你输入的批准单位名字过长');
        }elseif (!is_numeric($datas->approval_funds)
            || strlen($datas->approval_funds) > 10){
            return showMsg(1,'你输入的批准经费必须全为数字且不超过10位');
        }elseif (!is_numeric($datas->account_outlay)
            || strlen($datas->account_outlay) > 10){
            return showMsg(1,'你输入的当年到账经费必须全为数字且不超过10位');
        }elseif (!is_numeric($datas->pro_integral)
            || strlen($datas->pro_integral) > 10){
            return showMsg(1,'你输入的积分必须全为数字且不超过10位');
        }elseif (strlen($datas->pro_cate_research) > 20){
            return showMsg(1,'你输入的研究类别名字过长');
        }elseif (strlen($datas->social_eco_goal) > 50){
            return showMsg(1,'你输入的社会经济目标过长');
        }else{
            return showMsg(0,'验证通过');
        }
    }
    //验证著作字段
    function judgeOpusField($datas){
       if(emptyarray($datas)){
           return showMsg(1,'你填写著作信息不完整');
       }
       if(strlen($datas->op_first_author) > 15){
           return showMsg(1,'你填写的著作第一作者名字过长');
       }elseif (strlen($datas->op_name) > 50){
           return showMsg(1,'你填写的著作名称过长');
       }elseif (strlen($datas->op_publish) > 50){
           return showMsg(1,'你填写的著作出版社名字过长');
       }elseif (strlen($datas->op_number) > 30){
           return showMsg(1,'你填写的著作书号过长');
       }elseif (strlen($datas->op_total_words) > 10
           || !is_numeric($datas->op_total_words)){
           return showMsg(1,'你填写的著作总字数必须全为数字且不超过10位');
       }elseif (strlen($datas->op_self_words) > 10
           || !is_numeric($datas->op_self_words)){
           return showMsg(1,'你填写的著作本人字数必须全为数字且不超过10位');
       }elseif (strlen($datas->op_integral) > 10
           || !is_numeric($datas->op_integral)){
           return showMsg(1,'你填写的著作积分必须全为数字且不超过10位');
       }elseif (strlen($datas->op_cate_research) > 20){
           return showMsg(1,'你填写的著作研究类别名称过长');
       }else{
           return showMsg(0,'验证通过');
       }
    }
    //验证获奖字段
    function judgeAwardField($datas){
       if(emptyarray($datas)){
           return showMsg(1,'你填写的信息不完整');
       }
       if(strlen($datas->aw_first_author) > 15){
           return showMsg(1,'你输入的第一获奖人姓名过长');
       }elseif (strlen($datas->prize_win_name) > 40){
           return showMsg(1,'你输入的获奖成果名称过长');
       }elseif (strlen($datas->award_name) > 20){
           return showMsg(1,'你输入的奖励名称过长');
       }elseif (strlen($datas->aw_grant_unit) > 40){
           return showMsg(1,'你输入的授予单位过长');
       }elseif (strlen($datas->aw_certi_number) > 30){
           return showMsg(1,'你输入的证书编号过长');
       }elseif (!is_numeric($datas->aw_integral)
           || strlen($datas->aw_integral) > 10){
           return showMsg(1,'你输入的积分必须全为数字且不超过10位');
       }else{
           return showMsg(0,'验证通过');
       }
    }
    //验证专利字段
    function judgePatenField($datas){
        if(emptyarray($datas)){
            return showMsg(1,'你输入的信息不完整');
        }
        if(strlen($datas->first_inventor) > 10){
            return showMsg(1,'你输入的第一发明人名字过长');
        }elseif (strlen($datas->pa_name) > 50){
            return showMsg(1,'你输入的专利名字过长');
        }elseif (strlen($datas->author_num) > 30){
            return showMsg(1,'你输入的授权编号过长');
        }elseif (!is_numeric($datas->author_cert_num)
                 || strlen($datas->author_cert_num) >10){
            return showMsg(1,'你输入的授权证书编号必须全为数字且不超过10位');
        }elseif (!is_numeric($datas->pa_integral)
            ||strlen($datas->pa_integral) > 10){
            return showMsg(1,'你输入的积分必须全为数字且不超过10位');
        }else{
            return showMsg(0,'通过验证');
        }
    }
    //验证鉴定字段
    function judgeAppraisalField($datas){
        if(emptyarray($datas)){
            return showMsg(1,'你输入的信息不完整');
        }
        if(strlen($datas->ap_first_author) > 15){
            return showMsg(1,'你输入的鉴定第一作者名字过长');
        }elseif (strlen($datas->ap_res_name) > 20){
            return showMsg(1,'你输入的鉴定成果名称过长');
        }elseif (strlen($datas->ap_form) > 30){
            return showMsg(1,'你输入的鉴定形式过长');
        }elseif (strlen($datas->ap_num) > 20){
            return showMsg(1,'你输入的鉴定编号过长');
        }elseif (strlen($datas->ap_integral) > 10
                || !is_numeric($datas->ap_integral)){
            return showMsg(1,'你输入的积分必须全为数字且不超过10位');
        }else{
            return showMsg(0,'验证通过');
        }
    }
    //验证举办会议字段
    function judgeHoldmeetField($datas){
        if(emptyarray($datas)){
            return showMsg(1,'你输入的信息不完整');
        }
        if(strlen($datas->ho_name) > 50){
            return showMsg(1,'你输入的会议名称过长');
        }elseif (strlen($datas->people_num) > 6
                || !is_numeric($datas->people_num)){
            return showMsg(1,'你输入的会议参加人数必须全为数字且不超过7位');
        }elseif (strlen($datas->ho_unit) > 50){
            return showMsg(1,'你输入的会议主办方单位名字过长');
        }elseif (strlen($datas->undertake_unit) > 50){
            return showMsg(1,'你输入的会议承办方单位名字过长');
        }else{
            return showMsg(0,'验证通过');
        }
    }
    //验证参加会议字段
    function judgeJoinmeetField(){

    }
    //验证讲学字段
    function judgeLectureField(){

    }
    //上传前先判断文件是否接收成功
    function judgeReceiveFiles($certificate_pdf){
       if($certificate_pdf->getClientOriginalExtension() != 'pdf'){
           return showMsg(1,'请你上传PDF文件');
       }
       if(!$certificate_pdf->isValid()){
           return showMsg(1,'上传失败,请重新上传');
       }
       return showMsg(0);
    }
    //上传文件
    function uploadFiles($subjection,$artical_file){
        $originalName = $artical_file->getClientOriginalName();
        $artical_file->storeAs($subjection,$originalName);
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
    //判断上传的文件是否为图片
    function judgeFileImage($certificate_image){
        $fileTypes = array('jpg','png','jpeg');
        $extension = $certificate_image->getClientOriginalExtension();
        $isInFileType = in_array($extension,$fileTypes);
        if(!$isInFileType){
            return showMsg(1,'你上传的图片不合法');
        }
        if(!$certificate_image->isValid()){
            return showMsg(1,'上传失败,请重新上传');
        }
        return showMsg(0);
    }
    //上传多个图片
    function uploadAllImgs($subjection,$files){
        $image_road = [];
        for($i = 0; $i < count($files); $i++){
            $new_image_road = uploadFiles($subjection,$files[$i]);
            $image_road[$i] = $new_image_road;
        }
        return $image_road;
    }
    //删除多个图片
    function deleteAllImgs($disk,$files_road){
        for($i = 0; $i < count($files_road); $i++){
            deletefiles($disk,$files_road[$i]);
        }
    }
    //验证多张图片
    function judgeAllFileImage($files_images){
        $status        = true;
        $success_image = [];
        $error_image   = [];
        for($i = 0; $i < count($files_images); $i++){
            $judge_image = judgeFileImage($files_images[$i]);
            if($judge_image->code == 1){
                $status = false;
                $image_name = $files_images[$i]->getClientOriginalName();
                $error_image[$image_name] = $judge_image->message;
            }else{
                array_push($files_images[$i],$success_image);
            }
        }
        $image_datas['error_images'] = $error_image;
        $image_datas['success_images']     = $success_image;
        if($status){
            return showMsg(0,'验证通过');
        }
        return showMsg(1,'验证存在错误',$image_datas);
    }
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


