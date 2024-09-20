<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('homepage');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::PUT('/user/profile', [UserController::class, 'update'])->name('profile.update');

    Route::get('/get-service', [ServiceController::class, 'getServices'])->name('services.get');
    Route::get('/service', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/add-service', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.update');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

    Route::post('/get-toko', [TokoController::class, 'getToko'])->name('toko.getToko');
    Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');
    Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
    Route::post('/toko/{id}', [TokoController::class, 'update'])->name('toko.update2');
    Route::get('/api/toko/{id}', [TokoController::class, 'checkToko'])->name('toko.update');

    Route::get('/check-out', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::post('/calculate-shipping', [TokoController::class, 'calculateShipping']);

    Route::get('/api/pembayarans/toko', [PembayaranController::class, 'getByToko'])->name('pembayarans.getByToko');
    Route::get('/pembayaran', [PembayaranController::class, 'admin'])->name('pembayaran.index');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayarans.store');
    Route::post('/user/pembayaran', [PembayaranController::class, 'storeUser'])->name('store.user');
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayarans.create');
    Route::put('/pembayarans/{id}', [PembayaranController::class, 'update']);
    Route::post('/get-booked-dates', [PembayaranController::class, 'getBookedDates']);

    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/midtrans/callback', [MidtransController::class, 'handleNotification'])->name('midtrans.callback');

    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/get-order', [OrderController::class, 'getOrder']);

    Route::post('/pembayaran/total-bayar', [DashboardController::class, 'getTotalBayar']);

    Route::post('/change-role', [UserController::class, 'changeRole'])->name('changeRole');

    Route::post('/get-users', [UserController::class, 'getUsers'])->name('users.get');
    Route::get('/user', [UserController::class, 'userList'])->name('users.list');

    Route::put('/pembayarans/konfirmasi/{id}', [PembayaranController::class, 'updateKonfirmasi']);
    Route::put('/pembayarans/status-pesanan/{id}', [PembayaranController::class, 'updateStatusPesanan']);
    Route::post('/pembayarans/ajukan-pencairan/{id}', [PembayaranController::class, 'ajukanPencairan']);

    Route::get('/pengajuan', [PembayaranController::class, 'daftarPengajuan'])->name('admin.pengajuan.index');
    Route::get('/dana', [PembayaranController::class, 'danaMasuk']);
    Route::get('/penyedia-jasa', [TokoController::class, 'getAllToko']);
    Route::post('/pengajuan/konfirmasi/{id}', [PembayaranController::class, 'konfirmasiPengajuan'])->name('admin.pengajuan.konfirmasi');
    Route::get('/laporan', [UserController::class, 'generatePDF']);

    
});

Route::get('/search', [DashboardController::class, 'search'])->name('search');

Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/items', [CartController::class, 'getCartItems']);
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add', [CartController::class, 'store']);
Route::put('/cart/update/{id}', [CartController::class, 'update']);
Route::delete('/cart/remove/{id}', [CartController::class, 'destroy']);
Route::get('/check-availability', [PembayaranController::class, 'checkAvailability'])->name('checkAvailability');

require __DIR__.'/auth.php';
