@extends("layouts.app")
@section('content')


<div class="container">
    <main>
        <div class="breadcrumb">
            <ul>
                 <li><a href="{{route("home")}}">Home</a></li>
                <li> / </li>
                <li>Shop</li>
            </ul>
        </div> <!-- End of Breadcrumb-->

        <div class="new-product-section shop">
            <div class="sidebar">
                <div class="sidebar-widget">
                    <h3>Category</h3>
                    <ul>
                  @foreach ($Categories as $Category)
                      
                  
                        <li>
                    
                        <a href="{{route("ShopCategory",$Category['id'])}}"> 
                                {{$Category['name']}} 
                        </a>

                    </li>
 
                        @endforeach
                    </ul>
                </div>
                <div class="sidebar-widget">
                    <h3>Range Filter</h3>
                    <p>
                      <label for="amount"></label>
                      <input type="text" id="amount" readonly style="border:0; color:#F0E68C;  margin-bottom: 5px;">
                    </p>
                    <div id="slider-range"></div>
                </div>
            </div>
            <div class="product-content">



                @foreach ($products as $product) 
                     
                    

                <div class="product">
                    <a href="{{route("product",$product['id'])}}">
                        <img style="height: 147px !important;"  src="{{url($product['image'])}}">
                    </a>
                    <div class="product-detail">
                    <h5 style="display: inline-block !important; color: #2F4F4F; " >{{$product['title']}}</h5> 
                    <h2 style="display: inline-block !important ;  float: right ; margin-right: 15px; ">{{$product['in_stock']}}</h2> 
                </div>
                  <div class="clear"></div>
                <div class="product-detail"> 
                        <a href="{{route("AddToCart",$product['id'])}}">Add to Cart</a>
                        <p style="margin-right:  21px !important;">{{$product['SellingPrice']}}EGP</p>
                    </div>
                </div>
                 @endforeach

                @if(session('alert'))
                <script>alert("{{ session('alert') }}")</script>
                             @endif

            </div>
        </div> <!-- New Product Section -->
        <div class="load-more">
            <a href="#">Load More</a>
        </div>
    </main> <!-- Main Area -->
</div>



@endsection

<script>
    $( function() {
        $( "#slider-range" ).slider({
          range: true,
          min: 0,
          max: 10000,
          values: [ 1000, 3000 ],
          slide: function( event, ui ) {
            $( "#amount" ).val( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
          }
        });
        $( "#amount" ).val( "Rs." + $( "#slider-range" ).slider( "values", 0 ) +
          " - Rs." + $( "#slider-range" ).slider( "values", 1 ) );
    });
 </script>
