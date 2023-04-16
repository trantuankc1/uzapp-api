<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('icons/favicon.ico') }}">
    <title>@yield('title', 'Tomosia')</title>

    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    @yield('css')
    @yield('library-head')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

    @include('admin::dashboard.shared.nav-builder')

    @include('admin::dashboard.shared.header')

    @include('admin::dashboard.shared.breadcrumb')


    <div class="c-body">
        <main class="c-main">

            @yield('content')

        </main>
        @include('admin::dashboard.shared.footer')
    </div>
</div>

<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
{{--<script src="{{ asset('js/coreui-utils.js') }}"></script>--}}
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
@yield('library-footer')
@yield('javascript')
</body>
</html>
