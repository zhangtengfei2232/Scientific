<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>科研系统</title>
</head>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/layer/layer.js') }}"></script>
<body>
<div class="login">

    <div class="left">
        <img src="./dist/img/hist.png" alt="" id="histLogo">
        <img src="./dist/img/header1.jpg" alt="">
    </div>
    <div class="right">
        <div class="header">
            <h3 style="font-weight: 600;color: rgb(59,126,46);">登 &nbsp;&nbsp;&nbsp;录</h3>
            <form id="form1">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <input type="text" placeholder="用户名" class="name" id="username" name="username" required="required" autocomplete=”off”>
                <input type="password" placeholder="密码" class="password" id="userpassword" name="userpassword" required="required" autocomplete=”off”>
                <button type="button" class="submit" id="login_btn">登 录</button>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>



<style>
    #histLogo{
        width: 12%;
        margin: 5% 0 0 5%;
    }
    body{
        margin: 0;
        overflow: hidden;
    }
    .left{
        float:left;
        width: 60%;
        height: 100%;
        background: url("./dist/img/bg1.jpg");
        background-size: cover;
    }
    .left img:nth-child(2){
        width: 100%;
        margin: 3% 0% 45% 0%;

    }
    .right{
        float:left;
        width: 40%;
        height: 100%;
    }
    .clear{
        content: '';
        clear: both;
    }
    .header{
        width: 80%;
        margin: 20% 10% 30% 10%;
    }
    .header h3{
        text-align: center;
        font-size: 28px;
        font-weight: lighter;
    }
    p{
        text-align: left;
        margin-left: 10%;
    }
    input{
        width: 80%;
        height: 40px;
        margin: 5% 10%;
        border: 1px solid rgb(59,126,46);
        border-radius: 5px;
        padding-left: 10px;
    }
    .submit{
        width: 82%;
        height: 40px;
        margin: 8% 10%;
        border: 1px solid rgb(59,126,46);
        border-radius: 5px;
        background: rgb(59,126,46);
        color: white;
        font-weight: bold;
    }
</style>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $("#login_btn").click(function(){
        sendLognInfor();
     });
     $("#userpassword").bind("keydown",function(e){
        var theEvent = e || window.event;
        var code = theEvent.keyCode || theEvent.which || theEvent.charCode;
        if (code == 13) {
            sendLognInfor();
        }
      });
     function sendLognInfor() {
         var username = $.trim($("#username").val());
         var userpassword = $.trim($("#userpassword").val());
         if(username == ""){
             layer.alert("请输入用户");
             return false;
         }else if(userpassword == ""){
             layer.alert("请输入密码");
             return false;
         }
         //ajax去服务器端校验
         var data= {usercount:username,userpassword:userpassword};
         $.ajax({
             type:"POST",
             url:"login",
             data:data,
             dataType:'json',
             success:function(data){
                 if(data.code == 0){
                     window.location.href='/indexpage';
                 }else{
                     layer.alert(data.message);
                     return false;
                 }
             }
         });
     }
</script>
</body>
</html>
