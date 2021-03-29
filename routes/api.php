<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthSanctumController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
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

/* test route api auth2 */
Route::post('register', [AuthController::class, "register"]);
Route::post('login', [AuthController::class, "login"]);

/* test route api */
Route::prefix('v1')->name('api.v1.')->namespace('API')->group(function() {

    Route::get('status', function () {
        return response()->json(['status' => 'ok']);
    })->name('status');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
});

