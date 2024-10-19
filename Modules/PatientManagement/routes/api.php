<?php

use Illuminate\Support\Facades\Route;
use Modules\PatientManagement\Models\MedicalRecord;
use Modules\PatientManagement\Http\Controllers\PatientController;
use Modules\PatientManagement\Http\Controllers\MedicalRecordController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/


Route::apiResource('patients', PatientController::class);
Route::post('/patients/{patient}/services', [PatientController::class, 'storeServices']);


Route::apiResource('medical-records', MedicalRecordController::class);
Route::get('/patient-records/{patient}', [MedicalRecordController::class, 'patientRecords']);
