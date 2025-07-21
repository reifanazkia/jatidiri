 <?php

use App\Http\Controllers\Api\ApiAgendaController;
use App\Http\Controllers\Api\ApiAlasanController;
use App\Http\Controllers\Api\ApiAssesmentController;
use App\Http\Controllers\Api\ApiBenefitsController;
use App\Http\Controllers\Api\ApiChatController;
use App\Http\Controllers\Api\ApiDukunganController;
use App\Http\Controllers\Api\ApiGanalyticsController;
use App\Http\Controllers\Api\ApiHowController;
use App\Http\Controllers\Api\ApiIdentityController;
use App\Http\Controllers\Api\ApiLegalController;
use App\Http\Controllers\Api\ApiOurteamController;
use App\Http\Controllers\Api\ApiPartnerController;
use App\Http\Controllers\Api\ApiPixelsController;
use App\Http\Controllers\Api\ApiPortofolioController;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiPricingController;
use App\Http\Controllers\Api\ApiProgramController;
use App\Http\Controllers\Api\ApiServiceController;
use App\Http\Controllers\Api\ApiSliderController;
use App\Http\Controllers\Api\ApiTestimonyController;
use App\Http\Controllers\Api\ApiUnggulanController;
use App\Http\Controllers\Api\ApiWhyController;
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
Route::get('/testimony', [ApiTestimonyController::class, 'index']);
Route::get('/testimony/{slug}', [ApiTestimonyController::class, 'show']);
Route::get('/portofolio', [ApiPortofolioController::class, 'index']);
Route::get('/portofolio/{slug}', [ApiPortofolioController::class, 'show']);
Route::get('/dukungan', [ApiDukunganController::class, 'index']);
Route::get('/dukungan/{slug}', [ApiDukunganController::class, 'show']);
Route::get('/legal', [ApiLegalController::class, 'index']);
Route::get('/legal/{id}', [ApiLegalController::class, 'show']);
Route::get('/partner', [ApiPartnerController::class, 'index']);
Route::get('/partner/{id}', [ApiPartnerController::class, 'show']);
Route::get('/identity', [ApiIdentityController::class, 'index']);
Route::get('/slider', [ApiSliderController::class, 'index']);
Route::get('/pixel', [ApiPixelsController::class, 'index']);
Route::get('/google-analytics', [ApiGanalyticsController::class, 'index']);
Route::get('/chat', [ApiChatController::class, 'index']);
Route::get('/service', [ApiServiceController::class, 'index']);
Route::get('/service/{slug}', [ApiServiceController::class, 'show']);
Route::get('/why', [ApiWhyController::class, 'index']);
Route::get('/why/{slug}', [ApiWhyController::class, 'show']);
Route::get('/assesment', [ApiAssesmentController::class, 'index']);
Route::get('/assesment/{slug}', [ApiAssesmentController::class, 'show']);
Route::get('/benefits', [ApiBenefitsController::class, 'index']);
Route::get('/benefits/{slug}', [ApiBenefitsController::class, 'show']);
Route::get('/alasan', [ApiAlasanController::class, 'index']);
Route::get('/alasan/{slug}', [ApiAlasanController::class, 'show']);
Route::get('/hows', [ApiHowController::class, 'index']);
Route::get('/hows/{slug}', [ApiHowController::class, 'show']);



