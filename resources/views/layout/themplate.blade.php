<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="{{ asset("asset/img/pavinglogo.png") }}" type="image/x-icon">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>PD.MJA Paving Block Bandung</title>

		<link type="text/css" rel="stylesheet" href="{{ asset('asset/css/lightslider.css')}}" />     
		<script src="{{ asset('asset/js/jquery.min.js') }}"></script>             
		<script src="{{asset('asset/js/lightslider.js')}}"></script>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{ asset('asset/css/slick.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ asset('asset/css/slick-theme.css') }}"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="{{ asset('asset/css/nouislider.min.css') }}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{ asset('asset/css/font-awesome.min.css') }}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ asset('asset/css/style.css') }}"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		@if (session('alert'))

			@php
				echo '<script language="javascript">';
				echo 'alert("'. session('alert') .'")';  //not showing an alert box.
				echo '</script>';
			@endphp
			
		@endif
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="https://wa.me/+6282320297768?text=Hy%2C%20saya%20ingin%20"><i class="fa fa-phone"></i> 0823-2029-7768</a></li>
						<li><a href="mailto:mja.paving@gmail.com"><i class="fa fa-envelope-o"></i> mja.paving@gmail.com</a></li>
						<li><a href="https://goo.gl/maps/Koq5oKXAugbaRhRz5"><i class="fa fa-map-marker"></i> Paving Block Bandung - PD MJA</a></li>
					</ul>
					<ul class="header-links pull-right">
						@if (Auth::check())
							<li><a href="{{ route('store.profile') }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a></li>
							<li><a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-arrow-right"></i> Logout</a></li>
							<form action="{{ route('store.logout') }}" method="POST" id="logout-form">
								@csrf
							</form>
						@else
							<li><a href="javascript:void(0)" data-toggle="modal" data-target="#ModalLogin"><i class="fa fa-user"></i> Sign In</a></li>
							<li><a href="javascript:void(0)" data-toggle="modal" data-target="#ModalRegister"><i class="fa fa-user-o"></i> Register</a></li>
						@endif
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header" style="background: #000000;">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="{{asset('asset/img/logonavfinal.png')}}" alt="" style="width: 200px; height: 60px;">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<div class="col-md-6">
							<marquee behavior="" direction="" style="color:white; font-size: 5rem; weight:bold">Selamat Datang Di PD.MJA</marquee>
						</div>

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								@if ( Auth::check() )	
									<!-- Cart -->
									<div class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
											<i class="fa fa-shopping-cart"></i>
											<span>Your Cart</span>
											<div class="qty">{{ $user_cart_count }}</div>
										</a>
										<div class="cart-dropdown">
											<div class="cart-list">
												@php
													$total = [0];
												@endphp	

												@if ( empty($user_cart) )
													Empty													
												@else
													@foreach ($user_cart as $row)	
														<div class="product-widget">
															@php
																$item = collect(DB::select("select * from items where product_id = '". $row->product_id . "'"))->first();
																if ($item->product_discount != 0) {
																	$price = $item->product_price;
																	$discount = $item->product_discount;
																	$sum_discount = (($discount * 1) / 100) * $price;
																	$newPrice = $price - $sum_discount;
																} else {
																	$newPrice = $item->product_price;
																}
																$sum_price = $newPrice * $row->product_quantity;
																array_push($total, $sum_price);
																$imageArray = explode(', ', $item->product_image);
															@endphp
															<div class="product-img">
																<img src="{{ asset('image_item/' . $imageArray[0]) }}" style="height: 60px" alt="">
															</div>
															<div class="product-body">
																<h3 class="product-name"><a href="#">{{ $row->product_name }}</a></h3>
																<h4 class="product-price"><span class="qty">{{ $row->product_quantity }}x</span>Rp. {{ number_format($sum_price) }}</h4>
															</div>
															<button class="delete"><i class="fa fa-close"></i></button>
														</div>
													@endforeach
												@endif
											</div>
											<div class="cart-summary">
												<small>{{ $user_cart_count }} Item(s) selected</small>
												<h5>SUBTOTAL: Rp. {{ number_format(array_sum($total)) }}</h5>
											</div>
											<div class="cart-btns">
												<a href="#">View Cart</a>
												<a href="{{ route('store.product-checkout') }}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
											</div>
										</div>
									</div>
									<!-- /Cart -->
								@endif

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li ><a href="{{ route('store.index') }}">Home</a></li>
						<li ><a href="{{ route('gallery') }}">Gallery</a></li>
						

						<li><a href="{{ route('store.all-product') }}">Paving Block</a></li>
						
						@foreach ($category as $row)
							
						@endforeach
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
        
				


        @yield('content')

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Pabrik Paving Blok PD MJA
										citaliktik no 138 Jalan Banjaran Soreang
										Bandung
										Jawa Barat 40238
										Indonesia</p>
								<ul class="footer-links">
									<li><a href="https://goo.gl/maps/Koq5oKXAugbaRhRz5"><i class="fa fa-map-marker"></i>Paving Block Bandung - PD MJA</a></li>
									<li><a href="https://wa.me/+6282320297768?text=Hy%2C%20saya%20ingin%20"><i class="fa fa-phone"></i>0823-2029-7768</a></li>
									<li><a href="mailto:mja.paving@gmail.com"><i class="fa fa-envelope-o"></i>mja.paving@gmail.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-5 col-xs-6">
							<div class="footer">
								
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.7714076298407!2d107.54484581431835!3d-7.036131170891067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ed49cb3e068b%3A0x8ecf2e1a5564beaa!2sPaving%20Block%20Bandung%20-%20PD%20MJA!5e0!3m2!1sid!2sid!4v1643234462737!5m2!1sid!2sid" 
							width="900px" height="250px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div>

						

						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- Modal Login -->
		<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width: 350px !important;" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Login</h5>
				<button type="button" class="close" data-dismiss="modal" id="loginClose" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				@if (session('message_success'))

				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>{{ session('message_success') }}</strong>
				</div>
					
				@endif
				
				@if (session('message_fail'))

				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>{{ session('message_fail') }}</strong>
				</div>
					
				@endif
				<div class="modal-body justify-content-center">

					<form action="{{ route('store.login') }}" id="loginForm" class="col-md-12" method="POST">
						
						@csrf

						<div class="form-group">
							<label for="username" class="text-gray-900">Username / Email</label>
							<input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Enter your username / email" id="username" name="username" value="{{ old('username') }}">
							@error('username')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group">
							<label for="password" class="text-gray-900">Password</label>
							<input type="password" class="form-control @error('username') is-invalid @enderror" id="password" placeholder="Enter your password" name="password">
							@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group">
							<div class="custom-control custom-checkbox small">
								<input type="checkbox" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
								<label for="customCheck" class="custom-control-label">Remember Me</label>
							</div>
						</div>
						
					</form>
				</div>
				<div class="modal-footer">
					{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
					<a href="{{ route('password.request') }}" class="" data-dismiss="modal">Forgot Passoword?</a>
					<button type="button" class="btn btn-warning">Register</button>
					<button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('loginForm').submit();">Login</button>
				</div>
			</div>
			</div>
		</div>
		
		<!-- Modal Register -->
		<div class="modal fade" id="ModalRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="width: 350px !important;" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Register</h5>
				<button type="button" class="close" data-dismiss="modal" id="registerClose" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				@if (session('message_success'))

				<div class="alert alert-success fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>{{ session('message_success') }}</strong>
				</div>
					
				@endif
				
				@if (session('message_fail'))

				<div class="alert alert-block alert-danger fade in">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<i class="icon-remove"></i>
					</button>
					<strong>{{ session('message_fail') }}</strong>
				</div>
					
				@endif
				<div class="modal-body justify-content-center">


					<form action="{{ route('store.register') }}" id="registerForm" class="col-md-12" method="POST">

						@csrf

						<div class="form-group">
							<label for="r_name" class="text-gray-900">Name</label>
							<input type="text" class="form-control @error('r_name') is-invalid @enderror" placeholder="Enter your name" id="r_name" name="r_name" value="{{ old('r_name') }}">
							@error('r_name')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group">
							<label for="r_username" class="text-gray-900">Username</label>
							<input type="text" class="form-control @error('r_username') is-invalid @enderror" placeholder="Enter your username" id="r_username" name="r_username" value="{{ old('r_username') }}">
							@error('r_username')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group">
							<label for="r_email" class="text-gray-900">Email</label>
							<input type="r_email" class="form-control @error('r_email') is-invalid @enderror" placeholder="Enter your email" id="r_email" name="r_email" value="{{ old('r_email') }}">
							@error('r_email')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group">
							<label for="r_password" class="text-gray-900">Password</label>
							<input type="password" class="form-control @error('r_password') is-invalid @enderror" placeholder="Enter your password" id="r_password" name="r_password">
							@error('r_password')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						
						<div class="form-group">
							<label for="password_confirmation" class="text-gray-900">Confirm Password</label>
							<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter your password confirmation" id="password_confirmation" name="password_confirmation">
							@error('password_confirmation')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning">Have an Account?</button>
					<button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('registerForm').submit();">Register</button>
				</div>
			</div>
			</div>
		</div>

		<!-- jQuery Plugins -->
		<script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('asset/js/slick.min.js') }}"></script>
		<script src="{{ asset('asset/js/nouislider.min.js') }}"></script>
		<script src="{{ asset('asset/js/jquery.zoom.min.js') }}"></script>
		<script src="{{ asset('asset/js/main.js') }}"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
		<script>
		</script>

		@yield('js')
	</body>
</html>
