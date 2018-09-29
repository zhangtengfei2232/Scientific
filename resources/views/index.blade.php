<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>科研系统</title>
</head>
<body>
    <div class="login">
        <header>
            <img src="{{asset('./dist/img/hist.png')}}" alt="">
            <h1>生命科技学院科研管理系统</h1>
        </header>

        <div class="header">
            <h3>科研管理系统</h3>
            <form action="login" method="post">
                {{ csrf_field() }}
                <input type="text" placeholder="用户名" class="name" name="usercount" required="required">
                <input type="password" placeholder="密码" class="password" name="userpassword" required="required">
                <input type="submit" class="submit">
            </form>
        </div>
    </div>

    {{--<div id="app"></div>--}}

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
            width: 249px;
            height: 252px;
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
            font-size: 16px;
            margin: 0;
            padding: 7px 0;
        }
        input{
            border: solid rgb(0, 150, 136) 1px;
            border-radius: 2px;
            width: 80%;
            margin: 10px 9%;
            height: 25px;
            font-size: 12px;
            padding: 2px 3px;
        }
        .name{
            margin: 17% 9% 5px 9%;
        }
        .submit{
            margin: 8% 10% 15% 10%;
            background: rgb(0, 150, 136);
            color: #fff;
            height: 30px;
            width: 80%;
        }
    </style>
    <script src="{{ url('dist/js/manifest.js') }}"></script>
    <script src="{{ url('dist/js/vendor.js') }}"></script>
    <script src="{{ url('dist/js/app.js') }}"></script>
</body>
</html>