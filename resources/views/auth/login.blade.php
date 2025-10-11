@extends('main_design')
<base href="/public">
@section('login')
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/front_end_login_regis/images/icons/favicon.ico"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="/front_end_login_regis/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="/front_end_login_regis/vendor/animate/animate.css">

    <!-- Hamburgers -->
    <link rel="stylesheet" type="text/css" href="/front_end_login_regis/vendor/css-hamburgers/hamburgers.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="/front_end_login_regis/vendor/select2/select2.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="/front_end_login_regis/css/util.css">
    <link rel="stylesheet" type="text/css" href="/front_end_login_regis/css/main.css">

    <!-- Error styling -->
    <link rel="stylesheet" href="/css/errors.css">
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="/front_end_login_regis/images/8832880.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <span class="login100-form-title">
                        Login
                    </span>

                    <!-- Email -->
                    <div class="wrap-input100 validate-input">
                        <input 
                            class="input100 @error('email') is-invalid @enderror" 
                            type="email" 
                            name="email" 
                            placeholder="Email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                        >
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror

                    <!-- Password -->
                    <div class="wrap-input100 validate-input">
                        <input 
                            class="input100 @error('password') is-invalid @enderror" 
                            type="password" 
                            name="password" 
                            placeholder="Password" 
                            required
                        >
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                    
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">Forgot</span>
                        <a class="txt2" href="{{ route('password.request') }}">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="{{ route('register') }}">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
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

@endsection
