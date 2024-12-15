<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderRequestController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\DashboardDisplay;

Route::get('/', function () {
    $dashboard = DashboardDisplay::all();
    $products = Product::withSum('sales', 'quantity')->get()->map(function ($product) {
            $product->discounted_price = $product->price - ($product->price * ($product->discount_value / 100));
            return $product;
    });
    $discount_products = Product::where('discount', 'Y')->limit(4)->get();
    $recomends = Product::withSum('sales', 'quantity') 
        ->orderByDesc('sales_sum_quantity')    
        ->take(4)                     
        ->get();
        
    return view('welcome', [
        'products' => $products, 
        'recomends' => $recomends, 
        'dashboard' => $dashboard, 
        'discount_products' => $discount_products
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);



Route::get('/details/{name}', function ($name) {
    $products = Product::withSum('sales', 'quantity')->get()->map(function ($product) {
        $product->discounted_price = $product->price - ($product->price * ($product->discount_value / 100));
        return $product;
    });
    $details = Product::withSum('sales', 'quantity')->where('name', $name)->firstOrFail();
    return view('details', ['details' => $details,'products' => $products]);
});

Route::get('keranjang', [KeranjangController::class, 'index'])->name('keranjang.store')->middleware('auth');

Route::post('/store/{id}', [KeranjangController::class, 'store'])->name('cart.store')->middleware('auth');

Route::post('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

Route::post('/payment/checkout', [KeranjangController::class, 'pindahkanKeOrderRequests'])->name('pindahkan.order');
Route::put('/order-request/update', [OrderRequestController::class, 'update'])->name('order_request.update');
Route::get('/payment', [OrderRequestController::class, 'paymentView'])->name('payment.view');
Route::post('/order/diterima/{user}/{date}', [OrderRequestController::class, 'barangDiterima'])->name('penjualan.barangDiterima');




