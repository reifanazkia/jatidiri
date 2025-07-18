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
use App\Http\Controllers\ServiceController;
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


    // Admin Posts
    Route::prefix('posts')->group(function () {
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
        Route::delete('/posts-bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulkDelete');
        Route::post('/ckeditor/upload-post', [PostController::class, 'upload'])->name('posts.upload');
    });

    // Admin Category
    Route::prefix('category')->group(function () {
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
        Route::post('/ckeditor/upload-category', [CategoryController::class, 'upload'])->name('category.upload');
    });

    // Admin Agenda
    Route::prefix('agenda')->group(function () {
        Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
        Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
        Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');
        Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
        Route::post('/ckeditor/upload', [AgendaController::class, 'upload'])->name('agenda.upload');
        Route::get('/agenda/{slug}', [AgendaController::class, 'show'])->name('agenda.show');
    });

    // YouTube
    Route::prefix('yutubs')->group(function () {
        Route::get('/yutubs', [YoutubeController::class, 'index'])->name('yutubs.index');
        Route::post('/yutubs', [YoutubeController::class, 'store'])->name('yutubs.store');
        Route::get('/yutubs/{id}', [YoutubeController::class, 'show'])->name('yutubs.show');
        Route::put('/yutub/{id}', [YoutubeController::class, 'update'])->name('yutubs.update');
        Route::delete('/yutub/{id}', [YoutubeController::class, 'destroy'])->name('yutubs.destroy');
    });

    // Programs
    Route::prefix('programs')->group(function () {
        Route::get('/program', [ProgramController::class, 'index'])->name('programs.index');
        Route::post('/', [ProgramController::class, 'store'])->name('programs.store');
        Route::get('/{slug}', [ProgramController::class, 'show'])->name('programs.show');
        Route::put('/{id}', [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('/{id}', [ProgramController::class, 'destroy'])->name('programs.destroy');
        Route::delete('/bulk-delete', [ProgramController::class, 'bulkDelete'])->name('programs.bulkDelete');
        Route::post('/upload', [ProgramController::class, 'upload'])->name('programs.upload');
    });

    // Unggulans
    Route::prefix('unggulans')->group(function () {
        Route::get('/unggulans', [UnggulanController::class, 'index'])->name('unggulans.index');
        Route::post('/unggulans', [UnggulanController::class, 'store'])->name('unggulans.store');
        Route::get('/unggulans/{slug}', [UnggulanController::class, 'show'])->name('unggulans.show');
        Route::put('/unggulans/{id}', [UnggulanController::class, 'update'])->name('unggulans.update');
        Route::delete('/unggulans/{id}', [UnggulanController::class, 'destroy'])->name('unggulans.destroy');
        Route::delete('/unggulans-bulk-delete', [UnggulanController::class, 'bulkDelete'])->name('unggulans.bulkDelete');
        Route::post('/unggulans/upload', [UnggulanController::class, 'upload'])->name('unggulans.upload');
    });

    // Our Team
    Route::prefix('ourteam')->group(function () {
        Route::get('/ourteam', [OurteamController::class, 'index'])->name('ourteam.index');
        Route::post('/ourteam', [OurteamController::class, 'store'])->name('ourteam.store');
        Route::get('/ourteam/{id}', [OurteamController::class, 'show'])->name('ourteam.show');
        Route::post('/ourteam/{id}', [OurteamController::class, 'update'])->name('ourteam.update');
        Route::delete('/ourteam/{id}', [OurteamController::class, 'destroy'])->name('ourteam.destroy');
    });

    // Pricing
    Route::prefix('pricing')->group(function () {
        Route::get('/pricing', [PricingController::class, 'index'])->name('pricing.index');
        Route::post('/pricing', [PricingController::class, 'store'])->name('pricing.store');
        Route::get('/pricing/{slug}', [PricingController::class, 'show'])->name('pricing.show');
        Route::put('/pricing/{id}', [PricingController::class, 'update'])->name('pricing.update');
        Route::delete('/pricing/{id}', [PricingController::class, 'destroy'])->name('pricing.destroy');
        Route::post('/pricing/upload', [PricingController::class, 'upload'])->name('pricing.upload');
        Route::delete('/pricing-bulk-delete', [PricingController::class, 'bulkDelete'])->name('pricing.bulk-delete');
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

});
