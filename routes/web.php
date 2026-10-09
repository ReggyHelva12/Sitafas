<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PetugasDashboardController;
use App\Http\Controllers\AntreanController;
use App\Http\Controllers\MasterController;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// ==============================
// LOGIN
// ==============================

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');


// ==============================
// PROSES LOGIN
// ==============================

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');


// ==============================
// LOGOUT
// ==============================

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| REGISTRASI PERGURUAN TINGGI
|--------------------------------------------------------------------------
| Halaman publik
|--------------------------------------------------------------------------
*/

// ==============================
// FORM REGISTRASI
// ==============================

Route::get(
    '/registrasi',
    [RegistrasiController::class, 'create']
)->name('registrasi.create');


// ==============================
// SIMPAN REGISTRASI
// ==============================

Route::post(
    '/registrasi',
    [RegistrasiController::class, 'store']
)->name('registrasi.store');


// ==============================
// TRACKING TIKET
// ==============================

Route::get(
    '/registrasi/track',
    [RegistrasiController::class, 'track']
)->name('registrasi.track');


// ==============================
// STATUS TRACKING TIKET
// ==============================

Route::get(
    '/registrasi/track/status/{nomor_tiket}',
    [RegistrasiController::class, 'trackStatus']
)->name('registrasi.track.status');


// ==============================
// CHECK STATUS TIKET
// ==============================

Route::get(
    '/registrasi/check-status',
    [RegistrasiController::class, 'checkStatus']
)->name('registrasi.checkStatus');


// ==============================
// SUKSES REGISTRASI
// ==============================

Route::get(
    '/registrasi/sukses/{id}',
    [RegistrasiController::class, 'success']
)->name('registrasi.success');


// ==============================
// CETAK TIKET REGISTRASI
// ==============================
Route::get(
    '/registrasi/tiket/{id}/cetak',
    [RegistrasiController::class, 'cetakTiket']
)->name('registrasi.cetak');


// ==============================
// LACAK TIKET BERDASARKAN NAMA PT 
// ==============================
Route::get(
    '/registrasi/track-pt',
    [RegistrasiController::class, 'trackByPT']
)->name('registrasi.track.pt');

Route::get(
    '/registrasi/cek-status-popup/{id}',
    [RegistrasiController::class, 'cekStatusPopup']
)->name('registrasi.cek-status-popup');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
| Semua route admin membutuhkan login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | KELOLA USER
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'users',
            UserController::class
        )->except(['show']);


        // Toggle status user
        Route::patch(
            'users/{id}/toggle',
            [UserController::class, 'toggle']
        )->name('users.toggle');


        /*
|--------------------------------------------------------------------------
| MASTER / UPLOAD DOKUMEN
|--------------------------------------------------------------------------
*/

Route::get(
    '/master',
    [MasterController::class, 'index']
)->name('master.index');

Route::post(
    '/master/upload',
    [MasterController::class, 'upload']
)->name('master.upload');

Route::delete(
    '/master/{id}',
    [MasterController::class, 'destroy']
)->name('master.destroy');

