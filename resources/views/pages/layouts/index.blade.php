<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>BK MP3</title>
    <base href="{{asset('')}}">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="pages/css/base.css">
    <link rel="stylesheet" href="pages/css/vendor.css">
    <link rel="stylesheet" href="pages/css/main.css">
    <link rel="stylesheet" href="pages/css/comment.css">

    <!-- script
    ================================================== -->
    <script src="pages/js/modernizr.js"></script>
    <script src="pages/js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

    <!-- pageheader
    ================================================== -->
    @include('pages.layouts.header')

    <!-- s-content
    ================================================== -->
    @yield('content')

    <!-- s-extra
    ================================================== -->
    @include('pages.layouts.extra')

    <!-- s-footer
    ================================================== -->
    @include('pages.layouts.footer')

    <!-- Java Script
    ================================================== -->
    <script src="pages/js/jquery-3.2.1.min.js"></script>
    <script src="pages/js/plugins.js"></script>
    <script src="pages/js/main.js"></script>
    @yield('script')
</body>

</html>