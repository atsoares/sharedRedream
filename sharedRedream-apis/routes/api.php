<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    IncidentController,
    RedeemVoucherController,
    WalletController
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

//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    //API route to get profile info
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    //API route to incidents
    Route::get('/incidents', [IncidentController::class, 'index']);
    Route::post('/incident', [IncidentController::class, 'store']);
    Route::post('/incident/{id}/support', [IncidentController::class, 'support']);
    Route::post('/incident/{id}/refund', [IncidentController::class, 'refund']);

    //API route to redeem vouchers
    Route::post('/voucher/create/{count}', [RedeemVoucherController::class, 'storeInBatch']);
    Route::post('/redeem', [RedeemVoucherController::class, 'redeem']);

    //API route to wallet balance
    Route::get('/balance', [WalletController::class, 'getBalance']);

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/unauthenticated', function () {
    return response()->json(["message"=>"unauthenticated"]);
})->name('api.unauthenticated');
