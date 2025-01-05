<?php

use Illuminate\Support\Facades\Route;


Route::get('/', fn() => redirect('/admin/login'));

Route::prefix('api/')->group(function () {
    Route::get('/portofolio', [\App\Http\Controllers\Api\PortfolioController::class, 'index']);
    Route::get('/portofolio/{id}', [\App\Http\Controllers\Api\PortfolioController::class, 'show']);

    Route::get('/achievement', [\App\Http\Controllers\Api\ArchivementController::class, 'index']);
    Route::get('/achievement/{id}', [\App\Http\Controllers\Api\ArchivementController::class, 'show']);

    Route::get('/experience', [\App\Http\Controllers\Api\ExperienceController::class, 'index']);
    Route::get('/experience/{id}', [\App\Http\Controllers\Api\ExperienceController::class, 'show']);

    Route::get('/profile', [\App\Http\Controllers\Api\ProfileController::class, 'index']);
    Route::get('/profile/{id}', [\App\Http\Controllers\Api\ProfileController::class, 'show']);

    Route::get('/skill', [\App\Http\Controllers\Api\SkillController::class, 'index']);
    Route::get('/skill/{id}', [\App\Http\Controllers\Api\SkillController::class, 'show']);
});
