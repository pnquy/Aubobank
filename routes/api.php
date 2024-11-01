<?php

use App\Http\Controllers\api\BankTransLogController;
use Illuminate\Http\Request;

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

// Route::middleware('auth:sanctum')->group(function () {
// Route::prefix('/{paymentGateway:brand}')
//     ->name('bank_trans_log.')
//     ->group(function () {
//         Route::get('/{password}/{accountNo}/{token}', [BankTransLogController::class, 'getBankTransLogs'])->name('list')
//             ->middleware('token.auth');
//     });
// });


// Route::prefix('/{paymentGateway:brand}')
//     ->name('bank_trans_log.')
//     ->group(function () {
//         Route::get('/', [BankTransLogController::class, 'getBankTransLogs'])->name('list')
//             // ->middleware('token.auth');
//         ;
//     });


Route::prefix('/{paymentGateway:brand}')
    ->name('bank_trans_log.')
    ->group(function () {
        Route::get('/{password}/{accountNo}/{token}', [BankTransLogController::class, 'getBankTransLogs'])->name('list')->middleware('token.auth');
    });
