<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>科研系统</title>
</head>
<body>
    <div id="app"></div>

    <script src="{{ url('dist/js/manifest.js') }}"></script>
    <script src="{{ url('dist/js/vendor.js') }}"></script>
    <script src="{{ url('dist/js/app.js') }}"></script>
</body>
</html>