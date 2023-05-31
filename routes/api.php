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

Route::middleware('auth:sanctum')->post('/patient/create', [PatientController::class, 'createPatient']);

Route::middleware('auth:sanctum')->post('/doctor/create', [DoctorController::class, 'createDoctor']);

Route::middleware('auth:sanctum')->post('/hospital/create', [HospitalController::class, 'createHospital']);

Route::middleware('auth:sanctum')->post('/service/create', [ServiceController::class, 'createService']);