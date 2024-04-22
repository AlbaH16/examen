<?php

use App\Http\Controllers\Session\AuthenticationController;
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

//Authentication routes
Route::controller(AuthenticationController::class)->group(function(){
    Route::post('login','login');
    Route::post('logout','logout');
});

Route::any('{path}', function() {
    return response()->json([
        'message' => 'Resource not found'
    ], 404);
})->where('path', '.*');
