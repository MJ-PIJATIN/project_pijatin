<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SuspendedAccountController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayananController;

// Routing ke Landing Page
Route::get('/', function () {
    return view('pages.SuperAdminLandingPage');
});

// Routing Login dan Logout
Route::get('/login', function () {
    return view('pages.SuperAdminLogin');
})->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routing Sidebar Super Admin
Route::get('/dashboard', function () {
    return view('pages.SuperAdminDashboard');
})->name('dashboard');

// Page Layanan
Route::get('/layanan', [App\Http\Controllers\LayananController::class, 'index'])->name('layanan');
Route::post('/layanan-utama/update', [App\Http\Controllers\LayananController::class, 'update'])->name('layanan-utama.update');
Route::post('/layanan-utama/update-status', [App\Http\Controllers\LayananController::class, 'updateStatus'])->name('layanan-utama.updateStatus');
Route::delete('/layanan-utama/delete', [App\Http\Controllers\LayananController::class, 'destroy'])->name('layanan-utama.delete');
Route::post('/layanan-utama/store', [App\Http\Controllers\LayananController::class, 'store'])->name('layanan-utama.store');

Route::post('/layanan-tambahan/store', [App\Http\Controllers\LayananController::class, 'storeTambahan'])->name('layanan-tambahan.store');
Route::post('/layanan-tambahan/update', [App\Http\Controllers\LayananController::class, 'updateTambahan'])->name('layanan-tambahan.update');
Route::delete('/layanan-tambahan/delete', [App\Http\Controllers\LayananController::class, 'destroyTambahan'])->name('layanan-tambahan.delete');

// Page Pesanan
Route::get('/pesanan', function () {
    return view('pages.SuperAdminPesanan');
})->name('pesanan');

// Page Cabang
// Halaman Tambah Cabang
Route::get('/cabang', function () {
    return view('pages.SuperAdminCabang');
})->name('cabang');

Route::get('/cabang/tambah', function () {
    return view('pages.SuperAdminTambahCabang');
})->name('cabang.tambah');

// Halaman Detail Cabang
Route::get('/cabang/{id}', function ($id) {
    return view('pages.SuperAdminDetailCabang', ['id' => $id]);
})->where('id', '[0-9]+')->name('cabang.detail');

// Halaman Edit Cabang
Route::get('/cabang/{id}/edit', function ($id) {
    return view('pages.SuperAdminEditCabang', ['id' => $id]);
})->where('id', '[0-9]+')->name('cabang.edit');

//Halaman Karyawan
Route::get('/karyawan', function () {
    return view('pages.SuperAdminKaryawan');
})->name('karyawan');


//Halaman Pelanggan
Route::get('/pelanggan', function () {
    return view('pages.SuperAdminPelanggan');
})->name('pelanggan');


// Halaman Terapis
Route::get('/terapis', function () {
    return view('pages.SuperAdminTerapis');
})->name('terapis');

// Halaman Detail Terapis
Route::get('/detail-terapis', function () {
    return view('pages.SuperAdminDetailTerapis');
})->name('detail-terapis');

Route::get('/tambah-terapis', function () {
    return view('pages.SuperAdminTambahTerapis');
})->name('tambah-terapis');

//Halaman Penangguhan
Route::get('/penangguhan', [SuspendedAccountController::class, 'index'])->name('penangguhan');
Route::prefix('admin')->group(function () {
    
    // Routes untuk akun ditangguhkan
    Route::prefix('akun-ditangguhkan')->name('suspended-account.')->group(function () {

        // Halaman detail akun ditangguhkan
        Route::get('/{id}/detail', [SuspendedAccountController::class, 'detail'])
            ->name('detail')
            ->where('id', '[0-9]+'); // Hanya menerima ID berupa angka
        
        // API untuk memulihkan akun (AJAX)
        Route::post('/{id}/restore', [SuspendedAccountController::class, 'restore'])
            ->name('restore')
            ->where('id', '[0-9]+');
        
        // API untuk pencarian akun
        Route::get('/search', [SuspendedAccountController::class, 'search'])
            ->name('search');
        
    });
});

// Routes untuk Aduan Pelanggan
Route::get('/aduan-pelanggan', [App\Http\Controllers\AduanController::class, 'index'])->name('aduan-pelanggan');
Route::get('/detail-aduan/{id}', [App\Http\Controllers\AduanController::class, 'show'])->name('detiladuan');
Route::get('/aduan/search', [App\Http\Controllers\AduanController::class, 'search'])->name('aduan.search');
Route::get('/detail-report-terapis/{aduan_id}', [App\Http\Controllers\AduanController::class, 'showTerapisDetail'])->name('detail.report.terapis');
Route::post('/suspended-accounts/{id}/restore', [SuspendedAccountController::class, 'restore'])->name('suspended-account.restore');

// Halaman FAQ
Route::get('/faq', function () {
    return view('pages.SuperAdminFAQ');
})->name('faq');

// Page Cabang
// Halaman Tambah Cabang
Route::get('/cabang/tambah', function () {
    return view('pages.SuperAdminTambahCabang');
})->name('cabang.tambah');

// Halaman Detail Cabang
Route::get('/cabang/{id}', function ($id) {
    return view('pages.SuperAdminDetailCabang', ['id' => $id]);
})->where('id', '[0-9]+')->name('cabang.detail');

// Halaman Edit Cabang
Route::get('/cabang/{id}/edit', function ($id) {
    return view('pages.SuperAdminEditCabang', ['id' => $id]);
})->where('id', '[0-9]+')->name('cabang.edit');

//Page Pesanan
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

Route::get('/pesanan/detail/{tipe}/{id}', [PesananController::class, 'detail'])->name('pesanan.detail');

Route::put('/pesanan/{tipe}/{id}/update-status', [PesananController::class, 'updateStatus'])
    ->name('pesanan.updateStatus');

//PAGE KARYAWAN
//tambah karyawan
Route::get('/tambah/karyawan', function () {
    return view('pages.SuperAdminKaryawanBuatAkun');
})->name('tambah.karyawan');

// detail karyawan admin
Route::get('/karyawan/{id}', function ($id) {
    return view('pages.SuperAdminKaryawanDetailAkun', ['id' => $id]);
})->where('id', '[0-9]+')->name('detail.karyawan');

// detail karyawan finance 
Route::get('/karyawan/finance/{id}', function ($id) {
    return view('pages.SuperAdminKaryawanDetailAkunFInance', ['id' => $id]);
})->where('id', '[0-9]+')->name('detail.akun.finance');

//PAGE PELANGGAN
// detail akun pelanggan
Route::get('/pelanggan/{id}', function ($id) {
    return view('pages.SuperAdminPelangganDetailAkun', ['id' => $id]);
})->where('id', '[0-9]+')->name('detail.akun.pelanggan');