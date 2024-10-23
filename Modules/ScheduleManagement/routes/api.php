<?php

use Illuminate\Support\Facades\Route;

use Modules\ScheduleManagement\Http\Controllers\AppointmentController;

use Modules\ScheduleManagement\Http\Controllers\SurjicalOperationController;

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

Route::apiResource('surjical-operations', SurjicalOperationController::class);

Route::apiResource('appointments', AppointmentController::class);

