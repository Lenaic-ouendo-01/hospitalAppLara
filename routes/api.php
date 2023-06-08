<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/users/patient', [\App\Http\Controllers\UserController::class, 'createPatient']);
    Route::post('/users/doctor', [\App\Http\Controllers\UserController::class, 'createDoctor']);
    Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'delete']);


    Route::get('/patients', [PatientController::class, 'all']);
    Route::post('/patients', [PatientController::class, 'create']);
    Route::get('/patients/{id}', [PatientController::class, 'getOne']);
    Route::put('/patients/{id}', [PatientController::class, 'edit']);
    Route::delete('/patients/{id}', [UserController::class, 'delete']);

    Route::get('/doctors', [DoctorController::class, 'all']);
    Route::post('/doctors', [DoctorController::class, 'create']);
    Route::get('/doctors/{id}', [DoctorController::class, 'getOne']);
    Route::put('/doctors/{id}', [DoctorController::class, 'edit']);
    Route::delete('/doctors/{id}', [UserController::class, 'delete']);

    Route::get('/services', [ServiceController::class, 'all']);
    Route::post('/services', [ServiceController::class, 'create']);
    Route::get('/services/{id}', [ServiceController::class, 'getOne']);
    Route::put('/services/{id}', [ServiceController::class, 'edit']);
    Route::delete('/services/{id}', [ServiceController::class, 'delete']);

    Route::get('/hospital', [HospitalController::class, 'all']);
    Route::post('/hospital', [HospitalController::class, 'create']);
    Route::get('/hospital/{id}', [HospitalController::class, 'getOne']);
    Route::put('/hospital/{id}', [HospitalController::class, 'edit']);
    Route::delete('/hospital/{id}', [HospitalController::class, 'delete']);



});

