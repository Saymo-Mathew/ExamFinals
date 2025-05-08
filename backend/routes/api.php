<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\MedicalRecordController;

// Patient CRUD routes
Route::apiResource('patients', PatientController::class);

// Additional route to fetch medical records for a specific patient
Route::get('patients/{patient}/records', [MedicalRecordController::class, 'getByPatient']);

// MedicalRecord CRUD routes
Route::apiResource('records', MedicalRecordController::class);

// Optionally, you can group under middleware for auth:
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('patients', PatientController::class);
//     Route::get('patients/{patient}/records', [MedicalRecordController::class, 'getByPatient']);
//     Route::apiResource('records', MedicalRecordController::class);
// });

// Example of route to get authenticated user
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
