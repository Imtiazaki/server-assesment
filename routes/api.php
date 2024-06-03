<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    Route::get('/coursefetch', [ActivityController::class, 'getActivity'])->middleware('restrictRole:admin');
    Route::get('/module', [CourseController::class, 'getModule'])->middleware('restrictRole:admin');
    Route::get('/schedule', [CourseController::class, 'getSchedule'])->middleware('restrictRole:admin');
    
    
    Route::delete('/module/delete/{id}', [CourseController::class, 'deleteModule'])->middleware('restrictRole:admin');
    Route::delete('/schedule/delete/{id}', [CourseController::class, 'deleteSchedule'])->middleware('restrictRole:admin');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'deleteUser'])->middleware('restrictRole:admin');
    Route::post('/register', [AuthController::class, 'register'])->middleware('restrictRole:admin');

    Route::post('/registercourse', [CourseController::class, 'courseRegister'])->middleware('restrictRole:admin');
    Route::get('profile/{id}', [ProfileController::class, 'findProfile'])->middleware('restrictRole:admin');
    Route::post('profile', [ProfileController::class, 'findProfileByName'])->middleware('restrictRole:admin');
    Route::put('profile/{id}', [ProfileController::class, 'updateProfile'])->middleware('restrictRole:admin');
    Route::put('profile/reset/{id}', [ProfileController::class, 'resetToken'])->middleware('restrictRole:admin');
    Route::post('/module/create', [CourseController::class, 'createModule'])->middleware('restrictRole:admin');
    Route::post('/score/create', [CourseController::class, 'createScoring'])->middleware('restrictRole:admin');
    Route::post('/schedule/create', [CourseController::class, 'createSchedule'])->middleware('restrictRole:admin');
    
    Route::get('/schedule/{id}', [CourseController::class, 'findSchedule'])->middleware('restrictRole:admin');
    Route::put('/module/{id}', [CourseController::class, 'updateModule'])->middleware('restrictRole:admin');
    Route::put('/schedule/{id}', [CourseController::class, 'updateSchedule'])->middleware('restrictRole:admin');
    Route::get('/profile', [ProfileController::class, 'getProfile'])->middleware('restrictRole:admin');

    Route::put('/starttest/{id}', [TestController::class, 'startTest']);
    Route::put('/submit/answer/{id}', [TestController::class, 'submitAnswer']);
    Route::put('/autosave/answer/{id}', [TestController::class, 'autoSaveAnswer']);
    Route::post('/everything', [CourseController::class, 'getEverything']);
    Route::get('/answer/{id}', [TestController::class, 'getAnswer']);
    Route::put('/profile/verify/{id}', [ProfileController::class, 'verifyProfile']);
    Route::get('/module/{id}', [CourseController::class, 'findModule']);

    Route::get('/answers/all', [TestController::class, 'getAllAnswers'])->middleware('restrictRole:admin');
    Route::put('/prompt/{id}', [TestController::class, 'updatePrompt'])->middleware('restrictRole:admin');
    Route::get('/prompt/all', [TestController::class, 'getPrompt'])->middleware('restrictRole:admin');
    Route::post('/prompt/create', [TestController::class, 'createPrompt'])->middleware('restrictRole:admin');
    Route::delete('/prompt/delete/{id}', [TestController::class, 'deletePrompt'])->middleware('restrictRole:admin');
});
