<?php

use Illuminate\Support\Facades\Route;
use Modules\Performance\Http\Controllers\PerformanceController;
use Modules\Performance\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rutas del modulo Performance (auditoria y optimizacion de imagenes).
|
*/

Route::middleware(['auth', 'verified', 'user_activity_log'])->prefix('performance')->group(function () {
    // Imagenes
    Route::middleware('permission:perf_images')->group(function () {
        Route::get('images', [PerformanceController::class, 'images'])->name('perf_images');
        Route::get('images/data', [PerformanceController::class, 'data'])->name('perf_images_data');
        Route::get('images/duplicates', [PerformanceController::class, 'duplicates'])->name('perf_images_duplicates');
        Route::get('lazy-audit', [PerformanceController::class, 'lazyAudit'])->name('perf_lazy_audit');
        Route::get('head-audit', [PerformanceController::class, 'headAudit'])->name('perf_head_audit');
    });

    Route::middleware('permission:perf_images_resize')->group(function () {
        Route::post('images/resize', [PerformanceController::class, 'resize'])->name('perf_images_resize');
        Route::post('images/webp', [PerformanceController::class, 'webp'])->name('perf_images_webp');
        Route::post('images/quarantine', [PerformanceController::class, 'quarantine'])->name('perf_images_quarantine');
    });

    // Reportes
    Route::middleware('permission:perf_images')->group(function () {
        Route::get('frontend', [ReportController::class, 'frontend'])->name('perf_frontend');
        Route::get('database', [ReportController::class, 'database'])->name('perf_database');
        Route::get('cache', [ReportController::class, 'cache'])->name('perf_cache');
        Route::get('queues', [ReportController::class, 'queues'])->name('perf_queues');
        Route::get('pages', [ReportController::class, 'pages'])->name('perf_pages');
        Route::get('cleanup', [ReportController::class, 'cleanup'])->name('perf_cleanup');
    });

    Route::middleware('permission:perf_maintenance')
        ->post('cleanup/run', [ReportController::class, 'cleanupRun'])
        ->name('perf_cleanup_run');
});
