<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;



Route::get('/', [UserController::class, 'index']) -> name('index');
Route::get('/info', [UserController::class, 'info']) -> name('info');


Route::get('/players', [PlayerController::class, 'catalog']) -> name('catalog.player');
Route::get('/players/{id}', [PlayerController::class, 'show'])->name('player.show');
Route::get('/players/{id}/edit', [PlayerController::class, 'edit'])->name('player.edit');
Route::put('/players/{id}', [PlayerController::class, 'update'])->name('player.update');
Route::get('/playerss/create', [PlayerController::class, 'create'])->name('player.create');
Route::post('/playerss', [PlayerController::class, 'store'])->name('player.store');
Route::delete('/players/{id}', [PlayerController::class, 'destroy'])->name('admin.players.destroy');


Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
Route::get('/teams/{id}', [TeamController::class, 'show'])->name('teams.show');
Route::get('/teams/{id}/edit', [TeamController::class, 'edit'])->name('teams.edit');
Route::put('/teams/{id}', [TeamController::class, 'update'])->name('teams.update');
Route::delete('/teams/{id}', [TeamController::class, 'destroy'])->name('teams.destroy');


Route::get('/game', [GameController::class, 'catalog'])->name('catalog');


Route::get('/game/{id}', [GameController::class, 'show'])->name('show');


Route::get('/admin/games/create', [GameController::class, 'create'])->name('admin.games.create');
Route::post('/admin/games', [GameController::class, 'store'])->name('admin.games.store');


Route::get('/add-point/{id}', [GameController::class, 'showAddPointForm'])->name('add.point.form');
Route::post('/add-point', [GameController::class, 'addPoint'])->name('add.point');


Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/sort-products', [ProductController::class, 'sort'])->name('sort-products');


Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');


Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
Route::post('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    

Route::get('/store', [TypeController::class, 'create'])->name('store');
Route::resource('/types', TypeController::class);
Route::get('/create', [TypeController::class, 'create'])->name('create');


Route::get('/create', [UserController::class, 'create'])->name('create');
Route::post('/store', [UserController::class, 'store'])->name('store');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/check', [CartController::class, 'check'])->name('check');
Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
Route::post('/update-cart/{id}', [CartController::class, 'update'])->name('update-cart');
Route::get('/download-receipt/{orderId}', [CartController::class, 'downloadReceipt'])->name('download-receipt');
Route::get('/redirect-to-home', [CartController::class, 'redirectToHome'])->name('redirect-to-home');


Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change-password');