<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Login')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/front_end_login_regis/images/icons/favicon.ico"/>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/front_end_login_regis/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    
    <!-- Animate -->
    <link rel="stylesheet" href="/front_end_login_regis/vendor/animate/animate.css">
    
    <!-- Hamburgers -->
    <link rel="stylesheet" href="/front_end_login_regis/vendor/css-hamburgers/hamburgers.min.css">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="/front_end_login_regis/vendor/select2/select2.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/front_end_login_regis/css/util.css">
    <link rel="stylesheet" href="{{ asset('front_end_login_regis/css/main.css') }}">
    
    <!-- Error styling -->
    <link rel="stylesheet" href="/css/errors.css">
</head>
<body>
    @yield('content')
    
    <!-- Scripts -->
    <script src="/front_end_login_regis/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="/front_end_login_regis/vendor/bootstrap/js/popper.js"></script>
    <script src="/front_end_login_regis/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/front_end_login_regis/vendor/select2/select2.min.js"></script>
    <script src="/front_end_login_regis/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="/front_end_login_regis/js/main.js"></script>
</body>
</html>