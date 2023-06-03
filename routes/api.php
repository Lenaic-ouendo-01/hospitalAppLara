<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
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
    Route::delete('/patients/{id}', [PatientController::class, 'delete']);

    Route::post('/doctor/create', [DoctorController::class, 'createDoctor']);

    Route::post('/hospital/create', [HospitalController::class, 'createHospital']);

    Route::post('/service/create', [ServiceController::class, 'createService']);
});

