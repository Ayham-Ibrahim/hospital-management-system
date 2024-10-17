<?php

use Illuminate\Support\Facades\Route;
use Modules\PatientManagement\Http\Controllers\PatientManagementController;
use Modules\PatientManagement\Http\Controllers\PatientController;

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
