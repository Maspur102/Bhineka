<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

// Rute Otentikasi (Login/Logout) dari Laravel Breeze.
// Ini mengimpor semua rute seperti GET /login, POST /login, dll.
require __DIR__.'/auth.php'; 


/*
|--------------------------------------------------------------------------
| Rute Publik (Frontend)
|--------------------------------------------------------------------------
| Rute untuk pengguna umum yang melihat katalog produk.
*/

// GET / - Halaman Utama (Home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// GET /kategori/{slug} - Menampilkan daftar produk per kategori
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('category.show');

// GET /produk/{slug} - Menampilkan detail produk
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');


/*
|--------------------------------------------------------------------------
| Rute Admin (Backend) - Diproteksi dengan Middleware 'auth'
|--------------------------------------------------------------------------
| Rute yang hanya bisa diakses oleh Admin yang sudah login.
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // GET /admin - Dashboard Admin
    // Route ini menggunakan nama 'admin.dashboard'
    Route::get('/', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    // Route::resource /admin/products/* - CRUD Produk
    Route::resource('products', AdminProductController::class)->names('admin.products');

    /*
    |----------------------------------------------------------------------
    | PERBAIKAN: Redirect Setelah Login
    |----------------------------------------------------------------------
    | Laravel Breeze secara default mencari route 'dashboard'.
    | Kita buat alias agar 'dashboard' mengarahkan ke 'admin.dashboard'.
    */
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

});

// Catatan: Jika Anda telah memodifikasi app/Http/Controllers/Auth/AuthenticatedSessionController.php 
// di langkah sebelumnya (Opsi A) agar redirect langsung ke route('admin.dashboard'),
// maka blok Route::get('/dashboard', ...) di atas bisa dihapus.