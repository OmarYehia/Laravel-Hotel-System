<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> -->
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> -->
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/jqvmap/jqvmap.min.css') }}"> -->

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte-resources/dist/css/adminlte.min.css') }}">
    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    <!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> -->
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/daterangepicker/daterangepicker.css') }}"> -->
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/summernote/summernote-bs4.min.css') }}"> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">