@extends('layouts.app')
@section('content')



	<div class="container">
		<main>
			<div class="slider">
				<div class="slide-1">
					<img src="img/slider/slide-1.jpg">
					<div class="slider-text">
						<h3>Sale 40% off</h3>
						<h2>Men's Watches</h2>
						<a href="#">Shop Now</a>
					</div>
				</div>
 			</div> <!-- slider -->

			<div class="new-product-section">
				<div class="product-section-heading">
					<h2>Tranding Products <img src="img/icons/increase.png"></h2>
 				</div>
				<div class="product-content">

                    @foreach ($products['data'] as $product)

					<div class="product">
						
						 <a href="{{route("product",$product['id'])}}"> 
							<img src="{{ url( $product['image']) }}" alt="Product Image"> 
						</a>
						
						<div class="product-detail">
							<h5 style="display: inline-block !important; color: #2F4F4F; " >{{$product['title']}}</h5> 
							<h2 style="display: inline-block !important ;  float: right ; margin-right: 15px; ">{{$product['in_stock']}}</h2> 
						</div>
		<div class="clear"></div>
						<div class="product-detail"> 
								<a href="{{route("AddToCart",$product['id'])}}">Add to Cart</a>
								<p style="margin-right:19px !important;">{{$product['SellingPrice']}}EGP</p>
							</div>
							</div>
                    @endforeach
				</div>
			</div> <!-- New Product Section -->

			<div class="collection">
				<div class="men-collection">
					<h2>Men's Collection</h2>
				</div>
				<div class="women-collection">
					<h2>Women's Collection</h2>
				</div>
			</div> <!-- Collection Section -->

			<div class="new-product-section">
				<div class="product-section-heading">
					<h2>Recommend Products <img src="img/icons/good_quality.png"></h2>
					<h3>OUR BEST PRODUCTS RECOMMENDED FOR YOU</h3>
				</div>
				<div class="product-content">


                    {{-- @foreach ($products as $product)
                    @if ($product->recommend != 0)

					<div class="product">
						<a href="{{route("product",$product->id)}}">
							<img src="{{asset("$product->image")}}">
						</a>
						<div class="product-detail">
                            <h2>{{$product->description}}</h2>
                            <h2>{{$product->name}}</h2>
                              <a href="{{route("changeCart",$product->id)}}">Add to Cart</a>
                              	 <p>${{$product->price}}</p>
						</div>
					</div>
                    @endif
                    @endforeach --}}

                    @if(session('alert'))
    <script>alert("{{ session('alert') }}")</script>
  @endif


				</div>
			</div> <!-- Recommend Product Section -->
		</main> <!-- Main Area -->
	</div>





@endsection

<script>
    $(document).ready(function(){
      $('.slider').bxSlider({
          auto: true,
          autoControls: true,
          stopAutoOnClick: true,
          pager: true
        });
    });
 </script>
