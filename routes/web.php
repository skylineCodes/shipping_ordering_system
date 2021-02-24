<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

// Order Route
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store']);
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::patch('/order/{id}', [OrderController::class, 'update_price']);

// Admin
Route::get('/admin/create', [CustomerController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [CustomerController::class, 'store']);

// Customers
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customer/order/{id}', [CustomerController::class, 'show'])->name('customer.order');
