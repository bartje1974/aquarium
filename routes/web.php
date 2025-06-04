<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AquariumController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\SettingsController;

// Default redirect
Route::redirect('/', '/aquariums');

// Aquarium routes
Route::resource('aquariums', AquariumController::class);

// Nested measurement routes
Route::prefix('aquariums/{aquarium}')->group(function () {
    Route::get('measurements', [MeasurementController::class, 'index'])->name('aquariums.measurements.index');
    Route::get('measurements/create', [MeasurementController::class, 'create'])->name('aquariums.measurements.create');
    Route::post('measurements', [MeasurementController::class, 'store'])->name('aquariums.measurements.store');
    Route::get('measurements/{measurement}', [MeasurementController::class, 'show'])->name('aquariums.measurements.show');
});

// Nested problem routes
Route::resource('aquariums.problems', ProblemController::class)->except(['show', 'edit', 'update']);
Route::post('aquariums/{aquarium}/problems/{problem}/resolve', [ProblemController::class, 'resolve'])
    ->name('aquariums.problems.resolve');

// Settings routes
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
