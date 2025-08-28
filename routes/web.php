<?php

use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\KarierController;
use App\Http\Controllers\Web\KarierPageController;
use App\Http\Controllers\Web\LokasiController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\MenuController;
use App\Http\Controllers\Web\PromoController;
use App\Http\Controllers\Web\SubmissionController;
use App\Http\Controllers\Web\NavbarController;
use App\Http\Controllers\Web\TentangKamiController;
use App\Http\Controllers\Web\FooterController;
use App\Http\Controllers\Web\ContactSettingsController;
use App\Http\Controllers\Web\OrderPageController;
use App\Http\Controllers\Web\ShortlistController;
use App\Http\Controllers\Web\ManajemenHome\BannerController;
use App\Http\Controllers\Web\ManajemenHome\MenuFavoritController;
use App\Http\Controllers\Web\ManajemenHome\PenawaranController;
use App\Http\Controllers\Web\ManajemenHome\GalleryController;
use App\Http\Controllers\Web\ManajemenHome\InfoGambarController;
use App\Http\Controllers\Web\ManajemenHome\KStarsController;

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

Route::group(['prefix' => 'pengaturan-karier', 'middleware' => ['auth', 'auth.menu:14,r']], function () {
    Route::get('/', [KarierPageController::class, 'index'])->name('karier-page.index');
    Route::post('/', [KarierPageController::class, 'update'])->name('karier-page.update')->middleware('auth.menu:14,u');
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
    Route::get('/shortlist', [SubmissionController::class, 'shortlist'])->name('submission.shortlist')->middleware('auth.menu:8,r');
    Route::get('/interview', [SubmissionController::class, 'interview'])->name('submission.interview')->middleware('auth.menu:8,r');
    Route::get('/{id}', [SubmissionController::class, 'show'])->name('submission.show')->middleware('auth.menu:8,r');
    Route::post('/{id}/status', [SubmissionController::class, 'updateStatus'])->name('submission.updateStatus')->middleware('auth.menu:8,u');
});

Route::group(['prefix' => 'home', 'middleware' => ['auth']], function () {
    Route::get('/banner', [BannerController::class, 'index'])->name('banner.index')->middleware('auth.menu:9,r');
    Route::post('/banner', [BannerController::class, 'update'])->name('banner.update')->middleware('auth.menu:9,u');
    
    Route::get('/menu-favorit', [MenuFavoritController::class, 'index'])->name('menu-favorit.index')->middleware('auth.menu:9,r');
    Route::get('/menu-favorit/create', [MenuFavoritController::class, 'create'])->name('menu-favorit.create')->middleware('auth.menu:9,c');
    Route::post('/menu-favorit', [MenuFavoritController::class, 'store'])->name('menu-favorit.store')->middleware('auth.menu:9,c');
    Route::get('/menu-favorit/{id}/edit', [MenuFavoritController::class, 'edit'])->name('menu-favorit.edit')->middleware('auth.menu:9,u');
    Route::post('/menu-favorit/{id}', [MenuFavoritController::class, 'update'])->name('menu-favorit.update')->middleware('auth.menu:9,u');
    Route::delete('/menu-favorit/{id}', [MenuFavoritController::class, 'destroy'])->name('menu-favorit.destroy')->middleware('auth.menu:9,d');

    Route::post('menu-favorit/settings', [MenuFavoritController::class, 'updateSettings'])->name('menu-favorit.settings.update')->middleware('auth.menu:9,u');

    Route::get('/penawaran', [PenawaranController::class, 'index'])->name('penawaran.index')->middleware('auth.menu:9,r');
    Route::get('/penawaran/create', [PenawaranController::class, 'create'])->name('penawaran.create')->middleware('auth.menu:9,c');
    Route::post('/penawaran', [PenawaranController::class, 'store'])->name('penawaran.store')->middleware('auth.menu:9,c');
    Route::get('/penawaran/{id}/edit', [PenawaranController::class, 'edit'])->name('penawaran.edit')->middleware('auth.menu:9,u');
    Route::post('/penawaran/{id}', [PenawaranController::class, 'update'])->name('penawaran.update')->middleware('auth.menu:9,u');
    Route::delete('/penawaran/{id}', [PenawaranController::class, 'destroy'])->name('penawaran.destroy')->middleware('auth.menu:9,d');

    Route::post('penawaran/settings', [PenawaranController::class, 'updateSettings'])->name('penawaran.settings.update')->middleware('auth.menu:9,u');
    
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index')->middleware('auth.menu:9,r');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create')->middleware('auth.menu:9,c');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store')->middleware('auth.menu:9,c');    
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit')->middleware('auth.menu:9,u');
    Route::post('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update')->middleware('auth.menu:9,u');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy')->middleware('auth.menu:9,d');

    Route::get('/icon/create', [GalleryController::class, 'createIcon'])->name('gallery.icon.create')->middleware('auth.menu:9,c');
    Route::post('/icon', [GalleryController::class, 'storeIcon'])->name('gallery.icon.store')->middleware('auth.menu:9,c');
    Route::get('/icon/{id}/edit', [GalleryController::class, 'editIcon'])->name('gallery.icon.edit')->middleware('auth.menu:9,u');
    Route::post('/icon/{id}', [GalleryController::class, 'updateIcon'])->name('gallery.icon.update')->middleware('auth.menu:9,u');
    Route::delete('/icon/{id}', [GalleryController::class, 'destroyIcon'])->name('gallery.icon.destroy')->middleware('auth.menu:9,d');

    Route::get('/k-stars', [KStarsController::class, 'index'])->name('k-stars.index')->middleware('auth.menu:9,r');
    Route::get('/k-stars/create', [KStarsController::class, 'create'])->name('k-stars.create')->middleware('auth.menu:9,c');
    Route::post('/k-stars', [KStarsController::class, 'store'])->name('k-stars.store')->middleware('auth.menu:9,c');
    Route::get('/k-stars/{id}/edit', [KStarsController::class, 'edit'])->name('k-stars.edit')->middleware('auth.menu:9,u');
    Route::post('/k-stars/{id}', [KStarsController::class, 'update'])->name('k-stars.update')->middleware('auth.menu:9,u');
    Route::delete('/k-stars/{id}', [KStarsController::class, 'destroy'])->name('k-stars.destroy')->middleware('auth.menu:9,d');

    Route::get('/info', [InfoGambarController::class, 'index'])->name('info-gambar.index')->middleware('auth.menu:9,r');
    Route::post('/info', [InfoGambarController::class, 'update'])->name('info-gambar.update')->middleware('auth.menu:9,u');
});

