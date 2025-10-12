@extends('main_design')

@section('register')
<head>
    <title>Register V1</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('front_end_login_regis/css/main.css') }}">
</head>

<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="/front_end_login_regis/images/8832880.png" alt="Registration illustration">
            </div>

            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf

                <span class="login100-form-title">
                    Create Account
                </span>

                {{-- Name --}}
                <div class="wrap-input100 validate-input" data-validate="Name is required">
                    <label for="name" class="sr-only">Full Name</label>
                    <input id="name" class="input100 @error('name') is-invalid @enderror"
                           type="text" name="name" value="{{ old('name') }}"
                           placeholder="Full Name" required autofocus autocomplete="name">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                </div>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror

                {{-- Email --}}
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" class="input100 @error('email') is-invalid @enderror"
                           type="email" name="email" value="{{ old('email') }}"
                           placeholder="Email" required autocomplete="username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror

                {{-- Password --}}
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" class="input100 @error('password') is-invalid @enderror"
                           type="password" name="password" placeholder="Password" required autocomplete="new-password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror

                {{-- Confirm Password --}}
                <div class="wrap-input100 validate-input" data-validate="Please confirm your password">
                    <label for="password_confirmation" class="sr-only">Confirm Password</label>
                    <input id="password_confirmation" class="input100 @error('password_confirmation') is-invalid @enderror"
                           type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                @error('password_confirmation')
                    <div class="error-text">{{ $message }}</div>
                @enderror

                {{-- Submit Button --}}
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        Register
                    </button>
                </div>

                {{-- Already registered --}}
                <div class="text-center p-t-136">
                    <a class="txt2" href="{{ route('login') }}">
                        Already have an account? Login
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
