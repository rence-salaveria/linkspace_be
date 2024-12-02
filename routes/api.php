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
    Route::post('/update/{consultation}', [ConsultationController::class, 'editConsultation']);
    Route::post('/cancel/{consultation}', [ConsultationController::class, 'cancelConsultation']);
    Route::post('/complete/{consultation}', [ConsultationController::class, 'completeConsultation']);
});

Route::group(['prefix' => 'student'], function () {
    Route::post('/add', [\App\Http\Controllers\StudentController::class, 'addStudent']);
    Route::get('/{id}', [\App\Http\Controllers\StudentController::class, 'show']);
    Route::get('/', [\App\Http\Controllers\StudentController::class, 'index']);
});

Route::get('/dashboard-info', [AuthController::class, 'dashboardInfo']);

Route::post('/upload/info-sheet', [\App\Http\Controllers\StudentController::class, 'uploadPersonalInfoSheet']);
Route::post('/upload/revert', [\App\Http\Controllers\StudentController::class, 'revertFile']);
