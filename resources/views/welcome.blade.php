<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>科研系统</title>
</head>
<script src="{{ url('dist/js/jquery-3.1.1.js') }}"></script>
<script src="{{ url('dist/js/jquery-3.1.1.min.js') }}"></script>
<script>
    function login() {
        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "login" ,//url
            data: $('#form1').serialize(),
            success: function (result) {
//                console.log(result);//打印服务端返回的数据(调试用)
                if (result.status != 1) {
//                    alert("SUCCESS");
//                    window.location.href ('welcome.blade.php');
                }else{
                    alert(result.message);
//                    window.location.href ('index.blade.php');
                };
            },
            error : function() {
                alert('错误！');
            }
        });
    }
</script>
<body>
<div class="login">
    <header>
        <img src="{{asset('./dist/img/hist.png')}}" alt="">
        <h1>生命科技学院科研管理系统</h1>
    </header>

    <div class="header">
        <h3>科研管理系统</h3>
        <form action="login" method="post" id="form1">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="text" placeholder="用户名" class="name" name="usercount" required="required" autocomplete=”off”>
            <input type="password" placeholder="密码" class="password" name="userpassword" required="required" autocomplete=”off”>
            <button class="submit" onclick="login()">登录</button>
        </form>
    </div>
</div>

<div id="app"></div>

<style>
    header{
        position: relative;
    }
    header h1{
        position: absolute;
        top: 60px;
        left: 14%;
        text-align: left;
        font-weight: lighter;
        font-size: 35px;
        padding: 0 0 0 5%;
        color: #fff;
    }
    header img{
        position: absolute;
        top: 40px;
        width: 80px;
        left: 12%;
    }
    .login{
        position: relative;
        font-size: 0;
        background: url("./dist/img/bg.jpg");
        background-size: cover;
        height: 100%;
    }
    .login .header{
        width: 290px;
        height: 310px;
        background: #fff;
        position: absolute;
        top: 150px;
        right: 200px;
    }
    .login .header form{
        border: solid rgb(0, 150, 136) 1px;
    }
    h3{
        color: #fff;
        background: rgb(0, 150, 136);
        font-weight: lighter;
        text-align: center;
        font-size: 24px;
        margin: 0;
        padding: 7px 0;
    }
    input{
        border: solid rgb(0, 150, 136) 1px;
        border-radius: 2px;
        width: 71%;
        margin: 22px 13%;
        height: 25px;
        font-size: 12px;
        padding: 2px 3px;
    }
    .name{
        margin: 17% 11% 5px 13%;
    }
    .submit{
        margin: 9% 13% 16% 13%;
        background: rgb(0, 150, 136);
        color: #fff;
        height: 30px;
        width: 74%;
        border: solid rgb(0, 150, 136) 1px;
        border-radius: 3px;
    }
</style>
<script src="{{ url('dist/js/manifest.js') }}"></script>
<script src="{{ url('dist/js/vendor.js') }}"></script>
<script src="{{ url('dist/js/app.js') }}"></script>
</body>
</html>
