<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CryptoController::class, 'index'])->name('crypto.index');

Route::get('/crypto/data', [CryptoController::class, 'getData'])->name('crypto.data');

Route::post('/crypto/historical', [CryptoController::class, 'getHistoricalData'])->name('crypto.historical');