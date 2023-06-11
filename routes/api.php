<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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



Route::middleware(['cors'])->group(function () {
    // authentication
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // clinics
    Route::get('/clinics', [ClinicController::class, 'index']);


    // labs
    Route::get('/labs', [LabController::class, 'index']);
    Route::get('/labs/{id}', [LabController::class, 'show']);


    // products
    Route::get('/products', [ProductController::class, 'index']);


    // offers
    Route::get('/offers', [OfferController::class, 'index']);


    // must be authenticated
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/clinics/{id}', [ClinicController::class, 'show']);
        Route::post('/favourite/{lab}', [LabController::class, 'favourite']);
        Route::post('/un-favourite/{lab}', [LabController::class, 'unFavourite']);

        // auth lab
        Route::post('/create-lab', [LabController::class, 'store']);
        Route::get('/labs/user/{id}', [LabController::class, 'userLabs']);
        Route::post('/update-lab/{id}', [LabController::class, 'update']);
        Route::post('/delete-lab/{id}', [LabController::class, 'destroy']);
        Route::get('/labs/search/{name}', [LabController::class, 'search']);
        Route::post('/labs/favourite/{lab}', [LabController::class, 'favourite']);
        Route::post('/labs/un-favourite/{lab}', [LabController::class, 'unFavourite']);
        Route::post('/labs/favourites', [LabController::class, 'getUserFavourites']);
        Route::get('/labs/city-filter/{city}', [LabController::class, 'filterByCity']);
        Route::post('/labs/rate/{lab}', [LabController::class, 'rateLab']);

        // offers
        Route::post('/create-offer', [OfferController::class, 'store']);
        Route::get('/offers/{id}', [OfferController::class, 'show']);
        Route::post('/update-lab/{id}', [OfferController::class, 'update']);
        Route::post('/delete-offer/{id}', [OfferController::class, 'destroy']);

        // orders
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);
        Route::get('/lab-orders/{lab}', [OrderController::class, 'getLabOrders']);
        Route::get('/clinic-orders/{clinic}', [OrderController::class, 'getClinicOrders']);
        Route::post('/orders/create', [OrderController::class, 'store']);
        Route::post('/orders/update/{id}', [OrderController::class, 'update']);
        Route::post('/orders/status-update/{id}', [OrderController::class, 'updateStatus']);
        Route::post('/orders/delete/{id}', [OrderController::class, 'destroy']);

        // auth product
        Route::post('/create-product', [ProductController::class, 'store']);
        Route::post('/update-product/{id}', [ProductController::class, 'update']);
        Route::post('/delete-product/{id}', [ProductController::class, 'destroy']);
        Route::get('/products/search/{name}', [ProductController::class, 'search']);
        Route::get('/lab-products/{lab}', [ProductController::class, 'getLabProducts']);

        // auth clinics
        Route::post('/create-clinic', [ClinicController::class, 'store']);
        Route::get('/clinics/user/{id}', [ClinicController::class, 'userClinics']);
        Route::post('/update-clinic/{id}', [ClinicController::class, 'update']);
        Route::post('/delete-clinic/{id}', [ClinicController::class, 'destroy']);

        // auth orders
        Route::get('/user-orders', [OrderController::class, 'getUserOrders']);

    });
    // email verification
    Route::middleware('auth:api')->group(function () {
        Route::get('/email/verify/{id}/{hash}', 'VerificationApiController@verify')->name('verificationapi.verify');
        Route::post('/email/resend', 'VerificationApiController@resend')->name('verificationapi.resend');
    });
});
