 <?php

use App\Http\Controllers\Api\ApiPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/post', [ApiPostController::class, 'index']);
Route::get('/post/{slug}', [ApiPostController::class, 'show']);


