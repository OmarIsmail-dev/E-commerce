<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MyApiController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Controller;
use App\Models\User;

 
Route::get('/test',function(){

     return "Hello api"; 

 });

// Route::get('/CustomerOrder',[App\Http\Controller\Api\OrderController::class,"CustomerOrder"])->name("CustomerOrder");

 Route::get('/CustomerOrder', [App\Http\Controllers\Api\OrderController::class, 'index'])->name("CustomerOrder");
 Route::get('/TotalCustomerOrder', [App\Http\Controllers\Api\OrderController::class, 'total'])->name("TotalCustomerOrder");
 Route::get('/TotalAmountOrder', [App\Http\Controllers\Api\OrderController::class, 'TotalAmountOrder'])->name("TotalAmountOrder");
 Route::get('/CustomerOrder/{id}', [App\Http\Controllers\Api\OrderController::class, 'show'])->name('CustomerOrder');

 
 Route::get('/std', [App\Http\Controllers\Api\OrderController::class, 'standerDeviation'])->name("std");

 Route::get('/users', [App\Http\Controllers\Api\UserController::class, 'index'])->name("users");
 Route::get('/users/{id}', [App\Http\Controllers\Api\UserController::class, 'show'])->name('users');


