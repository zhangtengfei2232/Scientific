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
    function judgeDatas($datas){
         if(emptyarray($datas)){
             return showMsg(1,'你填写的个人信息不全');
         }
         $isMob="/^1[3-5,8]{1}[0-9]{9}$/";
         $isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";
         $preg_card='/^\d{15}$)|(^\d{17}([0-9]|X)$/isu';
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
         }else{
             return showMsg(0,'验证通过');
         }
    }
    //判断老师-学术字段是否合法
    function judgeAcademic($academic){
        if(strlen($academic->first_graduate_school) > 30){
            return showMsg(1,'你输入的老师第一学历毕业学校有误');
        }elseif (strlen($academic->first_study_major) > 20){
            return showMsg(1,'你输入的老师第一学历专业有误');
        }elseif (strlen($academic->most_graduate_school) > 30){
            return showMsg(1,'你输入的老师最高学历专业有误');
        }elseif (strlen($academic->most_study_major) > 20){
            return showMsg(1,'你输入的老师最高学历专业有误');
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
         }elseif (strlen($datas->art_sub_category) > 10){
             return showMsg(1,'你输入的学科门类名称不合法');
         }elseif (!is_numeric($datas->art_integral)
             || strlen($datas->art_integral) > 11){
             return showMsg(1,'你输入的积分不合法');
         }
    }
    //上传前先判断文件是否接收成功
    function judgeReceiveFiles($certificate_image){
       if(!$certificate_image->isValid()){
           return showMsg(1);
       }
       return showMsg(0);
    }
    //上传单个图片
    function uploadImg($subjection,$certificate_image){
        $originalName = $certificate_image->getClientOriginalName();
        $certificate_image->storeAs($subjection,$originalName);
        $certificate_road = $subjection.'/'.$originalName;
        return $certificate_road;
    }
    //删除单个文件
    function deleteImg($disk,$certificate_road){
        if($certificate_road == null){
            return ;
        }
        Storage::disk($disk)->delete($certificate_road);
    }
    //上传文件
    function uploadFiles($subjection, $artical_file){
        $extention = $artical_file->extension();          //获取文件的扩展名
        $filename  = time().'.'.$extention;               //拼接成文件名字
        $artical_file->storeAs($subjection,$filename);
        if(!file_exists($filename)){
            return false;
        }
        return $filename;
    }
    //删除文件
    function deletefiles($filelist){
        foreach ($filelist as $file){
            Storage::disk('image')->delete($file->name);
        }

    }
    //上传多个图片
    function uploadimgs($subjection,$files){
        $image_road = [];
        for($i = 0; $i < count($files); $i++){

        }

    }
    //删除多个图片
    function deleteimgs(){

    }


