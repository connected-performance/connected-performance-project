<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\NmiWebhookController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/nmi-sale', [NmiWebhookController::class, 'sale'])->name('nmi.sale');
Route::get('/nmi-update/{customer_vault_id}/{customer_id}', [NmiWebhookController::class, 'updateCustomerNew'])->name('nmi.update');
Route::get('/nmi-customer-update/{customer_vault_id}/{customer_id}', [NmiWebhookController::class, 'updateCustomerData'])->name('nmi.update_customer');
Route::get('/nmi-cancel', [NmiWebhookController::class, 'cancel'])->name('nmi.cancel');
