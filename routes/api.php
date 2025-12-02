<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\RoboticsKitController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
	Route::apiResource('courses', CourseController::class);
	Route::apiResource('robotics-kits', RoboticsKitController::class);
	Route::apiResource('users', UserController::class);
});
