<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AssesmentController;
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
use App\Http\Controllers\WhyController;
use App\Http\Controllers\BenefitsController;
use Faker\Guesser\Name;
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
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [PostController::class, 'show'])->name('show');
        Route::delete('/bulk-delete', [PostController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [PostController::class, 'upload'])->name('upload');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{slug}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [CategoryController::class, 'upload'])->name('upload');
    });


    Route::prefix('agenda')->name('agenda.')->group(function () {
        Route::get('/', [AgendaController::class, 'index'])->name('index');
        Route::get('/create', [AgendaController::class, 'create'])->name('create');
        Route::post('/store', [AgendaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AgendaController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AgendaController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AgendaController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [ProgramController::class, 'bulkDelete'])->name('bulkDelete');
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

    Route::prefix('testimony')->name('testimony.')->group(function () {
        Route::get('/', [TestimonyController::class, 'index'])->name('index');
        Route::post('/store', [TestimonyController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [TestimonyController::class, 'show'])->name('show');
        Route::put('/update/{id}', [TestimonyController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [TestimonyController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [TestimonyController::class, 'upload'])->name('upload');
    });

    Route::prefix('portofolio')->name('portofolio.')->group(function () {
        Route::get('/', [PricingController::class, 'index'])->name('index');
        Route::post('/store', [PricingController::class, 'store'])->name('store');
        Route::get('/show/{slug}', [PricingController::class, 'show'])->name('show');
        Route::put('/update/{id}', [PricingController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PricingController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [PricingController::class, 'bulkDelete'])->name('bulk-delete');
    });



    Route::prefix('dukungan')->name('dukungan.')->group(function () {
        Route::get('/', [DukunganController::class, 'index'])->name('index');
        Route::get('/create', [DukunganController::class, 'create'])->name('create');
        Route::post('/store', [DukunganController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DukunganController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [DukunganController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DukunganController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [DukunganController::class, 'show'])->name('show');
        Route::post('/bulk-delete', [DukunganController::class, 'bulkDelete'])->name('bulk-delete');
        Route::post('/upload', [DukunganController::class, 'upload'])->name('upload');
    });


    Route::prefix('about')->name('about.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('/create', [AboutController::class, 'create'])->name('create');
        Route::post('/store', [AboutController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AboutController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AboutController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AboutController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [AboutController::class, 'show'])->name('show');
    });


    Route::prefix('visi')->name('visi.')->group(function () {
        Route::put('/{id}', [VisiController::class, 'update'])->name('update');
        Route::delete('/{id}', [VisiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('misi')->name('misi.')->group(function () {
        Route::put('/{id}', [MisiController::class, 'update'])->name('update');
        Route::delete('/{id}', [MisiController::class, 'destroy'])->name('destroy');
    });


    // LEGAL
    Route::prefix('legal')->name('legal.')->group(function () {
        Route::get('/', [LegalController::class, 'index'])->name('index');
        Route::get('/create', [LegalController::class, 'create'])->name('create');
        Route::post('/', [LegalController::class, 'store'])->name('store');
        Route::get('/{id}', [LegalController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [LegalController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LegalController::class, 'update'])->name('update');
        Route::delete('/{id}', [LegalController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [LegalController::class, 'upload'])->name('upload');
    });

    // PARTNER
    Route::prefix('patner')->name('patner.')->group(function () {
        Route::get('/', [PartnerController::class, 'index'])->name('index');
        Route::get('/{slug}', [PartnerController::class, 'show'])->name('show');
        Route::put('/{id}', [PartnerController::class, 'update'])->name('update');
        Route::delete('/{id}', [PartnerController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [PartnerController::class, 'upload'])->name('upload');
    });

    // IDENTITY
    Route::prefix('identity')->name('identity.')->group(function () {
        Route::get('/{id}/edit', [IdentityController::class, 'edit'])->name('edit');
        Route::post('/{id}', [IdentityController::class, 'update'])->name('update');
        Route::post('/upload', [IdentityController::class, 'upload'])->name('upload');
    });

    // HEADER
    Route::prefix('headers')->name('header.')->group(function () {
        Route::get('/', [HeaderController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [HeaderController::class, 'edit'])->name('edit');
        Route::put('/{id}', [HeaderController::class, 'update'])->name('update');
        Route::delete('/{id}', [HeaderController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [HeaderController::class, 'upload'])->name('upload');
    });

    // SLIDER
    Route::prefix('slider')->name('slider.')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::get('/{id}', [SliderController::class, 'show'])->name('show');
        Route::put('/{id}', [SliderController::class, 'update'])->name('update');
        Route::delete('/{id}', [SliderController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [SliderController::class, 'upload'])->name('upload');
    });

    // SERVICE
    Route::prefix('service')->name('service.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
        Route::put('/{id}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [ServiceController::class, 'upload'])->name('upload');
    });

    // SIDEBANNER
    Route::prefix('sidebanner')->name('sidebanner.')->group(function () {
        Route::get('/{id}/edit', [SidebennerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SidebennerController::class, 'update'])->name('update');
        Route::delete('/{id}', [SidebennerController::class, 'destroy'])->name('destroy');
    });

    // PIXEL
    Route::prefix('pixel')->name('pixel.')->group(function () {
        Route::get('/{id}/edit', [PixelsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PixelsController::class, 'update'])->name('update');
    });

    // GOOGLE ANALYTICS
    Route::prefix('ganalytics')->name('ganalytics.')->group(function () {
        Route::get('/{id}/edit', [PixelsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PixelsController::class, 'update'])->name('update');
    });

    Route::prefix('why')->name('why.')->group(function () {
        Route::get('/', [WhyController::class, 'index'])->name('index');
        Route::get('/{slug}', [WhyController::class, 'show'])->name('show');
        Route::put('/{id}', [WhyController::class, 'update'])->name('update');
        Route::delete('/{id}', [WhyController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [WhyController::class, 'upload'])->name('upload');
    });

    Route::prefix('assesment')->name('assesment.')->group(function () {
        Route::get('/', [AssesmentController::class, 'index'])->name('index');
        Route::get('/create', [AssesmentController::class, 'create'])->name('create');
        Route::post('/', [AssesmentController::class, 'store'])->name('store');
        Route::get('/{slug}', [AssesmentController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AssesmentController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AssesmentController::class, 'update'])->name('update');
        Route::delete('/{id}', [AssesmentController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [AssesmentController::class, 'upload'])->name('upload');
        Route::delete('/bulk-delete', [AssesmentController::class, 'bulkDelete'])->name('bulk-delete');
    });



    Route::prefix('benefits')->name('benefits.')->group(function () {
        Route::get('/', [BenefitsController::class, 'index'])->name('index');
        Route::get('/create', [BenefitsController::class, 'create'])->name('create');
        Route::post('/store', [BenefitsController::class, 'store'])->name('store');
        Route::get('/{slug}', [BenefitsController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BenefitsController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BenefitsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BenefitsController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [BenefitsController::class, 'upload'])->name('upload');
    });
});
