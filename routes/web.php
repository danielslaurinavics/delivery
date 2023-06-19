<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DishController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/switch-language', [LocaleController::class, 'switchLanguage'])->name('switchLanguage');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dishes', [DishController::class, 'index'])->name('dishes.index');

Route::get('/dishes/create', [DishController::class, 'create'])->name('dishes.create');

Route::post('/dishes', [DishController::class, 'store'])->name('dishes.store');