<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AgendaController;

Route::get('/', function () {
    return view('welcome');
});


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


