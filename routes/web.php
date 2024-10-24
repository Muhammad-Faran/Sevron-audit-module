<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');
    Route::get('/audits/{id}', [AuditController::class, 'show'])->name('audits.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
