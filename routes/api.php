<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\WeeklyScheduleController;
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

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('stores', StoreController::class);
Route::apiResource('classes', SessionController::class);
Route::apiResource('instructors', InstructorController::class);
Route::apiResource('weeklySchedule', WeeklyScheduleController::class);
