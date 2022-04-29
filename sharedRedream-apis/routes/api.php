<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    IncidentController,
    RedeemVoucherController,
    WalletController,
    TransactionController
};

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

Route::group(['namespace' => 'Api'], function () {
    
    //API route for register new user
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    //API route for login user
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    //Protecting Routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        
        //API route to get profile info
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

        //API route to incidents
        Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents');
        Route::get('/{user_id}/incidents', [IncidentController::class, 'userIncidents'])->name('incidents.personal');
        Route::post('/incident', [IncidentController::class, 'store'])->name('incident.store');
        Route::post('/incident/{id}/support', [IncidentController::class, 'support'])->name('incident.support');
        Route::post('/incident/{id}/refund', [IncidentController::class, 'refund'])->name('incident.refund');

        //API route to redeem vouchers
        Route::post('/voucher/create/{count}', [RedeemVoucherController::class, 'storeInBatch'])->name('vouchers.create');
        Route::post('/voucher/redeem', [RedeemVoucherController::class, 'redeem'])->name('voucher.redeem');

        //API route to extract transactions
        Route::get('/{user_id}/extract', [TransactionController::class, 'userExtract'])->name('user.transactions');

    });

    Route::fallback(function () {
        return response()->json(['message' => 'Not found'], 404);
    });

});