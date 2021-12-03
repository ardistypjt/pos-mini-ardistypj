<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>	
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets_cust/assets/images/favicon.ico')}}">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets_cust/assets/css/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets_cust/assets/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets_cust/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets_cust/assets/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets_cust/assets/css/flexslider.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets_cust/assets/css/chosen.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets_cust/assets/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assets_cust/assets/css/color-01.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
	@stack('styles')
	@livewireStyles
</head>

<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	<header id="header" class="header header-style-1">
		<div class="container-fluid">
			<div class="row">
				<div class="topbar-menu-area">
					<div class="container">
						<div class="topbar-menu left-menu">
							
						</div>
						<div class="topbar-menu right-menu">
							<ul>
								
								
								
								@if (Route::has('login'))
									@auth
										@if (Auth::user()->roles === 'Admin')
											<li class="menu-item menu-item-has-children parent" >
												<a title="My Account" href="#">My Account ({{ Auth::user()->name}})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
												<ul class="submenu curency" >
													<li class="menu-item" >
														<a title="Dashboard" href="{{ route('admin.dashboard')}}">Dashboard</a>
														
													</li>
													<li class="menu-item" >
														<form method="POST" action="{{ route('logout') }}">
															@csrf
							
															<a href="{{ route('logout') }}"
																	 onclick="event.preventDefault();
																			this.closest('form').submit();">
																Logout
															</a>
														</form>
													</li>
												</ul>
											</li>
										@else
											<li class="menu-item menu-item-has-children parent" >
												<a title="My Account" href="#">My Account ({{ Auth::user()->name}})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
												<ul class="submenu curency" >
													<li class="menu-item" >
														<a title="Dashboard" href="{{ route('user.dashboard')}}">Dashboard</a>
													</li>
													<li class="menu-item" >
														<form method="POST" action="{{ route('logout') }}">
															@csrf
							
															<a href="{{ route('logout') }}"
																	 onclick="event.preventDefault();
																			this.closest('form').submit();">
																Logout
															</a>
														</form>
													</li>
												</ul>
											</li>
										@endif	
								@else
									<li class="menu-item" ><a title="Register or Login" href="{{ route('login') }}">Login</a></li>
									<li class="menu-item" ><a title="Register or Login" href="{{ route('register')}}">Register</a></li>
									@endauth
								@endif
							</ul>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="mid-section main-info-area">

						<div class="wrap-logo-top left-section">
							<a href="{{ route('/')}}" class="link-to-home"><img src="https://majoo.id/assets/download/logo_icon/majoo_logo_icon_2.png" alt="mercado"></a>
						</div>

						@livewire('header-search-component')

						<div class="wrap-icon right-section">
							<div class="wrap-icon-section minicart">
								<a href="#" class="link-direction">
									<i class="fa fa-shopping-basket" aria-hidden="true"></i>
									<div class="left-info">
										@if (Cart::count() > 0)
											<span class="index">{{Cart::count()}} items</span>
											<span class="title">CART</span>
										@endif
									</div>
								</a>
							</div>
							<div class="wrap-icon-section show-up-after-1024">
								<a href="#" class="mobile-navigation">
									<span></span>
									<span></span>
									<span></span>
								</a>
							</div>
						</div>

					</div>
				</div>

				

					<div class="primary-nav-section">
						<div class="container">
							<ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
								<li class="menu-item home-icon">
									<a href="{{ route('/')}}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
								</li>
								<li class="menu-item">
									<a href="{{ route('shop')}}" class="link-term mercado-item-title">Shop</a>
								</li>
								<li class="menu-item">
									<a href="{{ route('cart')}}" class="link-term mercado-item-title">Cart</a>
								</li>
																							
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	{{$slot}}

	<footer id="footer">
		<div class="wrap-footer-content footer-style-1">

			<!--End function info-->

			<div class="coppy-right-box">
				<div class="container">
					<div class="coppy-right-item item-left">
						<p class="coppy-right-text">Copyright © 2021 PT. Majoo Teknologi Indonesia. All rights reserved</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</footer>
	
	<script src="{{ asset ('assets_cust/assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{ asset ('assets_cust/assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{ asset ('assets_cust/assets/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset ('assets_cust/assets/js/jquery.flexslider.js')}}"></script>
	{{-- <script src="{{ asset ('assets_cust/assets/js/chosen.jquery.min.js')}}"></script> --}}
	<script src="{{ asset ('assets_cust/assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{ asset ('assets_cust/assets/js/jquery.countdown.min.js')}}"></script>
	<script src="{{ asset ('assets_cust/assets/js/jquery.sticky.js')}}"></script>
	<script src="{{ asset ('assets_cust/assets/js/functions.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
	@stack('scripts')
	{!! Toastr::message() !!}
	@livewireScripts
</body>
</html>