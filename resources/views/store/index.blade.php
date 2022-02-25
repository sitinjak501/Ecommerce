@extends('layout.themplate')

@section('content')
	<!-- SECTION -->
		
	<div class="top-image">
		<img src="../asset/img/banner.jpg" width="100%" height="800px" alt="">
		<div class="text-top-image text-center">
		</div>
	</div>
											
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										@foreach ($new_product as $row)	
											<!-- product -->
											<div class="product">
												<div class="product-img">
													@php
														$imageArray = explode(', ', $row->product_image)
													@endphp
													<img src="{{ asset('image_item/' . $imageArray[0]) }}" style="height: 250px;" alt="">
													<div class="product-label">
														<span class="sale">-{{ $row->product_discount }}%</span>
														<span class="new">NEW</span>
													</div>
												</div>
												<div class="product-body">
													<p class="product-category">
														@foreach ( explode(', ', $row->product_category) as $ctg)
															{{ $ctg }}
														@endforeach
													</p>
													<h3 class="product-name"><a href="#">{{ $row->product_name }}</a></h3>
													@php
														if ($row->product_discount != 0) {
															$price = $row->product_price;
															$discount = $row->product_discount;
															$sum_discount = (($discount * 1) / 100) * $price;
															$newPrice = $price - $sum_discount;
														} else {
															$newPrice = $row->product_price;
														}
													@endphp
													<h4 class="product-price">Rp. {{ number_format($newPrice) }} <del class="product-old-price">Rp. {{ number_format($row->product_price) }}</del></h4>
													<div class="product-rating">
														@php
															if ($row->product_rating != 0 && $row->product_review != 0) {
																$rating = $row->product_rating / $row->product_review;
															} else {
																$rating = 0;
															}
														@endphp

														@if ( $rating == 0 )
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														@elseif( $rating >= 1 && $rating < 2)
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>	
														@elseif( $rating >= 2 && $rating < 3)	
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														@elseif( $rating >= 3 && $rating < 4)	
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														@elseif( $rating >= 4 && $rating < 5)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>	
															<i class="fa fa-star-o"></i>
														@elseif( $rating >= 5)	
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														@endif
													</div>
													<div class="product-btns">
														<button onclick="location.href='{{ route('store.product.view', [$row->product_name]) }}'" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
													</div>
												</div>
												<div class="add-to-cart">
													<form id="add-cart{{ $loop->iteration }}" action="{{ route('store.add.cart') }}" method="POST">
														@csrf
														@method('PATCH')
														<input type="text" name="product_id" id="product_id" value="{{ $row->product_id }}" style="display: none;">
														<button class="add-to-cart-btn" type="submit" onclick="event.preventDefault(); document.getElementById('add-cart{{ $loop->iteration }}').submit();"><i class="fa fa-shopping-cart"></i> add to cart</button>
													</form>
												</div>
											</div>
											<!-- /product -->
										@endforeach
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		{{-- <ul id="imageGallery"> --}}
			{{-- @foreach ($category as $row) --}}
				{{-- @php			
					$imageArray = explode(', ', $row->product_image);
				@endphp --}}
				{{-- <li>
					<div id="hot-deal" class="section">
						<!-- container -->
						<div class="container">
							<!-- row -->
							<div class="row">
								<div class="col-md-12">
									<div class="hot-deal">
										<ul class="hot-deal-countdown">
											<li>
												<div>
													<h3>02</h3>
													<span>Days</span>
												</div>
											</li>
											<li>
												<div>
													<h3>10</h3>
													<span>Hours</span>
												</div>
											</li>
											<li>
												<div>
													<h3>34</h3>
													<span>Mins</span>
												</div>
											</li>
											<li>
												<div>
													<h3>60</h3>
													<span>Secs</span>
												</div>
											</li>
										</ul>
										<h2 class="text-uppercase">hot deal this week</h2>
										<p>New Collection Up to 50% OFF</p>
										<a class="primary-btn cta-btn" href="#">Shop now</a>
									</div>
								</div>
							</div>
							<!-- /row -->
						</div>
						<!-- /container -->
					</div>
				</li> --}}
			{{-- @endforeach --}}
		  {{-- </ul> --}}
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top selling</h3>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										@foreach ($top_selling_product as $row)	
											<!-- product -->
											<div class="product">
												<div class="product-img">
													@php
														$image = collect(DB::select("select * from items where product_id = '". $row->product_id . "'"))->first();
														
														$imageArray = explode(', ', $image->product_image);
													@endphp
													<img src="{{ asset('image_item/' . $imageArray[0]) }}" style="height: 250px;" alt="">
													<div class="product-label">
														<span class="sale">-{{ $row->product_discount }}%</span>
														@if ( $row->created_at->format('d') < $row->created_at->format('d') + 5 )
															<span class="new">NEW</span>
														@endif
													</div>
												</div>
												<div class="product-body">
													<p class="product-category">
														@foreach ( explode(', ', $row->product_category) as $ctg)
															{{ $ctg }}
														@endforeach
													</p>
													<h3 class="product-name"><a href="#">{{ $row->product_name }}</a></h3>
													@php
														if ($row->product_discount != 0) {
															$price = $row->product_price;
															$discount = $row->product_discount;
															$sum_discount = (($discount * 1) / 100) * $price;
															$newPrice = $price - $sum_discount;
														} else {
															$newPrice = $row->product_price;
														}
													@endphp
													<h4 class="product-price">Rp. {{ number_format($newPrice) }} <del class="product-old-price">Rp. {{ number_format($row->product_price) }}</del></h4>
													<div class="product-rating">
														@php
															if ($row->product_rating != 0 && $row->product_review != 0) {
																$rating = $row->product_rating / $row->product_review;
															} else {
																$rating = 0;
															}
														@endphp

														@if ( $rating == 0 )
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														@elseif( $rating >= 1 && $rating < 2)
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>	
														@elseif( $rating >= 2 && $rating < 3)	
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														@elseif( $rating >= 3 && $rating < 4)	
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														@elseif( $rating >= 4 && $rating < 5)
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>	
															<i class="fa fa-star-o"></i>
														@elseif( $rating >= 5)	
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														@endif
													</div>
													<div class="product-btns">
														<button onclick="location.href='{{ route('store.product.view', [$row->product_name]) }}'" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
													</div>
												</div>
												<div class="add-to-cart">
													<form id="add-cart{{ $loop->iteration }}" action="{{ route('store.add.cart') }}" method="POST">
														@csrf
														@method('PATCH')
														<input type="text" name="product_id" id="product_id" value="{{ $row->product_id }}" style="display: none;">
														<button class="add-to-cart-btn" type="submit" onclick="event.preventDefault(); document.getElementById('add-cart{{ $loop->iteration }}').submit();"><i class="fa fa-shopping-cart"></i> add to cart</button>
													</form>
												</div>
											</div>
											<!-- /product -->
										@endforeach
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<!-- <h2>Alamat</h2>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.7714076298407!2d107.54484581431835!3d-7.036131170891067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ed49cb3e068b%3A0x8ecf2e1a5564beaa!2sPaving%20Block%20Bandung%20-%20PD%20MJA!5e0!3m2!1sid!2sid!4v1643234462737!5m2!1sid!2sid" 
							width="1080px" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection

@section('js')
	
	<script>
		$(document).ready(function() {
			$('#imageGallery').lightSlider({
				item:1,
				loop:true,
				slideMargin:0,
				enableDrag: false,
				currentPagerPosition:'left',
				onSliderLoad: function(el) {
					el.lightGallery({
						selector: '#imageGallery .lslide'
					});
				}   
			});  
		});
	</script>

@endsection