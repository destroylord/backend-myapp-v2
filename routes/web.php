<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/admin/login'));

Route::prefix('api/')->group(function () {
    Route::get('/portofolio', [\App\Http\Controllers\Api\PortfolioController::class, 'index']);
    Route::get('/portofolio/{id}', [\App\Http\Controllers\Api\PortfolioController::class, 'show']);
});
