<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DukunganController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\MisiController;
use App\Http\Controllers\OurteamController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UnggulanController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\SvgController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\VisiController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\PixelsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SidebennerController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/login');
});


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


// Semua route yang butuh authentication
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/statistik', [SvgController::class, 'statistik'])->name('statistik.index');
    Route::get('/svg/{id}/edit', [SvgController::class, 'edit'])->name('svg.edit');
    Route::put('/svg/{id}', [SvgController::class, 'update'])->name('svg.update');


    Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
    Route::get('/show/{slug}', [PostController::class, 'show'])->name('show');
    Route::delete('/bulk-delete', [PostController::class, 'bulkDelete'])->name('bulkDelete');
    Route::post('/upload', [PostController::class, 'upload'])->name('upload');
});

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [CategoryController::class, 'show'])->name('show');
        Route::post('/upload', [CategoryController::class, 'upload'])->name('upload');
    });

    Route::prefix('agenda')->name('agenda')->group(function () {
        Route::get('/', [AgendaController::class, 'index'])->name('index');
        Route::post('/store', [AgendaController::class, 'store'])->name('store');
        Route::put('/update/{id}', [AgendaController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AgendaController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [AgendaController::class, 'upload'])->name('upload');
        Route::get('/show/{slug}', [AgendaController::class, 'show'])->name('show');
    });

    // Programs
    Route::prefix('programs')->name('programs.')->group(function () {
        Route::get('/program', [ProgramController::class, 'index'])->name('index');
        Route::post('/', [ProgramController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [ProgramController::class, 'show'])->name('show');
        Route::put('/update/{id}', [ProgramController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ProgramController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [ProgramController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [ProgramController::class, 'upload'])->name('upload');
    });

    // Unggulans
    Route::prefix('unggulans')->name('unggulans.')->group(function () {
        Route::get('/', [UnggulanController::class, 'index'])->name('index');
        Route::post('/store', [UnggulanController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [UnggulanController::class, 'show'])->name('show');
        Route::put('/update/{id}', [UnggulanController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [UnggulanController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [UnggulanController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [UnggulanController::class, 'upload'])->name('upload');
    });

    // Our Team
    Route::prefix('ourteam')->name('ourteam.')->group(function () {
        Route::get('/', [OurteamController::class, 'index'])->name('index');
        Route::post('/store', [OurteamController::class, 'store'])->name('store');
        Route::get('/show/{id}', [OurteamController::class, 'show'])->name('show');
        Route::post('/update/{id}', [OurteamController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [OurteamController::class, 'destroy'])->name('destroy');
    });

    // Pricing
    Route::prefix('pricing')->name('pricing')->group(function () {
        Route::get('/', [PricingController::class, 'index'])->name('index');
        Route::post('/store', [PricingController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [PricingController::class, 'show'])->name('show');
        Route::put('/update/{id}', [PricingController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PricingController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [PricingController::class, 'upload'])->name('upload');
        Route::delete('/bulk-delete', [PricingController::class, 'bulkDelete'])->name('bulk-delete');
    });

    Route::prefix('testimony')->group(function () {
        Route::get('/testimony', [TestimonyController::class, 'index'])->name('testimony.index');
        Route::post('/testimony', [TestimonyController::class, 'store'])->name('testimony.store');
        Route::get('/testimony/{slug}', [TestimonyController::class, 'show'])->name('testimony.show');
        Route::put('/testimony/{id}', [TestimonyController::class, 'update'])->name('testimony.update');
        Route::delete('/testimony/{id}', [TestimonyController::class, 'destroy'])->name('testimony.destroy');
        Route::post('/testimony/upload', [TestimonyController::class, 'upload'])->name('testimony.upload');
    });

    Route::prefix('portofolio')->group(function () {
        Route::get('/portofolio', [PricingController::class, 'index'])->name('portofolio.index');
        Route::post('/portofolio', [PricingController::class, 'store'])->name('portofolio.store');
        Route::get('/portofolio/{slug}', [PricingController::class, 'show'])->name('portofolio.show');
        Route::put('/portofolio/{id}', [PricingController::class, 'update'])->name('portofolio.update');
        Route::delete('/portofolio/{id}', [PricingController::class, 'destroy'])->name('portofolio.destroy');
        Route::delete('/portofolio-bulk-delete', [PricingController::class, 'bulkDelete'])->name('portofolio.bulk-delete');
    });

    Route::prefix('dukungan')->group(function () {
        Route::get('/dukungan', [DukunganController::class, 'index'])->name('dukungan.index');
        Route::post('/dukungan', [DukunganController::class, 'store'])->name('dukungan.store');
        Route::get('/dukungan/{slug}', [DukunganController::class, 'show'])->name('dukungan.show');
        Route::put('/dukungan/{id}', [DukunganController::class, 'update'])->name('dukungan.update');
        Route::delete('/pricing/{id}', [DukunganController::class, 'destroy'])->name('dukungan.destroy');
        Route::post('/dukungan/upload', [DukunganController::class, 'upload'])->name('dukungan.upload');
        Route::delete('/dukungan-bulk-delete', [DukunganController::class, 'bulkDelete'])->name('dukungan.bulk-delete');
    });

    Route::prefix('about')->group(function () {
        Route::get('/about', [AboutController::class, 'index'])->name('about.index');
        Route::get('/about/{slug}', [AboutController::class, 'show'])->name('about.show');
        Route::put('/about/{id}', [AboutController::class, 'update'])->name('about.update');
        Route::delete('/about/{id}', [AboutController::class, 'destroy'])->name('about.destroy');
    });
    Route::prefix('visi')->group(function () {
        Route::get('/visi', [VisiController::class, 'index'])->name('visi.index');
        Route::get('/visi/{slug}', [VisiController::class, 'show'])->name('visi.show');
        Route::put('/visi/{id}', [VisiController::class, 'update'])->name('visi.update');
        Route::delete('/visi/{id}', [VisiController::class, 'destroy'])->name('visi.destroy');
    });

    Route::prefix('visi')->group(function () {
        Route::get('/misi', [MisiController::class, 'index'])->name('misi.index');
        Route::get('/misi/{slug}', [MisiController::class, 'show'])->name('misi.show');
        Route::put('/misi/{id}', [MisiController::class, 'update'])->name('misi.update');
        Route::delete('/misi/{id}', [MisiController::class, 'destroy'])->name('misi.destroy');
    });

    Route::prefix('legal')->group(function () {
        Route::get('/legal', [LegalController::class, 'index'])->name('legal.index');
        Route::get('/legal/{id}', [LegalController::class, 'show'])->name('legal.show');
        Route::put('/legal/{id}', [LegalController::class, 'update'])->name('legal.update');
        Route::delete('/legal/{id}', [LegalController::class, 'destroy'])->name('legal.destroy');
        Route::post('/legal/upload', [LegalController::class, 'upload'])->name('legal.upload');
    });

    Route::prefix('patner')->group(function () {
        Route::get('/patner', [PartnerController::class, 'index'])->name('patner.index');
        Route::get('/patner/{slug}', [PartnerController::class, 'show'])->name('patner.show');
        Route::put('/patner/{id}', [PartnerController::class, 'update'])->name('patner.update');
        Route::delete('/patner/{id}', [PartnerController::class, 'destroy'])->name('patner.destroy');
        Route::post('/patner/upload', [PartnerController::class, 'upload'])->name('patner.upload');
    });

    Route::prefix('identity')->group(function () {
        Route::get('/identity/{id}/edit', [IdentityController::class, 'edit'])->name('identity.edit');
        Route::post('/identity/{id}', [IdentityController::class, 'update'])->name('identity.update');
        Route::post('/identity/upload', [IdentityController::class, 'upload'])->name('identity.upload');
    });

    Route::prefix('headers')->group(function () {
        Route::get('/headers', [HeaderController::class, 'index'])->name('header.index');
        Route::get('/headers/{id}/edit', [HeaderController::class, 'edit'])->name('header.edit');
        Route::put('/headers/{id}', [HeaderController::class, 'update'])->name('header.update');
        Route::delete('/headers/{id}/image', [HeaderController::class, 'destroyImage'])->name('header.image.delete');
        Route::post('/headers/upload', [HeaderController::class, 'upload'])->name('headers.upload');
    });

    Route::prefix('slider')->group(function () {
        Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/slider/{id}', [SliderController::class, 'show'])->name('slider.show');
        Route::put('/slider/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
        Route::post('/slider/upload', [SliderController::class, 'upload'])->name('slider.upload');
    });

    Route::prefix('service')->group(function () {
        Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('service.show');
        Route::put('/service/{id}', [ServiceController::class, 'update'])->name('service.update');
        Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
        Route::post('/service/upload', [ServiceController::class, 'upload'])->name('service.upload');
    });

    Route::prefix('sidebanner')->group(function () {
        Route::get('/sidebanner/{id}/edit', [SidebennerController::class, 'edit'])->name('sidebanner.edit');
        Route::put('/sidebanner/{id}', [SidebennerController::class, 'update'])->name('sidebanner.update');
        Route::delete('/sidebanner/{id}', [SidebennerController::class, 'destroy'])->name('sidebanner.destroy');
    });

    Route::prefix('pixel')->group(function () {
        Route::get('/pixel/{id}/edit', [PixelsController::class, 'edit'])->name('pixel.edit');
        Route::put('/pixel/{id}', [PixelsController::class, 'update'])->name('pixel.update');
    });

    Route::prefix('ganalytics')->group(function () {
        Route::get('/ganalytics/{id}/edit', [PixelsController::class, 'edit'])->name('ganalytics.edit');
        Route::put('/ganalytics/{id}', [PixelsController::class, 'update'])->name('ganalytics.update');
    });
});
