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

/**
 * Routes for department operations
 */
Route::apiResource('departments',DepartmentController::class);

/**
 * Routes for rooms operations
 */
Route::apiResource('rooms',RoomController::class);
Route::get('roomList',[RoomController::class,'roomList']);

/**
 * Routes for services operations
 */
Route::apiResource('services',ServiceController::class);

