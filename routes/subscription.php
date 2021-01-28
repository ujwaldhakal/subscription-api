<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('subscriptions')->group(function(){
    Route::post('/', [\App\Domains\Subscription\Controllers\SubscriptionController::class,'purchase']);
    Route::post('/check', [\App\Domains\Subscription\Controllers\SubscriptionController::class,'check']);
    Route::get('/', [\App\Domains\Subscription\Controllers\SubscriptionController::class,'list']);
});
