<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaqController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//openbare/public routes
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);

Route::get('/faq', [FaqController::class, 'index']);
Route::get('/faq/{id}', [FaqController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Alles wat hier in zit is protected
    // het is dan niet openbaar je moet eerst inloggen (VEILIG DUS)
    Route::post('/faq', [FaqController::class, 'store']);
    Route::put('/faq/{id}', [FaqController::class, 'update']);
    Route::delete('/faq/{id}', [FaqController::class, 'destroy']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::post('/logout',[AuthController::class, 'logout']);


});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
