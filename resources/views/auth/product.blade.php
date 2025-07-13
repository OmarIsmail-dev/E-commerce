
@extends("layouts.app")


@section("content")



<div class="container">
    <main>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route("home")}}">Home</a></li>
                <li> / </li>
                <li><a href="{{route("shop")}}">Shop</a></li>
                <li> / </li>
                <li><a href="{{route("product",$products['id'])}}">Product</a></li>
            </ul>
        </div> <!-- End of Breadcrumb-->

        <div class="single-product">
            <div class="images-section">
                <div class="" style="width: 70%">
                    <img width="100%" src="{{url($products['image'])}}">
                </div>
             </div> <!-- End of Images Section-->

            <div class="product-detail">
                <div class="product-name">
                    <h2>{{$products['title']}} </h2>
                </div>
                <div class="product-price mt-3 ">
                    <h3>{{$products['SellingPrice']}}EGP</h3>
                </div>

                <hr>

                @if ($products['category'] == "shoes")  

                <div class="product-Size">
                      <h3  >Size : {{$products['size_shoes']}}</h3>
                </div> 
                @endif      

                @if ($products['category'] == "clothing")  

                <div class="product-Size">
                   <h3>  Size : {{$products['size_clothes']}}</h3>
                </div> 
                @endif      

                <hr>

                <div class="">
                    <h5 class="    text-blue-500 ">color : {{$products['color']}}</h5>
                 </div>
                 <hr>

                 <div class="">
                    <h5 class="    text-blue-500 ">brand : {{$products['brand']}}</h5>
                 </div>
                 <hr>

                <div class="">
                    <h5 class="    text-blue-500 ">Stock : {{$products['in_stock']}}</h5>
                 </div>
                 
                <hr>
                <div class="product-cart">
                    <form id="cart-form" method="POST" action="{{route("CartProduct",$products['id'])}}">
                        @csrf
                         <div class="form-group">
                            <input type="number" class="cart-number" name="quantity" value="1" min="1" max="10">
                            <input type="submit" name="addToCart" value="Add To Cart">
                        </div>
                    </form>
                    <form id="wishlist-form">
                        <div class="form-group">
                            <input type="checkbox" class="wishlist" name="wishlist"> Add To Wishlist
                        </div>
                    </form>
                </div>
                <hr>
                <div class="product-meta">
                    <p><b>Category: </b> {{$products['category']}}</p>
                    
                    <p><b>Share This Product: </b> Facebook, Twitter</p>
                </div>
            </div> <!-- End of Product Detail-->
        </div>
        <hr>
        <div class="product-long-description">
            <h3>Product Description</h3>

            <p>
            
            {{$products['description']}}

            </p>
         </div>
        <hr>
        <div class="new-product-section">
            <div class="product-section-heading">
                <h2>Recommend Products <img src="{{asset("img/icons/good_quality.png")}}"></h2>
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
        </div>
        </div> <!-- Recommend Product Section -->
    </main> <!-- Main Area -->
</div>

@endsection
