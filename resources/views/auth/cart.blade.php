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
                  <li>Cart</li>
            </ul>
        </div> <!-- End of Breadcrumb-->

        <h2>Shopping Cart</h2>
        <div class="cart-page">
            <div class="cart-items">
                <table>
                    <thead>
                        <tr>
                            <th colspan="3">Cart Items</th>
                        </tr>
                    </thead>
                    <tbody>

                               @foreach ($carts as $cart)

                               @if ($cart->user_id == auth()->user()->id)

                               <tr>
                                @foreach ($productsApi as $product) 

                                @if ($product['id'] == $cart->product->id)

                                <td style="width: 20%;"><img src="{{url($product['image'])}}"></td>
                                <td style="width: 60%;">

                                    <h2>{{$cart->product->name}}</h2>

                                            
                                    <h3  style="color: red"  >Available : {{$product['in_stock']}} </h3>
                                    <br>

                                    @endif 
                                    @endforeach

                                     <h3>${{$cart->product->price}}</h3>
                                    <br>
                                    <a href="{{route("removeCart", $cart->id)}}">x</a> Remove
                                </td>
                                <td class="qty" style="width: 15%;">

                                        <div class="CartNum" style="margin-bottom: 9px;">
                                           <h5>Qty: {{$cart->quantity}}</h5>
                                        </div>

                                     <br>
                                    <h3 id="x">{{$cart->totalPrice}}EGP</h3>
                                </td>
                            </tr>

                                @endif

                        @endforeach

                    </tbody>
                </table>
                <div class="pagination">
                    <ul>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                    </ul>
                </div>
            </div>
            <div class="cart-summary">
                <div class="checkout-total">
                    <h3>Cart Summary</h3>
                    <ul>
                        <li>Number of Products x 15</li>
                        <li>Number of items x 20</li>
                        <hr>


                         <li>Cart Total   <span style="float: right;">{{$totalPrice}} </span></li>



                        <li><a href="{{route("checkout",auth()->user()->id)}}">Go to Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main> <!-- Main Area -->
</div>


<script>
    $(document).ready(function(){

        $('.prev').on("click", function(){

            var prev = $(this).closest('.qty').find("input").val();

            if (prev == 1) {
                $(this).closest('.qty').find("input").val('1');
            }else{
                var prevVal = prev - 1;
                $(this).closest('.qty').find("input").val(prevVal);
            }
        });
        $('.next').on("click", function(){

            var next = $(this).closest('.qty').find("input").val();

            if (next == 10) {
                $(this).closest('.qty').find("input").val('10');
            }else{
                var nextVal = ++next;
                $(this).closest('.qty').find("input").val(nextVal);
            }
        });
    });







</script>


@endsection









