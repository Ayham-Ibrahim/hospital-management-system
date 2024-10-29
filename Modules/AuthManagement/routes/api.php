<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthManagement\Http\Controllers\AuthController;
use Modules\AuthManagement\Http\Controllers\RoleController;
use Modules\AuthManagement\Http\Controllers\PermissionController;

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
 * Route for registration proccess
 */
Route::post('/addUser', [AuthController::class, 'addUser']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    // routes for logout the auth user and refresh his token 
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/refresh-token', [AuthController::class, 'refreshToken']);

    // routes for roles operation
    Route::apiResource('roles',RoleController::class);

     // routes for permissions operation
    Route::apiResource('permissions',PermissionController::class);

});

