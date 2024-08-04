<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.app.header')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('backend.app.menu')
        @include('backend.app.nav')
        <div class="right_col" role="main" style="min-height: 1000px">
            @yield('content')
        </div>
        @include('backend.app.footer_content')
        <div id="loading" style="background-image: url('{{asset('layout/images/Spinner-5.gif')}}')"></div>
    </div>
</div>
    @include('backend.app.footer')
</body>
</html>

