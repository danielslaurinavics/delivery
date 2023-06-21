<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Accessible to anyone
Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::middleware(['web'])->post('/switch-language', [LocaleController::class, 'switchLanguage'])->name('switchLanguage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Accessible to authenticated users only
Route::middleware(['auth'])->group(function () {
	Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
	
	Route::get('/dishes', [DishController::class, 'index'])->name('dishes.index');
	Route::get('/dishes/search', [DishController::class, 'search'])->name('dishes.search');
	
	Route::get('/dishes/create', [DishController::class, 'create'])->name('dishes.create');
	Route::post('/dishes', [DishController::class, 'store'])->name('dishes.store');
	Route::get('/dishes/{id}/edit', [DishController::class, 'edit'])->name('dishes.edit');
	Route::put('/dishes/{id}', [DishController::class, 'update'])->name('dishes.update');
	Route::get('/dishes/{id}/delete', [DishController::class, 'del'])->name('dishes.delete');
	Route::delete('/dishes/{id}', [DishController::class, 'destroy'])->name('dishes.destroy');
	
	Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
	Route::get('/orders/create/{rid}/{did}', [OrderController::class, 'create'])->name('orders.create');
	Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
	Route::put('/orders/setPrep/{id}', [OrderController::class, 'setAsPrep'])->name('orders.setprep');
	Route::put('/orders/setR/{id}', [OrderController::class, 'setAsReady'])->name('orders.setr');
	Route::put('/orders/setE/{id}', [OrderController::class, 'setAsEnroute'])->name('orders.sete');
	Route::put('/orders/setC/{id}', [OrderController::class, 'setAsDelivered'])->name('orders.setd');
	Route::get('/orders/courier', [OrderController::class, 'courindex'])->name('courier.index');
	Route::get('/orders/rest', [OrderController::class, 'restindex'])->name('rest.index');
	
	Route::get('/orders/rating/{id}', [RatingController::class, 'create'])->name('ratings.create');
	Route::post('/orders/rating', [RatingController::class, 'store'])->name('ratings.store');
	Route::get('/rating/rest/{id}', [RatingController::class, 'viewRestRating'])->name('ratings.restrat');
	Route::get('/rating/cour/{id}', [RatingController::class, 'viewCourRating'])->name('ratings.courrat');
	
	Route::get('/users', [UserController::class, 'index'])->name('users.index');
	Route::get('/users/block/{id}', [UserController::class, 'blo'])->name('users.blo');
	Route::post('/users/block/{id}', [UserController::class, 'block'])->name('users.block');
	Route::post('/users/unblock/{id}', [UserController::class, 'unblock'])->name('users.unblock');
	Route::get('/users/change-role/{id}', [UserController::class, 'chrole'])->name('users.chrole');
	
	Route::put('/users/change-role/user/{id}', [UserController::class, 'assignToUser'])->name('users.assuser');
	Route::put('/users/change-role/courier/{id}', [UserController::class, 'assignToCourier'])->name('users.asscour');
	
	Route::get('/create-restaurant/{id}',[UserController::class, 'crtRest'])->name('users.crtrest');
	Route::post('/create-restaurant/{id}',[UserController::class, 'assignToRestaurant'])->name('users.assrest');
	
	Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
	Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
	Route::put('/users/changepassword/{id}', [UserController::class, 'changePassword'])->name('users.changepass');

});

// Accessible to restaurants only
// Accessible to users only
// Accessible to couriers only
// Accessible to admins only
// Accessible by authenticated user of any role