Route::delete(
    '/master',
    [MasterController::class, 'destroyAll']
)->name('master.destroyAll');


        /*
        |--------------------------------------------------------------------------
        | KELOLA REGISTRASI
        |--------------------------------------------------------------------------
        */

        // Daftar registrasi
        Route::get(
            '/registrasi',
            [RegistrasiController::class, 'index']
        )->name('registrasi.index');


        // Export registrasi
        // Harus sebelum /registrasi/{id}
        Route::get(
            '/registrasi/export',
            [RegistrasiController::class, 'export']
        )->name('registrasi.export');


        // Cek status tiket
        // Harus sebelum /registrasi/{id}
        Route::get(
            '/registrasi/cek-status-tiket/{id}',
            [RegistrasiController::class, 'cekStatusTiket']
        )->name('registrasi.cekStatusTiket');


        // Detail registrasi
        Route::get(
            '/registrasi/{id}',
            [RegistrasiController::class, 'show']
        )->name('registrasi.show');


        // Hapus registrasi
        Route::delete(
            '/registrasi/{id}',
            [RegistrasiController::class, 'destroy']
        )->name('registrasi.destroy');


        // Update status registrasi
        Route::put(
            '/registrasi/{id}/status',
            [RegistrasiController::class, 'updateStatus']
        )->name('registrasi.updateStatus');


        /*
        |--------------------------------------------------------------------------
        | KELOLA TIKET
        |--------------------------------------------------------------------------
        */

        // Daftar tiket
        Route::get(
            '/tiket',
            [TiketController::class, 'index']
        )->name('tiket.index');


        // Export tiket
        Route::get(
            '/tiket-export',
            [TiketController::class, 'export']
        )->name('tiket.export');


        // Detail tiket
        Route::get(
            '/tiket/{id}',
            [TiketController::class, 'show']
        )->name('tiket.show');


        // Mulai proses tiket
        Route::put(
            '/tiket/{id}/mulai',
            [TiketController::class, 'mulai']
        )->name('tiket.mulai');


        // Lewati tiket
        Route::put(
            '/tiket/{id}/lewati',
            [TiketController::class, 'lewati']
        )->name('tiket.lewati');


        // Selesaikan tiket
        Route::put(
            '/tiket/{id}/selesai',
            [TiketController::class, 'selesai']
        )->name('tiket.selesai');


        // Hapus tiket
        Route::delete(
            '/tiket/{id}',
            [TiketController::class, 'destroy']
        )->name('tiket.destroy');


        /*
        |--------------------------------------------------------------------------
        | MONITOR ANTREAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/monitor-antrean',
            [MonitorController::class, 'index']
        )->name('monitor.index');

        Route::get(
    '/monitor/{id}',
    [MonitorController::class, 'show']
)->name('monitor.show');


        /*
        |--------------------------------------------------------------------------
        | PENGATURAN
        |--------------------------------------------------------------------------
        */

        Route::prefix('pengaturan')
            ->name('pengaturan.')
            ->group(function () {


                /*
                |--------------------------------------------------------------------------
                | PENGATURAN ANTREAN
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/antrian',
                    [PengaturanController::class, 'antrian']
                )->name('antrian');


                Route::put(
                    '/antrian',
                    [PengaturanController::class, 'updateAntrian']
                )->name('antrian.update');


                /*
                |--------------------------------------------------------------------------
                | PENGATURAN NOTIFIKASI
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/notifikasi',
                    [PengaturanController::class, 'notifikasi']
                )->name('notifikasi');


                Route::put(
                    '/notifikasi',
                    [PengaturanController::class, 'updateNotifikasi']
                )->name('notifikasi.update');

            });

});


/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
| Semua halaman Petugas dapat diakses tanpa login.
|--------------------------------------------------------------------------
*/

Route::prefix('petugas')
    ->name('petugas.')
    ->group(function () {


    /*
    |--------------------------------------------------------------------------
    | REGISTRASI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/registrasi',
        [RegistrasiController::class, 'petugasIndex']
    )->name('registrasi.index');


    /*
    |--------------------------------------------------------------------------
    | DETAIL REGISTRASI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/registrasi/{id}',
        [RegistrasiController::class, 'petugasShow']
    )->name('registrasi.show');


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD PETUGAS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [PetugasDashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | HALAMAN ANTREAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/antrean',
        [AntreanController::class, 'index']
    )->name('antrean.index');


    /*
    |--------------------------------------------------------------------------
    | PANGGIL ANTREAN
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/antrean/{id}/panggil',
        [AntreanController::class, 'panggil']
    )->name('antrean.panggil');


    /*
    |--------------------------------------------------------------------------
    | LEWATI ANTREAN
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/antrean/{id}/lewati',
        [AntreanController::class, 'lewati']
    )->name('antrean.lewati');


    /*
    |--------------------------------------------------------------------------
    | PANGGIL ULANG
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/antrean/{id}/panggil-ulang',
        [AntreanController::class, 'panggilUlang']
    )->name('antrean.panggil-ulang');


    /*
    |--------------------------------------------------------------------------
    | SELESAI
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/antrean/{id}/selesai',
        [AntreanController::class, 'selesai']
    )->name('antrean.selesai');


    /*
    |--------------------------------------------------------------------------
    | RESET TIMER
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/antrean/{id}/reset-timer',
        [AntreanController::class, 'resetTimer']
    )->name('antrean.reset-timer');


    /*
    |--------------------------------------------------------------------------
    | PAUSE TIMER
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/antrean/{id}/pause-timer',
        [AntreanController::class, 'pauseTimer']
    )->name('antrean.pause-timer');


    /*
    |--------------------------------------------------------------------------
    | RESUME TIMER
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/antrean/{id}/resume-timer',
        [AntreanController::class, 'resumeTimer']
    )->name('antrean.resume-timer');

});