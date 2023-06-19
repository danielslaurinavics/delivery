<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::middleware(['web'])->post('/switch-language', [LocaleController::class, 'switchLanguage'])->name('switchLanguage');
Route::post('/login', [LoginController::class, 'login'])->name('login');
	
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
});