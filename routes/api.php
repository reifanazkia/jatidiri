 <?php

use App\Http\Controllers\Api\ApiAgendaController;
use App\Http\Controllers\Api\ApiOurteamController;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiPricingController;
use App\Http\Controllers\Api\ApiProgramController;
use App\Http\Controllers\Api\ApiUnggulanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/post', [ApiPostController::class, 'index']);
Route::get('/post/{slug}', [ApiPostController::class, 'show']);
Route::get('/agenda', [ApiAgendaController::class, 'index']);
Route::get('/agenda/{slug}', [ApiAgendaController::class, 'show']);
Route::get('/program', [ApiProgramController::class, 'index']);
Route::get('/perogram/{slug}', [ApiProgramController::class, 'show']);
Route::get('/unggulan', [ApiUnggulanController::class, 'index']);
Route::get('/unggulan/{slug}', [ApiUnggulanController::class, 'show']);
Route::get('/ourteam', [ApiOurteamController::class, 'index']);
Route::get('/ourteam/{id}', [ApiOurteamController::class, 'show']);
Route::get('/pricing', [ApiPricingController::class, 'index']);
Route::get('/pricing/{slug}', [ApiPricingController::class, 'show']);




