<?php

use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\KarierController;
use App\Http\Controllers\Web\LokasiController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\PromoController;
use App\Http\Controllers\Web\SubmissionController;

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
    return redirect('/dashboard');
});

use Illuminate\Support\Facades\Storage;
Route::get('uploads/{path}',function ($path){
    return storage::path($path);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('login', [LoginController::class,'authenticate'])->middleware('guest');
Route::get('logout', [LoginController::class,'logout'])->middleware('auth');

Route::group(['prefix' => 'karier','middleware' => ['auth']],function (){
    Route::get('daftarKarier',[KarierController::class, 'index'])->middleware('auth.menu:3,r');
});

Route::group(['prefix' => 'lokasi','middleware' => ['auth']],function (){
    Route::get('daftarLokasi',[LokasiController::class, 'index'])->middleware('auth.menu:4,r');
});

Route::group(['prefix' => 'faq','middleware' => ['auth']],function (){
    Route::get('listFAQ',[FaqController::class, 'index'])->middleware('auth.menu:5,r');
});

Route::group(['prefix' => 'menu','middleware' => ['auth']],function (){
    Route::get('daftarMenu',[MenuController::class, 'index'])->middleware('auth.menu:6,r');
});

Route::group(['prefix' => 'promo','middleware' => ['auth']],function (){
    Route::get('daftarPromo',[PromoController::class, 'index'])->middleware('auth.menu:7,r');
});

Route::group(['prefix' => 'submission','middleware' => ['auth']],function (){
    Route::get('daftarLamaran',[SubmissionController::class, 'index'])->middleware('auth.menu:8,r');
});

Route::get('profile',[loginController::class, 'profile'])->middleware('auth');

Route::group(['prefix' => 'karier','middleware' => ['auth']], function (){
    Route::get('/', [KarierController::class, 'index'])->name('karier.index')->middleware('auth.menu:3,r');
    Route::get('/create', [KarierController::class, 'create'])->name('karier.create')->middleware('auth.menu:3,c');
    Route::post('/', [KarierController::class, 'store'])->name('karier.store')->middleware('auth.menu:3,c');
    Route::get('/{id}', [KarierController::class, 'show'])->name('karier.show')->middleware('auth.menu:3,r');
    Route::get('/{id}/edit', [KarierController::class, 'edit'])->name('karier.edit')->middleware('auth.menu:3,u');
    Route::put('/{id}', [KarierController::class, 'update'])->name('karier.update')->middleware('auth.menu:3,u');
    Route::delete('/{id}', [KarierController::class, 'destroy'])->name('karier.destroy')->middleware('auth.menu:3,d');
});

Route::group(['prefix' => 'lokasi','middleware' => ['auth']], function (){
    Route::get('/', [LokasiController::class, 'index'])->name('lokasi.index')->middleware('auth.menu:4,r');
    Route::get('/create', [LokasiController::class, 'create'])->name('lokasi.create')->middleware('auth.menu:4,c');
    Route::post('/', [LokasiController::class, 'store'])->name('lokasi.store')->middleware('auth.menu:4,c');
    Route::get('/{id}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit')->middleware('auth.menu:4,u');
    Route::put('/{id}', [LokasiController::class, 'update'])->name('lokasi.update')->middleware('auth.menu:4,u');
    Route::delete('/{id}', [LokasiController::class, 'destroy'])->name('lokasi.destroy')->middleware('auth.menu:4,d');
});

Route::group(['prefix' => 'faq','middleware' => ['auth']], function (){
    Route::get('/', [FaqController::class, 'index'])->name('faq.index')->middleware('auth.menu:5,r');
    Route::get('/create', [FaqController::class, 'create'])->name('faq.create')->middleware('auth.menu:5,c');
    Route::post('/', [FaqController::class, 'store'])->name('faq.store')->middleware('auth.menu:5,c');
    Route::get('/{id}/edit', [FaqController::class, 'edit'])->name('faq.edit')->middleware('auth.menu:5,u');
    Route::put('/{id}', [FaqController::class, 'update'])->name('faq.update')->middleware('auth.menu:5,u');
    Route::delete('/{id}', [FaqController::class, 'destroy'])->name('faq.destroy')->middleware('auth.menu:5,d');
});

Route::group(['prefix' => 'menu','middleware' => ['auth']], function (){
    Route::get('/', [MenuController::class, 'index'])->name('menu.index')->middleware('auth.menu:6,r');
    Route::get('/create', [MenuController::class, 'create'])->name('menu.create')->middleware('auth.menu:6,c');
    Route::post('/', [MenuController::class, 'store'])->name('menu.store')->middleware('auth.menu:6,c');
    Route::get('/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit')->middleware('auth.menu:6,u');
    Route::put('/{id}', [MenuController::class, 'update'])->name('menu.update')->middleware('auth.menu:6,u');
    Route::delete('/{id}', [MenuController::class, 'destroy'])->name('menu.destroy')->middleware('auth.menu:6,d');
});

Route::group(['prefix' => 'promo','middleware' => ['auth']], function (){
    Route::get('/', [PromoController::class, 'index'])->name('promo.index')->middleware('auth.menu:7,r');
    Route::get('/create', [PromoController::class, 'create'])->name('promo.create')->middleware('auth.menu:7,c');
    Route::post('/', [PromoController::class, 'store'])->name('promo.store')->middleware('auth.menu:7,c');
    Route::get('/{id}/edit', [PromoController::class, 'edit'])->name('promo.edit')->middleware('auth.menu:7,u');
    Route::put('/{id}', [PromoController::class, 'update'])->name('promo.update')->middleware('auth.menu:7,u');
    Route::delete('/{id}', [PromoController::class, 'destroy'])->name('promo.destroy')->middleware('auth.menu:7,d');
});

Route::group(['prefix' => 'submission', 'middleware' => ['auth']], function () {
    Route::get('/', [SubmissionController::class, 'index'])->name('submission.index')->middleware('auth.menu:8,r');
    Route::get('/{id}', [SubmissionController::class, 'show'])->name('submission.show')->middleware('auth.menu:8,r');
});