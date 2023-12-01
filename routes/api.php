<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\productController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',function(){
    return response()->json([
        'status'=>false,
        'message'=>'Access denied, must login first'
    ],401);
})->name('login');

//Route User
Route::post('register',[authController::class, 'registerUser']);
Route::post('login',[authController::class, 'loginUser']);
Route::post('logout',[authController::class, 'logoutUser'])->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum', 'penjual']], function () {
    // Route khusus untuk penjual tidak bisa diakses oleh pembeli
    Route::post('product', [productController::class, 'store']);
    Route::put('product/{product}', [productController::class, 'update']);
    Route::delete('product/{product}', [productController::class, 'delete']);
});

// Route untuk pembeli dan penjual
Route::get('product',[productController::class, 'index'])->middleware('auth:sanctum');
Route::get('product/{product}', [productController::class, 'show'])->middleware('auth:sanctum');
