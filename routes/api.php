<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OperatorController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{booking}', [BookingController::class, 'show']);


Route::post('/bookings', [BookingController::class, 'store']);
Route::put('/bookings/{booking}', [BookingController::class, 'update']);

Route::delete('/bookings/{booking}',[BookingController::class, 'destroy']);

//operators

Route::get('/operators', [OperatorController::class, 'index']);
Route::get('/operators/{operator}', [OperatorController::class, 'show']);


Route::post('/operators', [OperatorController::class, 'store']);
Route::put('/operators/{operator}', [OperatorController::class, 'update']);

Route::delete('/operators/{operator}',[OperatorController::class, 'destroy']);

