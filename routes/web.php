<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


// Authentication & Login Routes
Route::get('/', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'authenticate'])->name('login.submit');

// Night Technician Operational Routes
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
