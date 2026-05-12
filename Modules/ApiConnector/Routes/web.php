<?php

namespace Modules\ApiConnector\Routes;

use Illuminate\Support\Facades\Route;
use Modules\ApiConnector\Http\Controllers\ApiConnectionController;

Route::middleware(['auth'])->prefix('api-connector')->group(function () {
    Route::get('/', [ApiConnectionController::class, 'index'])->name('api_connector');
    Route::get('/create', [ApiConnectionController::class, 'create'])->name('api_connector_create');
    Route::post('/store', [ApiConnectionController::class, 'store'])->name('api_connector_store');
    Route::get('/{id}/edit', [ApiConnectionController::class, 'edit'])->name('api_connector_edit');
    Route::put('/update/{id}', [ApiConnectionController::class, 'update'])->name('api_connector_update');
    Route::delete('/destroy/{id}', [ApiConnectionController::class, 'destroy'])->name('api_connector_destroy');
    Route::post('/test/{id}', [ApiConnectionController::class, 'test'])->name('api_connector_test');
});
