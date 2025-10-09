<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="/front_end_login_regis/images/icons/favicon.ico"/>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="/front_end_login_regis/vendor/bootstrap/css/bootstrap.min.css">

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
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="/front_end_login_regis/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
					@csrf
					
					<span class="login100-form-title">
						Create Account
					</span>

					<!-- Name -->
					<div class="wrap-input100 validate-input" data-validate="Name is required">
						<input class="input100" type="text" name="name" placeholder="Full Name" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<!-- Email -->
					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<!-- Password -->
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<!-- Confirm Password -->
					<div class="wrap-input100 validate-input" data-validate="Please confirm your password">
						<input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<!-- Register Button -->
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>

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
</html>

