<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>CMS | {{ $title }}</title>
		<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
		<link rel="icon" href="{{ url('assets/dist/img/LogoKabobs.png') }}" type="image/x-icon"/>

		<!-- Fonts and icons -->
		<script src="{{ url('assets/dist/js/plugin/webfont/webfont.min.js') }}"></script>
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
		<link rel="stylesheet" href="{{ url('assets/dist/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/dist/css/plugins.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/dist/css/kaiadmin.min.css') }}">

		<!-- CSS Just for demo purpose, don't include it in your project -->
		<link rel="stylesheet" href="{{ url('assets/dist/css/demo.css') }}">
	</head>
	<body>
		<div class="wrapper">
			<!-- Sidebar -->
			<div class="sidebar" data-background-color="dark">
				<div class="sidebar-logo">
					<!-- Logo Header -->
					<div class="logo-header" data-background-color="dark">

						<a href="{{ url('/dashboard') }}" class="logo">
							<img src="{{ url('assets/dist/img/LogoKabobs.png') }}" alt="navbar brand" class="navbar-brand" height="50">
						</a>
						<div class="nav-toggle">
							<button class="btn btn-toggle toggle-sidebar">
								<i class="gg-menu-right"></i>
							</button>
							<button class="btn btn-toggle sidenav-toggler">
								<i class="gg-menu-left"></i>
							</button>
						</div>
						<button class="topbar-toggler more">
							<i class="gg-more-vertical-alt"></i>
						</button>

					</div>
					<!-- End Logo Header -->	
				</div>	
				@include('componens.sidebar');
			</div>
			<!-- End Sidebar -->

			<div class="main-panel">
				<div class="main-header">
					<!-- Navbar Header -->
					<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

						<div class="container-fluid">
							<nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
								<div class="input-group">
									<div class="input-group-prepend">
										<button type="submit" class="btn btn-search pe-1">
											<i class="fa fa-search search-icon"></i>
										</button>
									</div>
									<input type="text" placeholder="Search ..." class="form-control">
								</div>
							</nav>

							<ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
								<li class="nav-item topbar-user dropdown hidden-caret">
									<a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
										<div class="avatar-sm">
											<img src="{{ Session::get('fotoProfil')?:asset('/assets/dist/img/avatar04.png') }}" alt="..." class="avatar-img rounded-circle">
										</div>
										<span class="profile-username">
											<span class="op-7">Hi,</span> <span class="fw-bold">{{ Auth::user()->name }}</span>
										</span>
									</a>
									<ul class="dropdown-menu dropdown-user animated fadeIn">
										<div class="dropdown-user-scroll scrollbar-outer">
											<li>
												<div class="user-box">
													<div class="avatar-lg"><img src="{{ Session::get('fotoProfil')?:asset('/assets/dist/img/avatar04.png') }}" alt="image profile" class="avatar-img rounded"></div>
													<div class="u-text">
														<h4>{{ Auth::user()->name }}</h4>
														<p class="text-muted">{{ Auth::user()->role }}</p><a href="{{ url('profile') }}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
													</div>
												</div>
											</li>
											<li>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
											</li>
										</div>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
					<!-- End Navbar -->
				</div>
				
				<div class="container">
					<div class="page-inner">
						<div class="page-header">
							<h3 class="fw-bold mb-3">{{ $title }}</h3>
								<ul class="breadcrumbs mb-3">
									<li class="nav-home">
										<a href="/">
										<i class="icon-home"></i>
										</a>
									</li>
									<li class="separator">
										<i class="icon-arrow-right"></i>
									</li>
									<li class="nav-item">
										<a href="">{{ $title }}</a>
									</li>
									<li class="separator">
										<i class="icon-arrow-right"></i>
									</li>
									<li class="nav-item">
										<a href="">{{ $subTitle }}</a>
									</li>
								</ul>
							</div>
							@yield('content')
					</div>
				</div>
			</div>
		</div>
		<!--   Core JS Files   -->
		<script src="{{ asset('/assets/dist/js/core/jquery-3.7.1.min.js') }}"></script>
		<script src="{{ asset('/assets/dist/js/core/popper.min.js') }}"></script>
		<script src="{{ asset('/assets/dist/js/core/bootstrap.min.js') }}"></script>

		<!-- jQuery Scrollbar -->
		<script src="{{ asset('/assets/dist/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

		<!-- Chart JS -->
		<script src="{{ asset('/assets/dist/js/plugin/chart.js/chart.min.js') }}"></script>

		<!-- jQuery Sparkline -->
		<script src="{{ asset('/assets/dist/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

		<!-- Chart Circle -->
		<script src="{{ asset('/assets/dist/js/plugin/chart-circle/circles.min.js') }}"></script>

		<!-- Datatables -->
		<script src="{{ asset('/assets/dist/js/plugin/datatables/datatables.min.js') }}"></script>

		<!-- Bootstrap Notify -->
		<script src="{{ asset('/assets/dist/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

		<!-- jQuery Vector Maps -->
		<script src="{{ asset('/assets/dist/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
		<script src="{{ asset('/assets/dist/js/plugin/jsvectormap/world.js') }}"></script>

		<!-- Sweet Alert -->
		<script src="{{ asset('/assets/dist/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

		<!-- Kaiadmin JS -->
		<script src="{{ asset('/assets/dist/js/kaiadmin.min.js') }}"></script>
		@stack('script')
	</body>
</html>