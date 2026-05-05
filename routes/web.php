<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : redirect()->route('login');
});

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    // Home/Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Password management
    Route::get('/password/change', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password/change', [PasswordController::class, 'update'])->name('password.update');

    // Subject management (admin and admin-staff)
    Route::middleware('admin.staff')->group(function () {
        Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
        Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
        Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
        Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
        Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

        Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create');
        Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
        Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
        Route::put('/programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');
    });

    // Subject program browsing for all authenticated users
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
    Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show');

    // User management (admin only)
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});
