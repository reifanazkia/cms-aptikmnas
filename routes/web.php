<?php

use App\Http\Controllers\CategoryDaftarDPDController;
use App\Http\Controllers\CategoryGalleryController;
use App\Http\Controllers\CategoryKegiatanController;
use App\Http\Controllers\CategoryPengurusController;
use App\Http\Controllers\CategoryStoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth']);



Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('/create', [ContactController::class, 'create'])->name('create');
    Route::post('/', [ContactController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ContactController::class, 'update'])->name('update');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
});



Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
    Route::get('/', [KegiatanController::class, 'index'])->name('index');
    Route::get('/create', [KegiatanController::class, 'create'])->name('create');
    Route::post('/', [KegiatanController::class, 'store'])->name('store');
    Route::get('/{id}', [KegiatanController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [KegiatanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [KegiatanController::class, 'update'])->name('update');
    Route::delete('/{id}', [KegiatanController::class, 'destroy'])->name('destroy');
    Route::get('/category/{id}', [KegiatanController::class, 'byCategory'])->name('byCategory');
});
Route::prefix('category-kegiatan')->name('category-kegiatan.')->group(function () {
    Route::get('/', [CategoryKegiatanController::class, 'index'])->name('index');
    Route::post('/', [CategoryKegiatanController::class, 'store'])->name('store');
    Route::put('/{id}', [CategoryKegiatanController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryKegiatanController::class, 'destroy'])->name('destroy');
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::prefix('category-store')->name('category-store.')->group(function () {
    Route::get('/', [CategoryStoreController::class, 'index'])->name('index');
    Route::post('/store', [CategoryStoreController::class, 'store'])->name('store');
    Route::put('/{id}', [CategoryStoreController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryStoreController::class, 'destroy'])->name('destroy');
});

Route::prefix('gallery')->name('gallery.')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('index');
    Route::get('/create', [GalleryController::class, 'create'])->name('create');
    Route::post('/', [GalleryController::class, 'store'])->name('store');
    Route::get('/{gallery}', [GalleryController::class, 'show'])->name('show');
    Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('edit');
    Route::put('/{gallery}', [GalleryController::class, 'update'])->name('update');
    Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('destroy');
    Route::get('/home', [GalleryController::class, 'home'])->name('home');
    Route::get('/gallery/category/{id}', [GalleryController::class, 'byCategory'])->name('gallery.byCategory');
});

Route::prefix('category-gallery')->name('category-gallery.')->group(function () {
    Route::get('/', [CategoryGalleryController::class, 'index'])->name('index');
    Route::post('/store', [CategoryGalleryController::class, 'store'])->name('store');
    Route::put('/update/{id}', [CategoryGalleryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryGalleryController::class, 'destroy'])->name('destroy');
});
Route::prefix('category-daftar')->name('category-daftar.')->group(function () {
    Route::get('/', [CategoryDaftarDPDController::class, 'index'])->name('index');
    Route::post('/store', [CategoryDaftarDPDController::class, 'store'])->name('store');
    Route::put('/update/{id}', [CategoryDaftarDPDController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryDaftarDPDController::class, 'destroy'])->name('destroy');
});
Route::prefix('category-pengurus')->name('category-pengurus.')->group(function () {
    Route::get('/', [CategoryPengurusController::class, 'index'])->name('index');
    Route::post('/store', [CategoryPengurusController::class, 'store'])->name('store');
    Route::put('/update/{id}', [CategoryPengurusController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryPengurusController::class, 'destroy'])->name('destroy');
});

Route::prefix('pengurus')->name('pengurus.')->group(function () {
    // Index dan Show
    Route::get('/', [PengurusController::class, 'index'])->name('index');
    Route::get('/{id}', [PengurusController::class, 'show'])->name('show');

    // Create Routes (3 steps)
    Route::get('/create/step1', [PengurusController::class, 'create'])->name('create');
    Route::post('/create/step1', [PengurusController::class, 'storeStep1'])->name('create.step1.store');

    Route::get('/create/{id}/step2', [PengurusController::class, 'createStep2'])->name('create.step2');
    Route::post('/create/{id}/step2', [PengurusController::class, 'storeStep2'])->name('create.step2.store');

    Route::get('/create/{id}/step3', [PengurusController::class, 'createStep3'])->name('create.step3');
    Route::post('/create/{id}/step3', [PengurusController::class, 'storeStep3'])->name('create.step3.store');

    // Edit Routes (3 steps)
    Route::get('/{id}/edit/step1', [PengurusController::class, 'edit'])->name('edit');
    Route::put('/{id}/edit/step1', [PengurusController::class, 'updateStep1'])->name('edit.step1.update');

    Route::get('/{id}/edit/step2', [PengurusController::class, 'editStep2'])->name('edit.step2');
    Route::put('/{id}/edit/step2', [PengurusController::class, 'updateStep2'])->name('edit.step2.update');

    Route::get('/{id}/edit/step3', [PengurusController::class, 'editStep3'])->name('edit.step3');
    Route::put('/{id}/edit/step3', [PengurusController::class, 'updateStep3'])->name('edit.step3.update');

    // Delete
    Route::delete('/{id}', [PengurusController::class, 'destroy'])->name('destroy');
});

Route::prefix('partners')->name('partners.')->group(function () {
    Route::get('/', [PartnerController::class, 'index'])->name('index');
    Route::get('/create', [PartnerController::class, 'create'])->name('create');
    Route::post('/store', [PartnerController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PartnerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PartnerController::class, 'update'])->name('update');
    Route::delete('/{id}', [PartnerController::class, 'destroy'])->name('destroy');
});