Route::group(['prefix' => 'manajemen-navbar', 'middleware' => ['auth', 'auth.menu:10,r']], function() {
    Route::get('/', [NavbarController::class, 'index'])->name('navbar.index');

    Route::get('/thumb/create', [NavbarController::class, 'createThumb'])->name('navbar.thumb.create');
    Route::post('/thumb', [NavbarController::class, 'storeThumb'])->name('navbar.thumb.store');
    Route::delete('/thumb/{id}', [NavbarController::class, 'destroyThumb'])->name('navbar.thumb.destroy');

    Route::get('/link/create', [NavbarController::class, 'createLink'])->name('navbar.link.create');
    Route::post('/link', [NavbarController::class, 'storeLink'])->name('navbar.link.store');
    Route::get('/link/{id}/edit', [NavbarController::class, 'editLink'])->name('navbar.link.edit');
    Route::post('/link/{id}', [NavbarController::class, 'updateLink'])->name('navbar.link.update');
    Route::delete('/link/{id}', [NavbarController::class, 'destroyLink'])->name('navbar.link.destroy');

    Route::post('/logo', [NavbarController::class, 'updateLogo'])->name('navbar.logo.update');
    Route::get('/navlink/create', [NavbarController::class, 'createNavLink'])->name('navbar.navlink.create');
    Route::post('/navlink', [NavbarController::class, 'storeNavLink'])->name('navbar.navlink.store');
    Route::get('/navlink/{id}/edit', [NavbarController::class, 'editNavLink'])->name('navbar.navlink.edit');
    Route::post('/navlink/{id}', [NavbarController::class, 'updateNavLink'])->name('navbar.navlink.update');
    Route::delete('/navlink/{id}', [NavbarController::class, 'destroyNavLink'])->name('navbar.navlink.destroy');

    Route::get('/tentang-link/create', [NavbarController::class, 'createTentangLink'])->name('tentang-link.create');
    Route::post('/tentang-link', [NavbarController::class, 'storeTentangLink'])->name('tentang-link.store');
    Route::get('/tentang-link/{id}/edit', [NavbarController::class, 'editTentangLink'])->name('tentang-link.edit');
    Route::post('/tentang-link/{id}', [NavbarController::class, 'updateTentangLink'])->name('tentang-link.update');
    Route::delete('/tentang-link/{id}', [NavbarController::class, 'destroyTentangLink'])->name('tentang-link.destroy');
});

Route::group(['prefix' => 'tentang-kami', 'middleware' => ['auth']], function () {
    Route::get('/', [TentangKamiController::class, 'index'])->name('tentang-kami.index')->middleware('auth.menu:11,r');
    Route::post('/', [TentangKamiController::class, 'update'])->name('tentang-kami.update')->middleware('auth.menu:11,u');
});

Route::group(['prefix' => 'pengaturan-footer', 'middleware' => ['auth']], function () {
    Route::get('/', [FooterController::class, 'index'])->name('footer.index')->middleware('auth.menu:12,r');
    Route::post('/', [FooterController::class, 'update'])->name('footer.update')->middleware('auth.menu:12,u');
});

Route::group(['prefix' => 'pengaturan-contact-us', 'middleware' => ['auth', 'auth.menu:15,r']], function() {
    Route::get('/', [ContactSettingsController::class, 'index'])->name('contact-settings.index')->middleware('auth.menu:15,r');
    Route::post('/', [ContactSettingsController::class, 'update'])->name('contact-settings.update')->middleware('auth.menu:15,u');
});

Route::group(['prefix' => 'order-setting', 'middleware' => ['auth', 'auth.menu:16,r']], function() {
    Route::get('/', [OrderPageController::class, 'index'])->name('order-page.index');
    Route::post('/', [OrderPageController::class, 'update'])->name('order-page.update')->middleware('auth.menu:16,u');
});
