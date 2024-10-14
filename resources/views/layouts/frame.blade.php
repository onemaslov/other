<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--    <meta name="viewport" content="width=device-width, initial-scale={{$initialScaleValue ?? '0.1'}}">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <link rel="icon" href="{{$companyData['favicon']}}" type="image/svg+xml">--}}
{{--    <link rel="apple-touch-icon" href="{{$companyData['favicon']}}">--}}
    <title>
        Other
    </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
{{--    <link href="/themes/dashboard-builder/css/app-wms.min.css?v={{config('release.v')}}" rel="stylesheet">--}}
{{--    <link href="/assets/wms.css?v={{config('release.v')}}" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
</head>

<body class="">
    @yield('body')

{{--    @include('includes.modals')--}}
    <!-- <script src="/themes/dashboard-builder/js/app.js?v={{config('release.v')}}"></script> -->
    <script src="/themes/dashboard-builder/js/app-wms.js?v={{config('release.v')}}"></script>

{{--    <script src="/build/js/app(assets).js"></script>--}}
{{--    <script src="/build/js/my.js?v={{config('release.v')}}"></script>--}}

    <!-- <script src="/build/js/template.js?v={{config('release.v')}}"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

{{--@include('components.infoModal')--}}

{{--@if(in_array(request()->route()->uri,[--}}
{{-- 'store/stocks',--}}
{{-- 'tools/labels'--}}
{{-- ]))--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--}}
{{--@endif--}}

@yield('js')
{{--@yield('jsSection')--}}
{{--@include('includes.icons')--}}
{{--@include('includes.icons-wms')--}}

{{--@include('includes.icons.emoji')--}}
{{--@include('includes.icons.icons-8-outline')--}}
{{--@include('includes.icons.icons-16-color')--}}
{{--@include('includes.icons.icons-16-outline')--}}
{{--@include('includes.icons.icons-24-color')--}}
{{--@include('includes.icons.icons-24-outline')--}}
{{--@include('includes.icons.icons-64-color')--}}
{{--@include('includes.icons.icons-side-bar')--}}

</body>
<style>
    html {
        padding: 0;
        margin: 0;
    }
    body {
        min-height: 100vh;
        padding: 0;
        margin: 0;
        font-family: "Roboto Flex", sans-serif;
        font-size: 18px;
        color: #4a5568;
    }
    .body_content {
        display: flex;
        min-height: 100vh;
    }
    .sidebar {
        background: #101935;
        padding: 20px;
        font-size: 30px;
    }
    .content {
        width: 100%;
        background: #cacdd0;
    }
</style>
</html>
