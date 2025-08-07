



<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login | ARJ Bangunan</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('/assets/dist/img/kaiadmin/favicon.ico')}}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('/assets/dist/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Public Sans:300,400,500,600,700"]},
			custom: {"families":["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ url('assets/dist/css/fonts.min.css') }}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('/assets/dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('/assets/dist/css/plugins.min.css')}}">
	<link rel="stylesheet" href="{{ asset('/assets/dist/css/kaiadmin.min.css')}}">
</head>
<body class="login">
	<div class="wrapper wrapper-login wrapper-login-full p-0">
		<div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
			<h1 class="title fw-bold text-white mb-3">Join Our Comunity</h1>
			<p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p>
		</div>
		<div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
			<div class="container container-login container-transparent animated fadeIn">
				<h3 class="text-center">Sign In To Admin</h3>
				<form action="{{ url('login') }}" method="post" class="login-form">
                    @csrf
					<div class="form-group">
						<label for="username"><b>Username</b></label>
						<input id="username" name="username" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password"><b>Password</b></label>
						{{-- <a href="#" class="link float-end">Forget Password ?</a> --}}
						<div class="position-relative">
							<input id="password" name="password" type="password" class="form-control" required>
							<div class="show-password">
								<i class="icon-eye"></i>
							</div>
						</div>
					</div>
					<div class="form-group form-action-d-flex mb-3">
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="rememberme">
							<label class="custom-control-label m-0" for="rememberme">Remember Me</label>
						</div>
						<button type="submit" class="btn btn-secondary col-md-5 float-end mt-3 mt-sm-0 fw-bold">Sign In</button>
					</div>
					{{-- <div class="login-account">
						<span class="msg">Don't have an account yet ?</span>
						<a href="#" id="show-signup" class="link">Sign Up</a>
					</div> --}}
				</form>
			</div>
		</div>
	</div>
	<script src="{{ asset('/assets/dist/js/core/jquery-3.7.1.min.js')}}"></script>
	
	<script src="{{ asset('/assets/dist/js/core/popper.min.js')}}"></script>
	<script src="{{ asset('/assets/dist/js/core/bootstrap.min.js')}}"></script>
	<script src="{{ asset('/assets/dist/js/kaiadmin.min.js')}}"></script>
</body>
</html>