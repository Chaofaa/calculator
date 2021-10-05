<?php

use App\Http\Controllers\CalculatorController;
use Illuminate\Support\Facades\Route;

// General route
Route::get('/', [CalculatorController::class, 'index'])->name('home');
