@extends('auth_layout')

@section('title', 'Login')

@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="/front_end_login_regis/images/8832880.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="back-button-container">
                    <a href="{{ url()->previous() }}" class="back-link">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                </div>
                
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