<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('api/provinces', [RegisterController::class, 'getProvinces']);
Route::get('api/districts/{provinceCode}', [RegisterController::class, 'getDistricts']);
Route::get('api/wards/{districtCode}', [RegisterController::class, 'getWards']);
