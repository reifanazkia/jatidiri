<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AlasanController;
use App\Http\Controllers\AlasanServiceController;
use App\Http\Controllers\AssesmentController;
use App\Http\Controllers\DukunganController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\MisiController;
use App\Http\Controllers\OurteamController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UnggulanController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\SvgController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\VisiController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\PixelsController;
use App\Http\Controllers\GanalyticsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SidebennerController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WhyController;
use App\Http\Controllers\BenefitsController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\HowController;
use App\Http\Controllers\ManfaatController;
use App\Http\Controllers\MasalahController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\UspController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\ProfileController;
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
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show'); // Gunakan model binding
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
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
    Route::prefix('programs')->name('program.')->group(function () {
        Route::get('/program', [ProgramController::class, 'index'])->name('index');
        Route::get('/create', [ProgramController::class, 'create'])->name('create');
        Route::post('/', [ProgramController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProgramController::class, 'edit'])->name('edit');
        Route::get('/show/{slug}', [ProgramController::class, 'show'])->name('show');
        Route::put('/update/{id}', [ProgramController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ProgramController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [ProgramController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [ProgramController::class, 'upload'])->name('upload');
    });

    // Unggulans
    Route::prefix('unggulans')->name('unggulans.')->group(function () {
        Route::get('/', [UnggulanController::class, 'index'])->name('index');
        Route::get('/create', [UnggulanController::class, 'create'])->name('create');
        Route::post('/store', [UnggulanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UnggulanController::class, 'edit'])->name('edit');
        Route::get('/show/{slug}', [UnggulanController::class, 'show'])->name('show');
        Route::put('/update/{id}', [UnggulanController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [UnggulanController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [UnggulanController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [UnggulanController::class, 'upload'])->name('upload');
    });

    // Our Team
    Route::prefix('ourteam')->name('ourteam.')->group(function () {
        Route::get('/', [OurteamController::class, 'index'])->name('index');
        Route::get('/create', [OurteamController::class, 'create'])->name('create');
        Route::post('/store', [OurteamController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [OurteamController::class, 'edit'])->name('edit');
        Route::get('/show/{id}', [OurteamController::class, 'show'])->name('show');
        Route::put('/update/{id}', [OurteamController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [OurteamController::class, 'destroy'])->name('destroy');
    });

    // Pricing
    Route::prefix('pricing')->name('pricing.')->group(function () {
        Route::get('/', [PricingController::class, 'index'])->name('index');
        Route::get('/create', [PricingController::class, 'create'])->name('create');
        Route::post('/store', [PricingController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PricingController::class, 'edit'])->name('edit');
        Route::get('/show/{slug}', [PricingController::class, 'show'])->name('show');
        Route::put('/update/{id}', [PricingController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PricingController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [PricingController::class, 'upload'])->name('upload');
        Route::delete('/bulk-delete', [PricingController::class, 'bulkDelete'])->name('bulk-delete');
    });

    Route::prefix('testimonies')->name('testimonies.')->group(function () {
        Route::get('/', [TestimonyController::class, 'index'])->name('index');
        Route::get('/create', [TestimonyController::class, 'create'])->name('create');
        Route::post('/store', [TestimonyController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TestimonyController::class, 'edit'])->name('edit');
        Route::get('/show/{slug}', [TestimonyController::class, 'show'])->name('show');
        Route::get('/{id}/editTitle', [TestimonyController::class, 'editTitle'])->name('editTitle');
        Route::put('/{id}/update-title', [TestimonyController::class, 'updateTitle'])->name('updateTitle');
        Route::put('/update/{id}', [TestimonyController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [TestimonyController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [TestimonyController::class, 'upload'])->name('upload');
    });

    Route::prefix('portfolio')->name('portfolio.')->group(function () {
        Route::get('/', [PortofolioController::class, 'index'])->name('index');
        Route::get('/create', [PortofolioController::class, 'create'])->name('create');
        Route::post('/store', [PortofolioController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PortofolioController::class, 'edit'])->name('edit');
        Route::get('/show/{slug}', [PortofolioController::class, 'show'])->name('show');
        Route::put('/update/{id}', [PortofolioController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PortofolioController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [PortofolioController::class, 'bulkDelete'])->name('bulk-delete');
    });



    Route::prefix('dukungan')->name('dukungan.')->group(function () {
        Route::get('/', [DukunganController::class, 'index'])->name('index');
        Route::get('/create', [DukunganController::class, 'create'])->name('create');
        Route::post('/store', [DukunganController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DukunganController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [DukunganController::class, 'update'])->name('update');
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
        Route::get('/', [VisiController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [VisiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [VisiController::class, 'update'])->name('update');
        Route::delete('/{id}', [VisiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('misi')->name('misi.')->group(function () {
        Route::get('/edit/{id}', [MisiController::class, 'edit'])->name('edit');
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
    Route::prefix('partners')->name('partners.')->group(function () {
        Route::get('/', [PartnerController::class, 'index'])->name('index');
        Route::get('/create', [PartnerController::class, 'create'])->name('create');
        Route::post('/', [PartnerController::class, 'store'])->name('store');
        Route::get('/{slug}', [PartnerController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PartnerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PartnerController::class, 'update'])->name('update');
        Route::delete('/{id}', [PartnerController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [PartnerController::class, 'upload'])->name('upload');
    });

    // IDENTITY
    Route::prefix('identity')->name('identity.')->group(function () {
        Route::get('/{id}/edit', [IdentityController::class, 'edit'])->name('edit');
        Route::put('/{id}', [IdentityController::class, 'update'])->name('update');
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
        Route::get('/create', [SliderController::class, 'create'])->name('create');
        Route::post('/', [SliderController::class, 'store'])->name('store');
        Route::get('/{slug}', [SliderController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SliderController::class, 'update'])->name('update');
        Route::delete('/{id}', [SliderController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [SliderController::class, 'upload'])->name('upload');
    });

    // SERVICEf
    Route::prefix('service')->name('service.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');
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
        Route::get('/{id}/edit', [GanalyticsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [GanalyticsController::class, 'update'])->name('update');
    });

    // WELCOME CHAT
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/{id}/edit', [ChatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ChatController::class, 'update'])->name('update');
    });

    Route::prefix('why')->name('why.')->group(function () {
        Route::get('/', [WhyController::class, 'index'])->name('index');
        Route::get('/create', [WhyController::class, 'create'])->name('create');
        Route::post('/', [WhyController::class, 'store'])->name('store');
        Route::get('/{slug}', [WhyController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [WhyController::class, 'edit'])->name('edit');
        Route::put('/{id}', [WhyController::class, 'update'])->name('update');
        Route::delete('/{id}', [WhyController::class, 'destroy'])->name('destroy');
        Route::delete('/bulk-delete', [WhyController::class, 'bulkDelete'])->name('bulkDelete');
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
        Route::delete('/bulk-delete', [AssesmentController::class, 'bulkDelete'])->name('bulkDelete');
    });



    Route::prefix('benefits')->name('benefits.')->group(function () {
        Route::get('/', [BenefitsController::class, 'index'])->name('index');
        Route::get('/create', [BenefitsController::class, 'create'])->name('create');
        Route::post('/store', [BenefitsController::class, 'store'])->name('store');
        Route::get('/{slug}', [BenefitsController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BenefitsController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BenefitsController::class, 'update'])->name('update');
        Route::get('/{id}/editTitle', [BenefitsController::class, 'editTitle'])->name('editTitle');
        Route::put('/{id}/update-title', [BenefitsController::class, 'updateTitle'])->name('updateTitle');
        Route::delete('/delete/{id}', [BenefitsController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [BenefitsController::class, 'upload'])->name('upload');
    });

    Route::prefix('alasan')->name('alasan.')->group(function () {
        Route::get('/', [AlasanController::class, 'index'])->name('index');
        Route::get('/create', [AlasanController::class, 'create'])->name('create');
        Route::post('/store', [AlasanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AlasanController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AlasanController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AlasanController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [AlasanController::class, 'show'])->name('show');
        Route::delete('/bulk-delete', [AlasanController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [AlasanController::class, 'upload'])->name('upload');
    });

    Route::prefix('how')->name('how.')->group(function () {
        Route::get('/', [HowController::class, 'index'])->name('index');
        Route::get('/create', [HowController::class, 'create'])->name('create');
        Route::post('/store', [HowController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [HowController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [HowController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [HowController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [HowController::class, 'show'])->name('show');
        Route::delete('/bulk-delete', [HowController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [HowController::class, 'upload'])->name('upload');
    });

    Route::prefix('bonus')->name('bonus.')->group(function () {
        Route::get('/', [BonusController::class, 'index'])->name('index');
        Route::get('/create', [BonusController::class, 'create'])->name('create');
        Route::post('/store', [BonusController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BonusController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BonusController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [BonusController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [BonusController::class, 'show'])->name('show');
        Route::delete('/bulk-delete', [BonusController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [BonusController::class, 'upload'])->name('upload');
    });

    Route::prefix('masalah')->name('masalah.')->group(function () {
        Route::get('/', [MasalahController::class, 'index'])->name('index');
        Route::get('/create', [MasalahController::class, 'create'])->name('create');
        Route::post('/store', [MasalahController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MasalahController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [MasalahController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [MasalahController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [MasalahController::class, 'show'])->name('show');
        Route::delete('/bulk-delete', [MasalahController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [MasalahController::class, 'upload'])->name('upload');
    });
    Route::prefix('activity')->name('activity.')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('index');
        Route::get('/create', [ActivityController::class, 'create'])->name('create');
        Route::post('/store', [ActivityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ActivityController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ActivityController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ActivityController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [ActivityController::class, 'show'])->name('show');
        Route::delete('/bulk-delete', [ActivityController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [ActivityController::class, 'upload'])->name('upload');
    });
    Route::prefix('manfaat')->name('manfaat.')->group(function () {
        Route::get('/', [ManfaatController::class, 'index'])->name('index');
        Route::get('/create', [ManfaatController::class, 'create'])->name('create');
        Route::post('/store', [ManfaatController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ManfaatController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ManfaatController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ManfaatController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [ManfaatController::class, 'show'])->name('show');
        Route::delete('/bulk-delete', [ManfaatController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [ManfaatController::class, 'upload'])->name('upload');
    });

    Route::prefix('faqs')->name('faqs.')->group(function () {
        Route::get('/', [FaqsController::class, 'index'])->name('index');
        Route::get('/create', [FaqsController::class, 'create'])->name('create');
        Route::post('/store', [FaqsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [FaqsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [FaqsController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [FaqsController::class, 'destroy'])->name('destroy');
        Route::get('/show/{slug}', [FaqsController::class, 'show'])->name('show');
        Route::delete('/bulk-delete', [FaqsController::class, 'bulkDelete'])->name('bulkDelete');
        Route::post('/upload', [FaqsController::class, 'upload'])->name('upload');
    });

    Route::prefix('usp')->name('usp.')->group(function () {
        Route::get('/', [UspController::class, 'index'])->name('index');
        Route::get('/create', [UspController::class, 'create'])->name('create');
        Route::post('/', [UspController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UspController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UspController::class, 'update'])->name('update');
        Route::delete('/{id}', [UspController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('statistik')->name('statistik.')->group(function () {
        Route::get('/', [StatistikController::class, 'index'])->name('index');
        Route::get('/create', [StatistikController::class, 'create'])->name('create');
        Route::post('/', [StatistikController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [StatistikController::class, 'edit'])->name('edit');
        Route::put('/{id}', [StatistikController::class, 'update'])->name('update');
        Route::delete('/{id}', [StatistikController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');  // jadi: profile.edit
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');
    });

    Route::get('/user/{id}/edit', [ProfileController::class, 'editUser'])->name('user.edit');
    Route::put('/user/{id}', [ProfileController::class, 'update'])->name('user.update');
    Route::put('/user/{id}/photo', [ProfileController::class, 'updatePhoto'])->name('user.update.photo');
    Route::put('/user/{id}/password', [ProfileController::class, 'updatePassword'])->name('user.updatePassword');
    Route::post('/user/{id}/2fa', [ProfileController::class, 'enableTwoFactor'])->name('user.enable2fa');
    Route::get('/user/create', [ProfileController::class, 'create'])->name('user.create');
    Route::post('/user', [ProfileController::class, 'store'])->name('user.store');
    Route::delete('/user/{id}', [ProfileController::class, 'destroy'])->name('user.destroy');
});
