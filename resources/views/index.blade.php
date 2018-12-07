<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>个人信息</title>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
</head>
<body>
    <div id="app"></div>
    <script src="{{ url('dist/js/manifest.js') }}"></script>
    <script src="{{ url('dist/js/vendor.js') }}"></script>
    <script src="{{ url('dist/js/app.js') }}"></script>

</body>
{{--<script>--}}
    {{--$(function () {--}}
        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
</html>
