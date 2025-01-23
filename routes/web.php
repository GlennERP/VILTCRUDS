<?php

use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {  //authenticated login
    Route::get('/dashboard', function (){
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');



    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::match(['get', 'put'], '/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

Route::get ('/about', [AuthController::class, 'showAboutPage'])->name('about');
