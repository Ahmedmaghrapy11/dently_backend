<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\LabController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// clinics
Route::get('/clinics', [ClinicController::class, 'index']);
Route::post('/create-clinic', [ClinicController::class, 'store']);
Route::get('/clinics/user/{id}', [ClinicController::class, 'userClinics']);
Route::post('/update-clinic/{id}', [ClinicController::class, 'update']);
Route::post('/delete-clinic/{id}', [ClinicController::class, 'destroy']);

// labs
Route::get('/labs', [LabController::class, 'index']);
Route::post('/create-lab', [LabController::class, 'store']);
Route::get('/labs/user/{id}', [LabController::class, 'userLabs']);
Route::post('/update-lab/{id}', [LabController::class, 'update']);
Route::post('/delete-lab/{id}', [LabController::class, 'destroy']);
Route::get('/labs/search/{name}', [LabController::class, 'search']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // Route::get('/profile', [DentistProfileController::class, 'profile']);
    // Route::post('/create-profile', [DentistProfileController::class, 'create']);
    Route::get('/clinics/{id}', [ClinicController::class, 'show']);
    Route::post('/favourite/{lab}', [LabController::class, 'favourite']);
    Route::post('/un-favourite/{lab}', [LabController::class, 'unFavourite']);
});
