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
        <div class="logo"><img src="" alt=""></div>
        <h1>生命科技学院科研管理系统</h1>
    </header>

    <div class="login">
        <div class="header">
            <h3>科研管理系统</h3>
            <form action="">
                <input type="text" placeholder="用户名" class="name">
                <input type="password" placeholder="密码" class="password">
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
            width: 200px;
            height: 220px;
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
            width: 160px;
            margin: 10px 15px;
            height: 20px;
            font-size: 12px;
            padding: 2px 3px;
        }
        .name{
            margin: 17% 20px 5px 15px;
        }
        .submit{
            margin: 8% 20px 15% 15px;
            background: rgb(0, 150, 136);
            color: #fff;
            height: 25px;
            width: 167px;
        }
    </style>
    <script src="{{ url('dist/js/manifest.js') }}"></script>
    <script src="{{ url('dist/js/vendor.js') }}"></script>
    <script src="{{ url('dist/js/app.js') }}"></script>
</body>
</html>