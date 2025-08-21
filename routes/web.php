<?php

use App\Http\Controllers\CategoryKegiatanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KegiatanController;

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
    Route::delete('/bulk-delete', [KegiatanController::class, 'bulkDelete'])->name('bulkDelete');
    Route::get('/category/{id}', [KegiatanController::class, 'byCategory'])->name('byCategory');
});

Route::prefix('category-kegiatan')->name('category-kegiatan.')->group(function () {
    Route::get('/', [CategoryKegiatanController::class, 'index'])->name('index');
    Route::post('/', [CategoryKegiatanController::class, 'store'])->name('store');
    Route::put('/{id}', [CategoryKegiatanController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryKegiatanController::class, 'destroy'])->name('destroy');
});


