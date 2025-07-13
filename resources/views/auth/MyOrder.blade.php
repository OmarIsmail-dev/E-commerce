@extends('layouts.app')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

@section('content')


<div class="container">
        <main>
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li> / </li>
                    <li><a href="{{ route('MyAccount') }}">Account</a></li>
                    <li> / </li>
                    <li>Orders</li>
                </ul>
            </div> <!-- End of Breadcrumb-->


            <div class="account-page">
                <div class="profile">
                    <div class="profile-img">
                        <img src="img/product/img5.jpg">
                        <h2>{{ Auth::user()->name }}</h2>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <ul>
                        <li><a href="{{ route('MyAccount') }}" class="active">Account <span>></span></a></li>
                        <li><a href="{{ route('MyOrder') }}">My Orders <span>></span></a></li>
                        <li><a href="change-password.html">Change Password <span>></span></a></li>
                        <li><a href="{{ route('Logout') }}">Logout <span>></span></a></li>
                    </ul>
                </div>
                <div class="account-detail">
                    <h2>My Orders</h2>
                    <div class="order-detail">
                        <table>
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>status</th>
                                    <th>quantity</th> 
                                    <th>Payment Mode</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order) 
                                @if ($order->user_id == auth()->user()->id   )                                  
                                
                                <tr> 
                                            <td><img width="50px" src="{{ $order->product->image }}" alt=""></td>
                                            <td>{{ $order->product->name }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->price }}EGP</td>
                                            @if($order->order_status== "completed")
                                            <td class="text-success">{{ $order->order_status }}</td>
                                            @elseif($order->order_status== "refused")
                                            <td class="text-danger ">{{ $order->order_status }}</td>
                                            @else
                                            <td class="text-warning">{{ $order->order_status }}</td> 
                                            @endif 
                                            <td>{{$order->quantity}}</td>
                                            <td>Cash</td>
                                            <td>
                                                <form action="{{ route('updateOrderStatus', $order->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method("put")
                                                    <input type="hidden" name="action" value="decrease">  
                                                    <input type="hidden" name="order_status" value="completed"> 
                                                    <button type="submit" class="btn ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class=" text-success   " width="22" height="22" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                                                      </svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('updateOrderStatus', $order->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method("put") 
                                                    <input type="hidden" name="action" value="increase"> 
                                                    <input type="hidden" name="order_status" value="refused"> 
                                                    <button type="submit" class="btn "> 
                                                     <svg xmlns="http://www.w3.org/2000/svg" class=" text-danger    " width="22" height="22" fill="currentColor" class="bi bi-bag-x-fill" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293z"/>
                                                      </svg> 
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main> <!-- Main Area -->
    </div>
@endsection


@if(session('alert'))
<script>alert("{{ session('alert') }}")</script>
@endif


 