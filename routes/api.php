<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'user'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::group(['prefix' => 'consultation'], function () {
//    Route::get('/', [ConsultationController::class, 'index']);
    Route::get('/{counselor}', [ConsultationController::class, 'getByCounselorId']);
    Route::get('/show/{consultation}', [ConsultationController::class, 'show']);
    Route::post('/create', [ConsultationController::class, 'create']);
});
