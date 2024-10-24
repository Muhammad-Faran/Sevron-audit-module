<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuditApiController;

Route::middleware(['auth:api'])->group(function () {
    Route::get('/audits', [AuditApiController::class, 'index']);
    Route::get('/audits/{id}', [AuditApiController::class, 'show']);
});