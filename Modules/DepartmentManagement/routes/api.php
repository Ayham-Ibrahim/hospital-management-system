<?php

use Illuminate\Support\Facades\Route;
use Modules\DepartmentManagement\Http\Controllers\DepartmentController;
use Modules\DepartmentManagement\Http\Controllers\RoomController;
use Modules\DepartmentManagement\Http\Controllers\ServiceController;

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


Route::apiResource('departments',DepartmentController::class);
Route::apiResource('rooms',RoomController::class);
Route::apiResource('services',ServiceController::class);

