<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>科研系统</title>
</head>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<body>
<div class="login">
    <div class="left">
        <img src="{{asset('./dist/img/header.png')}}" alt="">
    </div>
    <div class="right">
        <div class="header">
            <h3>LOGIN</h3>
            <p>Login with your account</p>
            <form id="form1">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <input type="text" placeholder="用户名" class="name" name="usercount" required="required" autocomplete=”off”>
                <input type="password" placeholder="密码" class="password" name="userpassword" required="required" autocomplete=”off”>
                <button type="button" class="submit" onclick="login()">Login</button>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>
<style>
    body{
        margin: 0;
        overflow: hidden;
    }
    .left{
        float:left;
        width: 60%;
        height: 100%;
        background: url("./dist/img/bg.jpg");
        background-size: cover;
    }
    .left img{
        width: 40%;
        margin: 20% 30% 45% 30%;

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
        border: 1px solid #bcbcbc;
        border-radius: 5px;
        padding-left: 10px;
    }
    .submit{
        width: 82%;
        height: 40px;
        margin: 8% 10%;
        border: 1px solid #a0adcd;
        border-radius: 5px;
        background: #fff;
        color: #a0adcd;
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
    function login() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "login" ,
            data: $('#form1').serialize(),
            success: function (result) {
                if (result.status != 1) {
                    location.href='indexpage';
                }else{
                    alert(result.message);
                };
            },
            error : function() {
                alert('错误！');
            }
        });
    }
</script>
</body>
</html>
