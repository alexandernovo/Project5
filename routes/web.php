<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', [DashboardController::class, 'dashboard_view'])->name('dashboard');
Route::get('/user', [UserController::class, 'user_view'])->name('user');
