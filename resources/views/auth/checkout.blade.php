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
                <li><a href="{{route("cart")}}">Cart</a></li>
                <li> / </li>
                <li>Checkout</li>
            </ul>
        </div> <!-- End of Breadcrumb-->

        <h2>Billing Detail</h2>
        <div class="checkout-page">
            <div class="billing-detail">
                <form class="checkout-form" method="POST" action="{{route("UpdateCheckout",auth()->user()->id)}}">
                    @csrf
              @method("put")
                    <h4>Shipping Detail</h4>
                    <div class="form-inline">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" id="fname" name="fname">
                            @error("fname")
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" id="lname" name="lname">
                            @error("lname")
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Company Name (Optional)</label>
                        <input type="text" id="cname" name="cname">
                        @error("cname")
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror

                    </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <label>Country</label>
                            <select id="country" name="country">
                                <option>---Select a Country---</option>
                                <option>Egypt</option>
                            </select>
                            @error("country")
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <select id="cityy" name="cityy">
                                <option>---Select a City---</option>
                                <option>cairo</option>
                                <option>Alex</option>
                                <option>mansoura</option>

                            </select>
                            @error("cityy")
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea style="resize:none" id="address" name="address" rows="3"></textarea>

                        @error("address")
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror

                          </div>

                    <h4>Contact Detail</h4>
                    <div class="form-inline">
                        <div class="form-group">
                            <label>Tel</label>
                            <input type="text" id="tel" name="tel" minlength="11" maxlength="11">
                            @error("tel")
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" id="mobile" name="mobile" minlength="11" maxlength="11">
                            @error("mobile")
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <h4>Additional Information (Optional)</h4>
                    <div class="form-group">
                        <label>Order Note</label>
                        <textarea style="resize:none" id="address" name="note" rows="3"></textarea>
                        @error("note")
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror

                    </div>
            </div>
            <div class="order-summary">
                <div class="checkout-total">
                    <h3>Order Summary</h3>
                    <ul>

                        @foreach ($carts as $cart) 
                        @if ($cart->user_id == auth()->user()->id) 
                        <li>Cart Amount:    {{$cart->product->name}} <span>{{$cart->totalPrice}}EGP  </span>  </li> 
                        @endif
 
                        @endforeach
                        <li>Delivery Charges: <span>100</span></li>
                        <hr>
                        @if ($cart == null)
                        <li>Total Amount: <span> </span></li>
                        @else
                        <li>Total Amount:  <span>{{$totalPrice  + 100}}EGP</span></li>
                        @endif
                        <hr>
                        <li><input type="radio" name="payment"> Cash on Delivery</li>
                          <hr>
                        <li><input type="submit" name="order" value="Place Order"></li>
                    </ul>
                </div>
                </form> <!-- End of Checkout Form -->
            </div>
        </div>
    </main> <!-- Main Area -->
</div>



@endsection


