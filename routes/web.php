<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenyewaController;

Route::get('/', [LandingController::class, 'landing'])->name('landing');
Route::get('/login', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::prefix('penyewa')->group(function () {
        Route::get('/dashboard', [PenyewaController::class, 'penyewaDashboard'])->name('penyewa.dashboard');
        Route::get('/alat-berat/{id}', [PenyewaController::class, 'show'])->name('penyewa.show');
        Route::get('/sewa', [PenyewaController::class, 'sewaForm'])->name('penyewa.sewa');
        Route::post('/sewa/store', [PenyewaController::class, 'sewaStore'])->name('penyewa.sewa.store');
        Route::get('/sewa/payment/{id}', [PenyewaController::class, 'paymentForm'])->name('penyewa.sewa.payment');
        Route::post('/sewa/payment/{id}', [PenyewaController::class, 'paymentStore'])->name('penyewa.sewa.payment.store');
        Route::post('/sewa/payment/{id}/batal', [PenyewaController::class, 'cancelSewa'])->name('penyewa.sewa.batal');
        Route::get('/sewa/{id}', [PenyewaController::class, 'detailSewa'])->name('penyewa.sewa.detail');
        Route::get('/sewaAktif', [PenyewaController::class, 'sewaAktif'])->name('penyewa.sewa.aktif');
        Route::get('/pengembalian/form', [PenyewaController::class, 'pengembalianForm'])->name('penyewa.pengembalian.form');
        Route::post('/pengembalian/store', [PenyewaController::class, 'pengembalianStore'])->name('penyewa.pengembalian.store');
        Route::get('/company-profile', [PenyewaController::class, 'companyProfile'])->name('penyewa.companyProfile');
        

    });

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/alat-berat/{id}', [AdminController::class, 'show'])->name('admin.show');
        Route::get('/admin/alat-berat/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/alat-berat/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/alat-berat/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/alat-berat/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/alat-berat/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::get('/bayar', [AdminController::class, 'listBayar'])->name('admin.bayar');
        Route::get('/bayar/{id}', [AdminController::class, 'detailBayar'])->name('admin.bayar.detail');
        Route::post('/bayar/{id}/approve', [AdminController::class, 'approveBayar'])->name('admin.bayar.approve');
        Route::post('/bayar/{id}/reject', [AdminController::class, 'rejectBayar'])->name('admin.bayar.reject');
        Route::get('/sewa', [AdminController::class, 'listSewa'])->name('admin.sewa');
        Route::get('/sewa/{id}', [AdminController::class, 'detailSewa'])->name('admin.sewa.detail');
        Route::post('/sewa/{id}/approve', [AdminController::class, 'approveSewa'])->name('admin.sewa.approve');
        Route::post('/sewa/{id}/reject', [AdminController::class, 'rejectSewa'])->name('admin.sewa.reject');
        Route::get('/pengembalian/approval', [AdminController::class, 'pengembalianApproval'])->name('admin.pengembalian.approval');
        Route::get('/pengembalian/{id}', [AdminController::class, 'showPengembalian'])->name('admin.pengembalian.show');
        Route::post('/pengembalian/{id}/approve', [AdminController::class, 'pengembalianApprove'])->name('admin.pengembalian.approve');
        Route::get('/karyawan', [AdminController::class, 'showKaryawan'])->name('admin.karyawan.show');
        Route::get('/karyawan/create', [AdminController::class, 'createKaryawan'])->name('admin.karyawan.create');
        Route::post('/karyawan/store', [AdminController::class, 'storeKaryawan'])->name('admin.karyawan.store');
        Route::delete('/karyawan/{id}', [AdminController::class, 'destroyKaryawan'])->name('admin.karyawan.destroy');
        Route::get('/kendaraanPengantar', [AdminController::class, 'showKendaraanPengantar'])->name('admin.kendaraanPengantar.show');
        Route::get('/kendaraanPengantar/create', [AdminController::class, 'createKendaraanPengantar'])->name('admin.kendaraanPengantar.create');
        Route::post('/kendaraanPengantar/store', [AdminController::class, 'storeKendaraanPengantar'])->name('admin.kendaraanPengantar.store');
        Route::delete('/kendaraanPengantar/{id}', [AdminController::class, 'destroyKendaraanPengantar'])->name('admin.kendaraanPengantar.destroy');
        Route::get('/user', [AdminController::class, 'showUser'])->name('admin.user.show');
        Route::get('/user/create', [AdminController::class, 'createUser'])->name('admin.user.create');
        Route::patch('/user/{user}/edit-role', [AdminController::class, 'editUserRole'])->name('admin.user.editRole');
        Route::get('/dataMaster', [AdminController::class, 'showDataMaster'])->name('admin.dataMaster.show');
        
        Route::get('/riwayat', [AdminController::class, 'riwayat'])->name('admin.riwayat');
        Route::get('/riwayat/{id}', [AdminController::class, 'showRiwayat'])->name('admin.riwayat.show');

        Route::get('/sewaAktif', [AdminController::class, 'sewaAktif'])->name('admin.sewa.aktif');
        Route::get('/sewaAktif/{id}', [AdminController::class, 'showSewaAktif'])->name('admin.sewaAktif.show');

        Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    });
});

require __DIR__.'/auth.php';
