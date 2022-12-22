<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/register_user', [UserController::class, 'register_user']);

Route::post('/login_user', [UserController::class, 'login_user']);

Route::get('/send_phone_otp', [UserController::class, 'send_phone_otp']);

Route::get('/get_all_students', [StudentController::class, 'get_all_students']);

Route::get('/get_specific_students/{id}', [StudentController::class, 'get_specific_students']);

Route::get('/get_city_students/{city}', [StudentController::class, 'get_city_students']);

// Protected Routes
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/add_new_student', [StudentController::class, 'add_new_student']);

    Route::put('/update_student/{id}', [StudentController::class, 'update_student']);

    Route::delete('/delete_student/{id}', [StudentController::class, 'delete_student']);

    Route::post('/logout_user', [UserController::class, 'logout_user']);
});
