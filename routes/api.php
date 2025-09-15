<?php

use App\Http\Controllers\Api\ApiAgendaController;
use App\Http\Controllers\Api\ApiApplicationController;
use App\Http\Controllers\Api\ApiCareerController;
use App\Http\Controllers\Api\ApiContactController;
use App\Http\Controllers\Api\ApiGalleryController;
use App\Http\Controllers\Api\ApiPartnerController;
use App\Http\Controllers\Api\ApiPengurusController;
use App\Http\Controllers\Api\ApiTestimonyController;
use App\Http\Controllers\Api\ApiAboutController;
use App\Http\Controllers\Api\ApiAboutusController;
use App\Http\Controllers\Api\ApiReportController;
use App\Http\Controllers\Api\ApiSliderController;
use App\Http\Controllers\Api\PodcastApiController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Api\ApiPodcastsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CategoryDaftarDPDController;
use App\Http\Controllers\CategoryGalleryController;
use App\Http\Controllers\CategoryPengurusController;
use App\Http\Controllers\CategoryStoreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/aboutus', [ApiAboutusController::class, 'index']);
Route::get('/category/{id}', [ApiAboutusController::class, 'getByCategory']);
Route::get('/category-name/{name}', [ApiAboutusController::class, 'getByCategoryName']);
Route::get('/display/home', [ApiAboutusController::class, 'getDisplayOnHome']);
Route::get('/agenda', [ApiAgendaController::class, 'index']);
Route::get('/agenda/{id}', [ApiAgendaController::class, 'show']);
Route::get('/application', [ApiApplicationController::class, 'index']);
Route::get('/application/{id}', [ApiApplicationController::class, 'show']);
Route::post('/applications', [ApiApplicationController::class, 'store']);
Route::get('/career', [ApiCareerController::class, 'index']);
Route::get('/career/{id}', [ApiCareerController::class, 'show']);
Route::get('/contact', [ApiContactController::class, 'index']);
Route::get('/contact/{id}', [ApiContactController::class, 'show']);
Route::get('/gallery', [ApiGalleryController::class, 'index']);
Route::get('/gallery/{id}', [ApiGalleryController::class, 'show']);
Route::get('/gallery-home', [ApiGalleryController::class, 'home']);
Route::get('/gallery-category/{id}', [ApiGalleryController::class, 'byCategory']);
Route::get('/partners', [ApiPartnerController::class, 'index']);
Route::get('/partners/{id}', [ApiPartnerController::class, 'show']);
Route::get('/pengurus', [ApiPengurusController::class, 'index']);
Route::get('/pengurus/{id}', [ApiPengurusController::class, 'show']);
Route::get('/testimonies', [ApiTestimonyController::class, 'index']);
Route::get('/testimonies/{id}', [ApiTestimonyController::class, 'show']);
Route::get('/slider', [ApiSliderController::class, 'index']);
Route::get('/slider/home', [ApiSliderController::class, 'showHomeSlider']);
Route::get('/about', [ApiAboutController::class, 'index']);
Route::get('/about/{id}', [ApiAboutController::class, 'show']);
Route::get('/podcast', [ApiPodcastsController::class, 'index']);
Route::get('/podcast{id}', [ApiPodcastsController::class, 'show']);
Route::get('/report', [ApiReportController::class, 'index']);
Route::get('/{id}', [ApiReportController::class, 'show']);
Route::post('/', [ApiReportController::class, 'store']);


Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('contact')->name('contact.')->group(function () {
        Route::post('/', [ContactController::class, 'store'])->name('store');
        Route::put('/{id}', [ContactController::class, 'update'])->name('update');
        Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category-store')->name('category-store.')->group(function () {
        Route::post('/store', [CategoryStoreController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CategoryStoreController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoryStoreController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::post('/', [GalleryController::class, 'store'])->name('store');
        Route::put('/{gallery}', [GalleryController::class, 'update'])->name('update');
        Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category-gallery')->name('category-gallery.')->group(function () {
        Route::post('/store', [CategoryGalleryController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CategoryGalleryController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoryGalleryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category-daftar')->name('category-daftar.')->group(function () {
        Route::post('/store', [CategoryDaftarDPDController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CategoryDaftarDPDController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoryDaftarDPDController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category-pengurus')->name('category-pengurus.')->group(function () {
        Route::post('/store', [CategoryPengurusController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CategoryPengurusController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoryPengurusController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('pengurus')->name('pengurus.')->group(function () {
        Route::post('/create/step1', [PengurusController::class, 'storeStep1'])->name('create.step1.store');
        Route::post('/create/{id}/step2', [PengurusController::class, 'storeStep2'])->name('create.step2.store');
        Route::post('/create/{id}/step3', [PengurusController::class, 'storeStep3'])->name('create.step3.store');
        Route::put('/{id}/edit/step1', [PengurusController::class, 'updateStep1'])->name('edit.step1.update');
        Route::put('/{id}/edit/step2', [PengurusController::class, 'updateStep2'])->name('edit.step2.update');
        Route::put('/{id}/edit/step3', [PengurusController::class, 'updateStep3'])->name('edit.step3.update');
        Route::delete('/{id}', [PengurusController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('partners')->name('partners.')->group(function () {
        Route::post('/store', [PartnerController::class, 'store'])->name('store');
        Route::put('/{id}', [PartnerController::class, 'update'])->name('update');
        Route::delete('/{id}', [PartnerController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('testimonies')->name('testimonies.')->group(function () {
        Route::post('/store', [TestimonyController::class, 'store'])->name('store');
        Route::post('/update/{testimony}', [TestimonyController::class, 'update'])->name('update');
        Route::delete('/delete/{testimony}', [TestimonyController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('aboutus')->name('aboutus.')->group(function () {
        Route::post('/store', [AboutusController::class, 'store'])->name('store');
        Route::post('/update/{id}', [AboutusController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AboutusController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('agenda')->name('agenda.')->group(function () {
        Route::post('/store', [AgendaController::class, 'store'])->name('store');
        Route::put('/update/{id}', [AgendaController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AgendaController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('career')->name('career.')->group(function () {
        Route::post('/store', [CareerController::class, 'store'])->name('store');
        Route::put('/{id}/update', [CareerController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [CareerController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('applications')->name('applications.')->group(function () {
        Route::post('/store', [ApplicationController::class, 'store'])->name('store');
        Route::put('/{id}/update', [ApplicationController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [ApplicationController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-delete', [ApplicationController::class, 'bulkDelete'])->name('bulk-delete');
    });

    Route::prefix('slider')->name('slider.')->group(function () {
        Route::post('/', [SliderController::class, 'store'])->name('store');
        Route::put('/{id}', [SliderController::class, 'update'])->name('update');
        Route::delete('/{id}', [SliderController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('about')->name('about.')->group(function () {
        Route::post('/', [AboutController::class, 'store'])->name('store');
        Route::put('/{id}', [AboutController::class, 'update'])->name('update');
        Route::delete('/{id}', [AboutController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('podcasts')->name('podcasts.')->group(function () {
        Route::post('/store', [PodcastController::class, 'store'])->name('store');
        Route::put('/{id}', [PodcastController::class, 'update'])->name('update');
        Route::delete('/{id}', [PodcastController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('report')->name('report.')->group(function () {
        Route::post('/store', [ReportController::class, 'store'])->name('store');
        Route::put('/{id}', [ReportController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReportController::class, 'destroy'])->name('destroy');
    });


    Route::post('/logout', [UserController::class, 'logout']);
});

Route::post('/login', [UserController::class, 'login']);
