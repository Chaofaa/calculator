<?php

use App\Http\Controllers\Api\HistoryController;
use Illuminate\Support\Facades\Route;

// History routes
Route::group([
    'prefix' => 'history',
    'name' => 'history.'
], function () {

    Route::get('/{limit}', [HistoryController::class, 'index'])->name('list');
    Route::post('store', [HistoryController::class, 'store'])->name('store');
});
