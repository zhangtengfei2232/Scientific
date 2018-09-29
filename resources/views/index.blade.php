<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>科研系统</title>
</head>
<body>

    <header>
        <div class="logo"><img src="" alt="未加载"></div>
        <h1>生命科技学院科研管理系统</h1>
    </header>

    <div class="login">
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
        h1{
            text-align: left;
            font-weight: lighter;
            font-size: 25px;
            padding: 0 0 0 5%;
        }
        .login{
            position: relative;
            font-size: 0;
        }
        .login .header{
            width: 18%;
            height: 30%;
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
            padding: 5px 0;
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