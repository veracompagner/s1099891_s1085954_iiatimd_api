<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//openbare/public routes
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Alles wat hier in zit is protected
    // het is dan niet openbaar je moet eerst inloggen (VEILIG DUS)
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout',[AuthController::class, 'logout']);


});


Route::get('/', function () {
    return view('welcome');
});
