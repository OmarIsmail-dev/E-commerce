<!DOCTYPE html>
<html lang="en">

 	<head>
 		<!-- Meta Tags -->
		<meta charset="UTF-8">
		<meta name="author" content="Kamran Mubarik">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Title -->
 		<title>E-Commerce Online Shop</title>
 		<!-- Style Sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}" />
		<!-- Javascript -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">

<body>

	<header>
		<div class="container">
			<div class="brand">
				<div class="logo">
					<a href="{{route("home")}}">
						<img src="{{asset("img/icons/online_shopping.png")}}">
						<div class="logo-text">
							<p class="big-logo">Ecommerce</p>
							<p class="small-logo">online shop</p>
						</div>
					</a>
				</div> <!-- logo -->
				<div class="shop-icon">
					<div class="dropdown">
						<img src="{{asset("img/icons/account.png")}}">
						<div class="dropdown-menu">
							<ul>
								<li><a href="{{route("MyAccount")}}">My Account</a></li>
								<li><a href="{{route("MyOrder")}}">My Orders</a></li>
							</ul>
						</div>
					</div>
					<div class="dropdown">
						<img src="{{asset("img/icons/heart.png")}}">
						<div class="dropdown-menu wishlist-item">
							<table border="1">
								<thead>
									<tr>
										<th>Image</th>
										<th>Product Name</th>
									</tr>
								</thead>
								<tbody>

									<tr>
										<td><img src="{{asset("img/product/img1.jpg")}}"></td>
										<td>product name</td>
									</tr>


                                </tbody>
							</table>
						</div>
					</div>
					<div class="dropdown">
			<a href="{{route("cart")}}">
                	<img src="{{asset("img/icons/shopping_cart.png")}}">
                    <span class="badge bg-secondary">{{$totalCount}}</span>
                </a>

                    <div class="dropdown-menu cart-item">
							<table border="1">
								<thead>
									<tr>
										<th>Image</th>
										<th>Product Name</th>
										<th class="center">Price</th>
										<th class="center">Qty.</th>
 									</tr>
								</thead>
								<tbody>
                                    @foreach ($carts as $cart)
                                    @if ($cart->user_id == auth()->user()->id)

                                    <tr>
										<td><img src="{{asset($cart->product->image)}}"></td>
										<td>{{$cart->product->name}}</td>
										<td class="center">${{$cart->totalPrice}}</td>
										<td class="center">{{$cart->quantity}}</td>
 									</tr>


                                     @endif

                                     @endforeach

                                </tbody>
							</table>
						</div>
					</div>
				</div> <!-- shop icons -->
			</div> <!-- brand -->

			<div class="menu-bar">
				<div class="menu">
					<ul>
						<li><a href="{{route("home")}}">Home</a></li>
						<li><a href="{{route("shop")}}">Shop</a></li>
						<li><a href="{{route("about")}}">About</a></li>
						<li><a href="{{route("contact")}}">Contact</a></li>
					</ul>
				</div>
				<div class="search-bar">
					<form>
						<div class="form-group">
							<input type="text" class="form-control" name="search" placeholder="Search">
							<img src="{{asset("img/icons/search.png")}}">
						</div>
					</form>
				</div>
			</div> <!-- menu -->
		</div> <!-- container -->
	</header> <!-- header -->


        <main class="py-4">
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <div class="footer-widget">
                    <div class="widget">
                        <div class="widget-heading">
                            <h3>Important Link</h3>
                        </div>
                        <div class="widget-content">
                            <ul>
                                <li><a href="{{route("about")}}">About</a></li>
                                <li><a href="{{route("contact")}}">Contact</a></li>
                                <li><a href="">Refund Policy</a></li>
                                <li><a href="">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget-heading">
                            <h3>Information</h3>
                        </div>
                        <div class="widget-content">
                            <ul>
                                <li><a href="{{route("MyAccount")}}">My Account</a></li>
                                <li><a href="{{route("MyOrder")}}">My Orders</a></li>
                                <li><a href="{{route("cart")}}">Cart</a></li>
                                <li><a href="{{route("checkout",auth()->user()->id)}}">Checkout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget-heading">
                            <h3>Follow us</h3>
                        </div>
                        <div class="widget-content">
                            <div class="follow">
                                <ul>
                                    <li><a href="#"><img src="{{asset("img/icons/facebook.png")}}"></a></li>
                                    <li><a href="#"><img src="{{asset("img/icons/twitter.png")}}"></a></li>
                                    <li><a href="#"><img src="{{asset("img/icons/instagram.png")}}"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-heading">
                            <h3>Subscribe for Newsletter</h3>
                        </div>
                        <div class="widget-content">
                            <div class="subscribe">
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subscribe" placeholder="Email">
                                        <img src="{{asset("img/icons/paper_plane.png")}}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- Footer Widget -->
                <div class="footer-bar">
                    <div class="copyright-text">
                        <p>Copyright 2021 - All Rights Reserved</p>
                    </div>
                    <div class="payment-mode">
                        <img src="{{asset("img/icons/paper_money.png")}}">
                        <img src="{{asset("img/icons/visa.png")}}">
                        <img src="{{asset("img/icons/mastercard.png")}}">
                    </div>
                </div> <!-- Footer Bar -->
            </div>
        </footer> <!-- Footer Area -->



        <script>
            $(document).ready(function(){

                $('input[type="radio"]').change(function(){

                    if (this.value == 'easypaisa') {

                        $('#easypaisaText').css('display', 'block');
                    }
                    else {
                        $('#easypaisaText').css('display', 'none');
                    }

                });
            });
        </script>

         <script type="text/javascript" src="js/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>



    </body>
</html>
