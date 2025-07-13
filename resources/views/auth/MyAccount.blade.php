@extends("layouts.app")
@section("content")
<div class="container">
    <main>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route("home")}}">Home</a></li>
                <li> / </li>
                <li>Account</li>
            </ul>
        </div> <!-- End of Breadcrumb-->

        <div class="account-page">
            <div class="profile">
                <div class="profile-img">
                    <img src="img/product/img5.jpg">
                    <h2>{{Auth::user()->name}}</h2>
                    <p>{{Auth::user()->email}}</p>
                </div>
                <ul>
                    <li><a href="{{route("MyAccount")}}" class="active">Account <span>></span></a></li>
                    <li><a href="{{route("MyOrder")}}">My Orders <span>></span></a></li>
                    <li><a href="change-password.html">Change Password <span>></span></a></li>

                    <li><a href="{{route("Logout")}}">Logout <span>></span></a></li>

                </ul>
            </div>
            <div class="account-detail">
                <h2>Account</h2>
                <div class="billing-detail">
                    <form class="checkout-form">
                        <div class="form-inline">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" id="fname" name="fname" value="{{auth()->user()->fname}}">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" id="lname" name="lname" value="{{auth()->user()->lname}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Company Name (Optional)</label>
                            <input type="text" id="cname" name="cname" value="{{auth()->user()->cname}}">
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <label>Country</label>
                                <select id="country" name="country">
                                    <option selected>---Select a Country---</option>
                                    <option value="{{auth()->user()->country}}"></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <select id="city" name="city">
                                    <option selected>---Select a City---</option>
                                    <option value="{{auth()->user()->city}}"></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea style="resize:none" id="address" name="address" rows="3">{{auth()->user()->address}}</textarea>
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                <label>Tel</label>
                                <input type="text" id="tel" name="tel" minlength="11" maxlength="11" value="{{auth()->user()->tel}}">
                            </div>
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" id="mobile" name="mobile" minlength="11" maxlength="11" value="{{auth()->user()->mobile}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="submit" id="update" name="update" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main> <!-- Main Area -->
</div>

@endsection
