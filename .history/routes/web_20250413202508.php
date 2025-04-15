<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/quote-request', [QuoteRequestController::class, 'create'])->name('quote-request.create');
Route::get('/quote-request/product/{id}', [QuoteRequestController::class, 'productQuote'])->name('quote-request.product');
Route::post('/quote-request', [QuoteRequestController::class, 'store'])->name('quote-request.store');
