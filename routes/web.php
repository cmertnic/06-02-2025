<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/register', function () {
    return view('register');
});

Route::get('/', [ReportController::class, 'index'])->name('main');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/reports/{id}/approve', [ReportController::class, 'approve'])->name('admin.approve');
    Route::post('/reports/{id}/reject', [ReportController::class, 'reject'])->name('admin.reject');
    Route::get('/admin', [ReportController::class, 'adminIndex'])->name('admin.index');
    Route::post('/reports/{id}', [ReportController::class, 'updateStatus']);
    Route::put('/reports/{id}', [ReportController::class, 'update'])->name('reports.update');
    Route::get('/request', [ReportController::class, 'index'])->name('request.index'); 
    Route::get('/request/create', [ReportController::class, 'create'])->name('request.create'); 
    Route::post('/request', [ReportController::class, 'store'])->name('request.store'); 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/works/{id}/score', [ReportController::class, 'updateScore'])->name('works.updateScore');
});

require __DIR__.'/auth.php';