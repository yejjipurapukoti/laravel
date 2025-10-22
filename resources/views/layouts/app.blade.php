<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">

    <title>@yield('title', 'FGM Admin')</title>

    <!-- Common Vendors Style-->
    <link rel="stylesheet" href="{{ asset('assets/src/css/vendors_css.css') }}">
@stack('vendor-styles')

<!-- Common Styles-->
    <link rel="stylesheet" href="{{ asset('assets/src/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/css/skin_color.css') }}">
    @stack('styles')
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

<!-- wrapper -->
<div class="wrapper">
    <div id="loader"></div>

@section('header')
    @include('layouts.header')
@show

@section('sidebar')
    @include('layouts.sidebar')
@show

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
        @yield('content')
        <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->

@section('footer')
    @include('layouts.footer')
@show

<!-- Side panel -->
    <!-- quick_user_toggle -->
@section('sidepanel')
    @include('layouts.sidepanel')
@show
<!-- /quick_user_toggle -->
    <!-- /.Side panel -->

    <!-- Control Sidebar -->
@section('control-sidebar')
    @include('layouts.control-sidebar')
@show
<!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- Chat-box -->
{{--@section('chat-box')
@include('layouts.chat-box')
@show--}}
<!-- /.Chat-box -->

<!-- cdn scripts -->
@stack('cdn-scripts')

<!-- Common Vendor Scripts -->
<script src="{{ asset('assets/src/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/js/pages/chat-popup.js') }}"></script>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>

@stack('vendor-scripts')

<!-- Common EV Admin App -->
<script src="{{ asset('assets/src/js/demo.js') }}"></script>
<script src="{{ asset('assets/src/js/template.js') }}"></script>

@stack('admin-scripts')

@stack('scripts')

</body>
</html>
