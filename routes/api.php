<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientInformationController;
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

    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'getOne']);
    Route::post('/users/patients', [\App\Http\Controllers\UserController::class, 'createPatient']);
    Route::post('/users/doctors', [\App\Http\Controllers\UserController::class, 'createDoctor']);
    Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'delete']);

    Route::get('/medical-records', [\App\Http\Controllers\MedicalRecordController::class, 'index']);
    Route::post('/medical-records', [\App\Http\Controllers\MedicalRecordController::class, 'store']);
    Route::get('/medical-records/{id}', [\App\Http\Controllers\MedicalRecordController::class, 'getOne']);
    Route::get('/medical-records/patients/{patientId}', [\App\Http\Controllers\MedicalRecordController::class, 'getPatientMedicalRecord']);
    Route::delete('/medical-records/{id}', [\App\Http\Controllers\MedicalRecordController::class, 'delete']);

    Route::get('/medical-exams', [\App\Http\Controllers\MedicalExamController::class, 'index']);
    Route::get('/medical-exams/medical-records/{medicalRecordId}', [\App\Http\Controllers\MedicalExamController::class, 'getByMedicalRecord']);
    Route::post('/medical-exams', [\App\Http\Controllers\MedicalExamController::class, 'store']);
    Route::get('/medical-exams/{id}', [\App\Http\Controllers\MedicalExamController::class, 'getOne']);
    Route::get('/medical-exams/{id}', [\App\Http\Controllers\MedicalExamController::class, 'delete']);


    Route::get('/services', [ServiceController::class, 'all']);
    Route::post('/services', [ServiceController::class, 'create']);
    Route::get('/services/{id}', [ServiceController::class, 'getOne']);
    Route::put('/services/{id}', [ServiceController::class, 'edit']);
    Route::delete('/services/{id}', [ServiceController::class, 'delete']);

    Route::get('/hospitals', [HospitalController::class, 'all']);
    Route::post('/hospitals', [HospitalController::class, 'create']);
    Route::get('/hospital/{id}', [HospitalController::class, 'getOne']);
    Route::put('/hospital/{id}', [HospitalController::class, 'edit']);
    Route::delete('/hospital/{id}', [HospitalController::class, 'delete']);



});

