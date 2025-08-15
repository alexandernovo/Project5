<?php

use App\Http\Controllers\AssociationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'dashboard_view'])->name('dashboard');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


//association
Route::get('/association/view', [AssociationController::class, 'association_view'])->name('association_view');
Route::post('/association/save_new_association', [AssociationController::class, 'save_new_association'])->name('save_new_association');
Route::post('/association/getAssociations', [AssociationController::class, 'getAssociations'])->name('getAssociations');
Route::post('/association/deleteAssociation', [AssociationController::class, 'deleteAssociation'])->name('deleteAssociation');
