<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\SubscriptionController;

Route::name('api.')->group(function () {

    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

});