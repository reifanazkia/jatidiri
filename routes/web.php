<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UnggulanController;
use App\Http\Controllers\YutubController;

Route::get('/', function () {
    return redirect()->route('login');
});

 Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');


Route::prefix('admin')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts-bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulkDelete');
    Route::post('/ckeditor/upload-post', [PostController::class, 'upload'])->name('posts.ckeditor.upload');
});



Route::prefix('admin')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/ckeditor/upload-category', [CategoryController::class, 'upload'])->name('category.ckeditor.upload');
});


Route::prefix('admin')->group(function () {
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
    Route::post('/ckeditor/upload', [AgendaController::class, 'upload'])->name('ckeditor.upload');
    Route::get('/agenda/{slug}', [AgendaController::class, 'show'])->name('agenda.show');
});

Route::prefix('yutubs')->group(function () {
    Route::get('/yutubs', [YutubController::class, 'index'])->name('yutubs.index');
    Route::post('/yutubs', [YutubController::class, 'store'])->name('yutubs.store');
    Route::get('/yutubs/{id}', [YutubController::class, 'show'])->name('yutubs.show');
    Route::put('/yutub/{id}', [YutubController::class, 'update'])->name('yutubs.update');
    Route::delete('/yutub/{id}', [YutubController::class, 'destroy'])->name('yutubs.destroy');
});

Route::prefix('programs')->group(function () {
    Route::get('/program', [ProgramController::class, 'index'])->name('programs.index');
    Route::post('/', [ProgramController::class, 'store'])->name('programs.store');
    Route::get('/{slug}', [ProgramController::class, 'show'])->name('programs.show');
    Route::put('/{id}', [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('/{id}', [ProgramController::class, 'destroy'])->name('programs.destroy');
    Route::post('/bulk-delete', [ProgramController::class, 'bulkDelete'])->name('programs.bulkDelete');
    Route::post('/upload', [ProgramController::class, 'upload'])->name('programs.upload');
});

Route::prefix('unggulans')->group(function () {
    Route::get('/unggulans', [UnggulanController::class, 'index'])->name('unggulans.index');
    Route::post('/unggulans', [UnggulanController::class, 'store'])->name('unggulans.store');
    Route::get('/unggulans/{slug}', [UnggulanController::class, 'show'])->name('unggulans.show');
    Route::put('/unggulans/{id}', [UnggulanController::class, 'update'])->name('unggulans.update');
    Route::delete('/unggulans/{id}', [UnggulanController::class, 'destroy'])->name('unggulans.destroy');
    Route::post('/unggulans-bulk-delete', [UnggulanController::class, 'bulkDelete'])->name('unggulans.bulkDelete');
    Route::post('/unggulans/upload', [UnggulanController::class, 'upload'])->name('unggulans.upload');
});



Route::prefix('ourteam')->group(function () {
    Route::get('/ourteam', [App\Http\Controllers\OurteamController::class, 'index'])->name('ourteam.index');
    Route::post('/ourteam', [App\Http\Controllers\OurteamController::class, 'store'])->name('ourteam.store');
    Route::get('/ourteam/{id}', [App\Http\Controllers\OurteamController::class, 'show'])->name('ourteam.show');
    Route::post('/ourteam/{id}', [App\Http\Controllers\OurteamController::class, 'update'])->name('ourteam.update');
    Route::delete('/ourteam/{id}', [App\Http\Controllers\OurteamController::class, 'destroy'])->name('ourteam.destroy');
});

use App\Http\Controllers\PricingController;

Route::prefix('pricing')->group(function () {
    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing.index');
    Route::post('/pricing', [PricingController::class, 'store'])->name('pricing.store');
    Route::get('/pricing/{slug}', [PricingController::class, 'show'])->name('pricing.show');
    Route::put('/pricing/{id}', [PricingController::class, 'update'])->name('pricing.update');
    Route::delete('/pricing/{id}', [PricingController::class, 'destroy'])->name('pricing.destroy');
    Route::post('/pricing/upload', [PricingController::class, 'upload'])->name('pricing.upload');
    Route::post('/pricing-bulk-delete', [PricingController::class, 'bulkDelete'])->name('pricing.bulk-delete');


});



