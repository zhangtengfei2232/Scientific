<?php
    //循环遍历数组是否存在空值
    function emptyarray($datas){
        foreach ($datas as $key => $data){
            if(is_numeric($data)){
                if($data == "")  return true;
            }else{
                if(empty($data)) return true;
            }
        }
        return false;
    }
    //判断老师字段是否合法
    function judgeTeacherField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你填写的个人信息不全',1);
        }
        $isMob = "/^1[3-5,8]{1}[0-9]{9}$/";
        $isTel = "/^([0-9]{3,4}-)?[0-9]{7,8}$/";
        //15位身份证号
        $fiveting_preg_card = "/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/";
        //18位身份证号
        $eighting_preg_card = "/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/";
        if(array_key_exists('teacher_id',$datas)){
            if(strlen($datas['teacher_id']) > 7){
                return responseTojson(1,'你输入的工号有误',1);
            }
        }
        if(strlen($datas['name']) > 15){
            return responseTojson(1,'你填写的老师姓名不合法',1);
        }elseif (strlen($datas['office_phone']) > 30
            || (!preg_match($isMob, $datas['office_phone'])
            && !preg_match($isTel, $datas['office_phone']))){
            return responseTojson(1,'你填写的办公电话有误',1);
        }elseif (strlen($datas['home_phone']) > 20
            || (!preg_match($isTel, $datas['home_phone'])
            && !preg_match($isMob, $datas['home_phone']))){
            return responseTojson(1,'你填写的住宅电话有误',1);
        }elseif (strlen($datas['phone']) > 11
            || !preg_match($isMob, $datas['phone'])){
            return responseTojson(1,'你输入的手机号有误',1);
        }elseif (strlen($datas['nation']) > 40){
            return responseTojson(1,'你输入的民族有误',1);
        }elseif (strlen($datas['admin_duties']) > 30){
            return responseTojson(1,'你输入的行政职务有误',1);
        }elseif (strlen($datas['series']) > 20){
            return responseTojson(1,'你输入的系列有误',1);
        }elseif (strlen($datas['company']) > 20){
            return responseTojson(1,'你输入的单位有误',1);
        }elseif (strlen($datas['te_re_department']) > 30){
            return responseTojson(1,'你输入的所属教研室和实验室有误',1);
        }elseif (strlen($datas['origin_work_unit']) > 20){
            return responseTojson(1,'你输入的原工作单位有误',1);
        }elseif (strlen($datas['certificate_num']) > 20){
            return responseTojson(1,'你输入的教师资格证编号有误',1);
        }elseif (strlen($datas['identity_card']) > 18
                || (!preg_match($eighting_preg_card, $datas['identity_card']) &&
                !preg_match($fiveting_preg_card,$datas['identity_card'])
                )){
            return responseTojson(1,'你输入的身份证号有误',1);
        }elseif (strlen($datas['edu_school']) > 30){
            return responseTojson(1,'你输入的毕业院校有误',1);
        }elseif (strlen($datas['work_major']) > 30){
            return responseTojson(1,'你输入的从事专业有误',1);
        }elseif (strlen($datas['belong_subject']) > 30){
            return responseTojson(1,'你输入的从事专业所属学科有误',1);
        }elseif (strlen($datas['teach_course']) > 20){
            return responseTojson(1,'你输入的任教课程有误',1);
        }elseif (strlen($datas['first_graduate_school']) > 30){
            return responseTojson(1,'你输入的老师第一学历毕业学校有误',1);
        }elseif (strlen($datas['first_study_major']) > 20){
            return responseTojson(1,'你输入的老师第一学历专业有误',1);
        }elseif (strlen($datas['most_graduate_school']) > 30){
            return responseTojson(1,'你输入的老师最高学历专业有误',1);
        }elseif (strlen($datas['most_study_major']) > 20){
            return responseTojson(1,'你输入的老师最高学历专业有误',1);
        }elseif (strlen($datas['master_company']) > 100){
            return responseTojson(1,'你输入的老师硕博导授予单位有误',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //判断论文字段是否合法
    function judgeArticalField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你填写的的论文信息不全',1);
        }
        if(strlen($datas->title) > 90){
            return responseTojson(1,'你输入的论文题目不合法',1);
        }elseif (strlen($datas['author']) > 12){
            return responseTojson(1,'你输入作者姓名不合法',1);
        }elseif (strlen($datas['publication_name']) > 30){
            return responseTojson(1,'你输入刊物名称不合法',1);
        }elseif (strlen($datas['publication_num']) > 20){
            return responseTojson(1,'你输入的刊号不合法',1);
        }elseif (!preg_match("/^[0-9]*$/",$datas['num_words'])
            || strlen($datas['num_words']) > 9){
            return responseTojson(1,'你输入的论文字数必须为数字，且不能超过9位',1);
        }elseif (strlen($datas['periodical_cate']) > 10){
            return responseTojson(1,'你输入的期刊类别不合法',1);
        }elseif (strlen($datas['belong_project']) > 20){
            return responseTojson(1,'你输入的所属项目名称不合法',1);
        }elseif (strlen($datas['art_cate_research']) > 20){
            return responseTojson(1,'你输入的研究类别名称不合法',1);
        }elseif (!preg_match("/^[0-9]*$/",$datas['art_integral'])
            || strlen($datas['art_integral']) > 9){
            return responseTojson(1,'你输入的积分必须为数字，且不能超过9位',1);
        }elseif (strlen($datas['sch_percal_cate']) > 20){
            return responseTojson(1,'你输入的学校认证期刊级别有误',1);
        }else{
            return responseTojson(0,'验证通过');
        }
    }
    //验证项目字段
    function judgeProjectField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你填写的的项目信息不全',1);
        }
        if(strlen($datas['pro_host']) > 10){
            return responseTojson(1,'你输入的主持人有误',1);
        }elseif (strlen($datas['entry_name']) > 40){
            return responseTojson(1,'你输入的项目名称过长',1);
        }elseif (strlen($datas['project_category']) > 20){
            return responseTojson(1,'你输入的项目类别名过长',1);
        }elseif (strlen($datas['approval_unit']) > 20){
            return responseTojson(1,'你输入的批准单位名字过长',1);
        }elseif (!preg_match("/^[0-9]*$/",$datas['approval_funds'])
            || strlen($datas['approval_funds']) > 9){
            return responseTojson(1,'你输入的批准经费必须全为数字且不超过9位',1);
        }elseif (!preg_match("/^[0-9]*$/",$datas['account_outlay'])
            || strlen($datas['account_outlay']) > 9){
            return responseTojson(1,'你输入的当年到账经费必须全为数字且不超过9位',1);
        }elseif (!preg_match("/^[0-9]*$/",$datas['pro_integral'])
            || strlen($datas['pro_integral']) > 9){
            return responseTojson(1,'你输入的积分必须全为数字且不超过9位',1);
        }elseif (strlen($datas['social_eco_goal']) > 50){
            return responseTojson(1,'你输入的社会经济目标过长',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //验证著作字段
    function judgeOpusField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你填写著作信息不完整',1);
        }
        if(strlen($datas['op_first_author']) > 15){
            return responseTojson(1,'你填写的著作第一作者名字过长',1);
        }elseif (strlen($datas['op_name']) > 50){
            return responseTojson(1,'你填写的著作名称过长',1);
        }elseif (strlen($datas['op_publish']) > 50){
            return responseTojson(1,'你填写的著作出版社名字过长',1);
        }elseif (strlen($datas['op_number']) > 30){
            return responseTojson(1,'你填写的著作书号过长',1);
        }elseif (strlen($datas['op_total_words']) > 9
            || !preg_match("/^[0-9]*$/",$datas['op_total_words'])){
            return responseTojson(1,'你填写的著作总字数必须全为数字且不超过9位',1);
        }elseif (strlen($datas['op_self_words']) > 9
            || !preg_match("/^[0-9]*$/",$datas['op_self_words'])){
            return responseTojson(1,'你填写的著作本人字数必须全为数字且不超过9位',1);
        }elseif (strlen($datas['op_integral']) > 9
            || !preg_match("/^[0-9]*$/",$datas['op_integral'])){
            return responseTojson(1,'你填写的著作积分必须全为数字且不超过9位',1);
        }elseif (strlen($datas['op_cate_research']) > 20){
            return responseTojson(1,'你填写的著作研究类别名称过长',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //验证获奖字段
    function judgeAwardField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你填写的信息不完整',1);
        }
        if(strlen($datas['aw_first_author']) > 15){
            return responseTojson(1,'你输入的第一获奖人姓名过长',1);
        }elseif (strlen($datas['prize_win_name']) > 40){
            return responseTojson(1,'你输入的获奖成果名称过长',1);
        }elseif (strlen($datas['award_name']) > 20){
            return responseTojson(1,'你输入的奖励名称过长',1);
        }elseif (strlen($datas['aw_grant_unit']) > 40){
            return responseTojson(1,'你输入的授予单位过长',1);
        }elseif (strlen($datas['aw_certi_number']) > 30){
            return responseTojson(1,'你输入的证书编号过长',1);
        }elseif (!preg_match("/^[0-9]*$/",$datas['aw_integral'])
            || strlen($datas['aw_integral']) > 9){
            return responseTojson(1,'你输入的积分必须全为数字且不超过9位',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //验证专利字段
    function judgePatenField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你输入的信息不完整',1);
        }
        if(strlen($datas['first_inventor']) > 10){
            return responseTojson(1,'你输入的第一发明人名字过长',1);
        }elseif (strlen($datas['pa_name']) > 50){
            return responseTojson(1,'你输入的专利名字过长',1);
        }elseif (strlen($datas['author_num']) > 30){
            return responseTojson(1,'你输入的授权编号过长',1);
        }elseif (!preg_match("/^[0-9]*$/",$datas['author_cert_num'])
            || strlen($datas['author_cert_num']) > 9){
            return responseTojson(1,'你输入的授权证书编号必须全为数字且不超过9位',1);
        }elseif (!preg_match("/^[0-9]*$/",$datas['pa_integral'])
            ||strlen($datas['pa_integral']) > 9){
            return responseTojson(1,'你输入的积分必须全为数字且不超过9位',1);
        }else{
            return responseTojson(0,'通过验证',1);
        }
    }
    //验证鉴定字段
    function judgeAppraisalField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你输入的信息不完整',1);
        }
        if(strlen($datas['ap_first_author']) > 15){
            return responseTojson(1,'你输入的鉴定第一作者名字过长',1);
        }elseif (strlen($datas['ap_res_name']) > 20){
            return responseTojson(1,'你输入的鉴定成果名称过长',1);
        }elseif (strlen($datas['ap_form']) > 30){
            return responseTojson(1,'你输入的鉴定形式过长',1);
        }elseif (strlen($datas['ap_num']) > 20){
            return responseTojson(1,'你输入的鉴定编号过长',1);
        }elseif (strlen($datas['ap_integral']) > 9
            || !preg_match("/^[0-9]*$/",$datas['ap_integral'])){
            return responseTojson(1,'你输入的积分必须全为数字且不超过9位',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //验证举办会议字段
    function judgeHoldmeetField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你输入的信息不完整',1);
        }
        if(strlen($datas['ho_name']) > 50){
            return responseTojson(1,'你输入的会议名称过长',1);
        }elseif (strlen($datas['people_num']) > 6
            || !preg_match("/^[0-9]*$/",$datas['people_num'])){
            return responseTojson(1,'你输入的会议参加人数必须全为数字且不超过7位',1);
        }elseif (strlen($datas['ho_unit']) > 50){
            return responseTojson(1,'你输入的会议主办方单位名字过长',1);
        }elseif (strlen($datas['undertake_unit']) > 50){
            return responseTojson(1,'你输入的会议承办方单位名字过长',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //验证参加会议字段
    function judgeJoinmeetField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你输入的信息不完整',1);
        }
        if(strlen($datas['jo_name']) > 50){
            return responseTojson(1,'你输入的会议名称过长',1);
        }elseif (strlen($datas['jo_hold_unit']) > 50){
            return responseTojson(1,'你输入的会议主办方单位名称过长',1);
        }elseif (strlen($datas['jo_take_unit']) > 50){
            return responseTojson(1,'你输入的会议承办方单位过长',1);
        }elseif (strlen($datas['jo_place']) > 50){
            return responseTojson(1,'你输入的会议地点名称过长',1);
        }elseif (strlen($datas['jo_art_num']) > 9
            || !preg_match("/^[0-9]*$/",$datas['jo_art_num'])){
            return responseTojson(1,'你输入的会议论文提交次数必须为数字且不超过9位',1);
        }elseif (strlen($datas['jo_title']) > 50){
            return responseTojson(1,'你输入的会议题目名称过长',1);
        }
    }
    //验证讲学字段
    function judgeLectureField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你输入的信息不完整',1);
        }
        if(strlen($datas['le_expert_name']) > 15){
            return responseTojson(1,'你输入的专家名字过长',1);
        }elseif (strlen($datas['le_report_name']) > 30){
            return responseTojson(1,'你输入的报告名称过长',1);
        }elseif (strlen($datas['le_invite_unit']) > 20){
            return responseTojson(1,'你输入的邀请单位名字过长',1);
        }else{
            return responseTojson(0,'验证成功',1);
        }
    }
    //验证担任团体职务字段
    function judgeDutiesField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你输入的信息不完整',1);
        }
        if(strlen($datas['teacher_name']) > 15){
            return responseTojson(1,'你输入的老师名字过长',1);
        }elseif (strlen($datas['du_academic']) > 10){
            return responseTojson(1,'你输入的职称名字过长',1);
        }elseif (strlen($datas['du_age']) > 4
            || !preg_match( "/^(?:[1-9]?\d|100)$/",$datas['du_age'])){
            return responseTojson(1,'你输入的年龄必须为数字且不超过4位',1);
        }elseif (strlen($datas['du_name']) > 50){
            return responseTojson(1,'你输入的担任学术团体名称过长',1);
        }elseif (strlen($datas['du_duty']) > 20){
            return responseTojson(1,'你输入的所任职务名称过长',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //验证上传校发文件字段
    function judgeSchoolfileField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你输入的信息不完整',1);
        }
        if(strlen($datas['schfile_num']) > 20){
            return responseTojson(1,'你输入的文件编号过长',1);
        }elseif (strlen($datas['schfile_name']) > 30){
            return responseTojson(1,'你输入的文件名称过长',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //验证上传教学科研合作协议字段
    function judgeAgreementField($datas){
        if(emptyarray($datas)){
            return responseTojson(1,'你输入的信息不完整',1);
        }
        if(strlen($datas['agree_name']) > 30){
            return responseTojson(1,'你输入的协议名称过长',1);
        }elseif (strlen($datas['agree_cooperate_unit']) > 50){
            return responseTojson(1,'你输入的合作单位名称过长',1);
        }else{
            return responseTojson(0,'验证通过',1);
        }
    }
    //上传前先判断文件是否接收成功
    function judgeReceiveFiles($certificate_pdf){
        if(!$certificate_pdf->isValid()){
            return responseTojson(1,'上传失败,请重新上传',1);
        }
        if($certificate_pdf->getClientOriginalExtension() != 'pdf'){
            return responseTojson(1,'请你上传PDF文件',1);
        }
        return responseTojson(0,'验证通过',1);
    }
    //判断上传的文件是否为图片
    function judgeFileImage($certificate_image){
        if(!$certificate_image->isValid()){
            return responseTojson(1,'上传失败,请重新上传',1);
        }
        $fileTypes = array('jpg','png','jpeg','JPG','PNG','JPEG');
        $extension = $certificate_image->getClientOriginalExtension();
        $isInFileType = in_array($extension,$fileTypes);
        if(!$isInFileType){
            return responseTojson(1,'你上传的图片不合法',1);
        }
        return responseTojson(0,'验证通过',1);
    }
    //验证多张图片
    function judgeAllFileImage($files_images){
        $validate        = true;
        $success_image = [];
        for($i = 0; $i < count($files_images); $i++){
            $judge_image = judgeFileImage($files_images[$i]);
            if($judge_image['code'] == 1){
                $validate = false;
                break;
            }else{
                array_push($success_image,$files_images[$i]);
            }
        }
        if($validate){
            return responseTojson(0,'验证通过',1,$success_image);
        }
        return responseTojson(1,'验证存在错误',1);
    }
    //验证身份证号
    function checkIdCard($idcard){
        // 仅仅能是18位
        if(strlen($idcard)!=18){
            return false;
        }
        // 取出本体码
        $idcard_base = substr($idcard, 0, 17);
        // 取出校验码
        $verify_code = substr($idcard, 17, 1);
        // 加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        // 校验码相应值
        $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        // 依据前17位计算校验码
        $total = 0;
        for($i=0; $i<17; $i++){
            $total += substr($idcard_base, $i, 1)*$factor[$i];
        }
        // 取模
        $mod = $total % 11;
        // 比較校验码
        if($verify_code == $verify_code_list[$mod]){
            return true;
        }else{
            return false;
        }

    }