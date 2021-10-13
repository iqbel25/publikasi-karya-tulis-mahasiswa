<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers\User\Koleksi;
use App\Http\Controllers\User\Upload;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [User\UserController::class, 'index'])->name('user');

Route::prefix('repository')->middleware('auth')->group(function () {
    Route::middleware('cekLevel:1,2')->group(function () {
        // dashboard
        Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
        // skripsi
        Route::resource('skripsi', Admin\SkripsiController::class);
        Route::put('skripsi/accept/{id}', [Admin\SkripsiController::class, 'accept']);
        Route::put('skripsi/reject/{id}', [Admin\SkripsiController::class, 'reject'])->name('skripsi.reject');
        // kkp
        Route::resource('kkp', Admin\KkpController::class);
        Route::put('kkp/accept/{id}', [Admin\KkpController::class, 'accept']);
        Route::put('kkp/reject/{id}', [Admin\KkpController::class, 'reject'])->name('kkp.reject');
        // dosen
        Route::resource('dosen', Admin\DosenController::class);
        // mahasiswa
        Route::resource('mahasiswa', Admin\MahasiswaController::class);
    });

    Route::middleware('cekLevel:1')->group(function () {
        // prodi
        Route::resource('prodi', Admin\ProdiController::class);
    });
});
// koleksi
Route::prefix('koleksi')->group(function () {
    // Kkp
    Route::get('kkp', [Koleksi\KkpController::class, 'index'])->name('koleksi.kkp');
    // Skripsi
    Route::get('skripsi', [Koleksi\SkripsiController::class, 'index'])->name('koleksi.skripsi');
});

Route::middleware('auth')->group(function () {
    // Profile
    Route::prefix('profile')->group(function () {
        Route::middleware('cekLevel:1')->group(function () {
            // Edit admin
            Route::get('admin', [User\UserController::class, 'profileAdmin'])->name('profile.admin');
            Route::put('admin/{id}', [User\UserController::class, 'updateProfileAdmin'])->name('profile.admin.update');
        });
        Route::middleware('cekLevel:2')->group(function () {
            // Edit prodi
            Route::get('prodi', [User\UserController::class, 'profileProdi'])->name('profile.prodi');
            Route::get('prodi/{id}', [User\UserController::class, 'editProfileProdi'])->name('profile.prodi.edit');
            Route::put('prodi/{id}', [User\UserController::class, 'updateProfileProdi'])->name('profile.prodi.update');
        });
        Route::middleware('cekLevel:3')->group(function () {
            // Edit prodi
            Route::get('dosen', [User\UserController::class, 'profileDosen'])->name('profile.dosen');
            Route::get('dosen/{id}', [User\UserController::class, 'editProfileDosen'])->name('profile.dosen.edit');
            Route::put('dosen/{id}', [User\UserController::class, 'updateProfileDosen'])->name('profile.dosen.update');
        });
        Route::middleware('cekLevel:4')->group(function () {
            // Edit prodi
            Route::get('mahasiswa', [User\UserController::class, 'profileMahasiswa'])->name('profile.mahasiswa');
            Route::get('mahasiswa/{id}', [User\UserController::class, 'editProfileMahasiswa'])->name('profile.mahasiswa.edit');
            Route::put('mahasiswa/{id}', [User\UserController::class, 'updateProfileMahasiswa'])->name('profile.mahasiswa.update');
        });
    });
    // Upload
    Route::prefix('upload')->middleware('cekLevel:4')->group(function () {
        // Skripsi
        Route::post('skripsi', [Admin\SkripsiController::class, 'store'])->name('upload.skripsi.store');
        Route::get('skripsi', [Upload\SkripsiController::class, 'index'])->name('upload.skripsi');
        Route::get('skripsi/{id}/edit', [Upload\SkripsiController::class, 'edit'])->name('upload.skripsi.edit');
        Route::put('skripsi/{id}', [Upload\SkripsiController::class, 'update'])->name('upload.skripsi.update');
        // Kkp
        Route::post('kkp', [Admin\KkpController::class, 'store'])->name('upload.kkp.store');
        Route::get('kkp', [Upload\KkpController::class, 'index'])->name('upload.kkp');
        Route::get('kkp/{id}/edit', [Upload\KkpController::class, 'edit'])->name('upload.kkp.edit');
        Route::put('kkp/{id}', [Upload\KkpController::class, 'update'])->name('upload.kkp.update');
    });
});
