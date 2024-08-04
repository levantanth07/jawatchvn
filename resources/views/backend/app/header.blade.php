<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="images/favicon.ico" type="image/ico" />

<title>@yield('title')</title>

<!-- Bootstrap -->
<link href="{{ asset('layout') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ asset('layout') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="{{ asset('layout') }}/vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="{{ asset('layout') }}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

<!-- bootstrap-progressbar -->
<link href="{{ asset('layout') }}/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
<!-- JQVMap -->
<link href="{{ asset('layout') }}/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('layout') }}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="{{ asset('layout') }}/build/css/custom.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    body {
        /*background: #FFF url("https://i.imgur.com/KheAuef.png") top left repeat-x;*/
    }
    #loading {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100vw;
        height: 100vh;
        background-color: #FFFFFF;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
@yield('style')
