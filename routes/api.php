<?php

use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\PatientController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth.superadmin'
], function () {
    Route::group([
        'prefix' => 'hospitals',
    ], function () {
        Route::get('/', [HospitalController::class, 'index']);
        Route::get('/{id}', [HospitalController::class, 'detail']);
        Route::post('/', [HospitalController::class, 'store']);
        Route::put('/{id}', [HospitalController::class, 'edit']);
        Route::delete('/{id}', [HospitalController::class, 'delete']);
    });
});


Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::group([
        'prefix' => 'patients',
    ], function () {
        Route::get('/', [PatientController::class, 'index']);
        Route::get('/{id}', [PatientController::class, 'detail']);
        Route::post('/', [PatientController::class, 'store']);
    });
});
