<?php

use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\IndexController;
use App\Http\Controllers\Api\V1\VehiculeController;
use App\Http\Controllers\Api\V1\PersonnelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\MenuController;


Route::get('/', IndexController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:api');

Route::group(['middleware' => ['auth:api']], function () {
    // Vehicule
    Route::get('/vehicule/list', [VehiculeController::class, 'list']);
    Route::post('/vehicule/save', [VehiculeController::class, 'save']);
    Route::put('/vehicule/update/{id}', [VehiculeController::class, 'update']);
    Route::delete('/vehicule/delete/{id}', [VehiculeController::class, 'destroy']);

    // Personnel
    Route::get('/personnel/list', [PersonnelController::class, 'list']);
    Route::post('/personnel/save', [PersonnelController::class, 'save']);
    Route::put('/personnel/update/{id}', [PersonnelController::class, 'update']);
    Route::delete('/personnel/delete/{id}', [PersonnelController::class, 'destroy']);

    //Menu & Sous Menu
    Route::get('/menu/list', [MenuController::class, 'list']);
    Route::post('/menu/save', [MenuController::class, 'save']);
    Route::put('/menu/update/{id}', [MenuController::class, 'update']);
    Route::delete('/menu/delete/{id}', [MenuController::class, 'destroy']);
    Route::post('/sousmenu/save', [MenuController::class, 'saveSmenu']);
    Route::put('/sousmenu/update/{id}', [MenuController::class, 'updateSmenu']);
    Route::delete('/sousmenu/delete/{id}', [MenuController::class, 'destroySmenu']);

    //Configuration
    Route::group(['prefix' => 'configuration'], function() {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    });
});

