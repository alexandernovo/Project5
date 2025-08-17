<?php

use App\Http\Controllers\AssociationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoatingController;
use App\Http\Controllers\ChainsawController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TreesController;
use App\Http\Controllers\TricycleController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WasteBottleController;
use App\Http\Controllers\WasteCollectController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'dashboard_view'])->name('dashboard');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


//association
Route::get('/association/view', [AssociationController::class, 'association_view'])->name('association_view');
Route::post('/association/save_new_association', [AssociationController::class, 'save_new_association'])->name('save_new_association');
Route::post('/association/getAssociations', [AssociationController::class, 'getAssociations'])->name('getAssociations');
Route::post('/association/deleteAssociation', [AssociationController::class, 'deleteAssociation'])->name('deleteAssociation');

//boating
Route::get('/boating/view', [BoatingController::class, 'boating_view'])->name('boating_view');
Route::post('/boating/save_new_boating', [BoatingController::class, 'save_new_boating'])->name('save_new_boating');
Route::post('/boating/getBoatings', [BoatingController::class, 'getBoatings'])->name('getBoatings');
Route::post('/boating/deleteBoating', [BoatingController::class, 'deleteBoating'])->name('deleteBoating');

//chainsaw
Route::get('/chainsaw/view', [ChainsawController::class, 'chainsaw_view'])->name('chainsaw_view');
Route::post('/chainsaw/save_new_chainsaw', [ChainsawController::class, 'save_new_chainsaw'])->name('save_new_chainsaw');
Route::post('/chainsaw/getchainsaws', [ChainsawController::class, 'getchainsaws'])->name('getchainsaws');
Route::post('/chainsaw/deletechainsaw', [ChainsawController::class, 'deletechainsaw'])->name('deletechainsaw');

//chainsaw
Route::get('/trees/view', [TreesController::class, 'trees_view'])->name('trees_view');
Route::post('/trees/save_new_trees', [TreesController::class, 'save_new_trees'])->name('save_new_trees');
Route::post('/trees/gettreess', [TreesController::class, 'gettreess'])->name('gettrees');
Route::post('/trees/deletetrees', [TreesController::class, 'deletetrees'])->name('deletetrees');

//store
Route::get('/store/view', [StoreController::class, 'store_view'])->name('store_view');
Route::post('/store/save_new_store', [StoreController::class, 'save_new_store'])->name('save_new_store');
Route::post('/store/getstores', [StoreController::class, 'getstores'])->name('getstore');
Route::post('/store/deletestore', [StoreController::class, 'deletestore'])->name('deletestore');

//tricycle
Route::get('/tricycle/view', [TricycleController::class, 'tricycle_view'])->name('tricycle_view');
Route::post('/tricycle/save_new_tricycle', [TricycleController::class, 'save_new_tricycle'])->name('save_new_tricycle');
Route::post('/tricycle/gettricycles', [TricycleController::class, 'gettricycles'])->name('gettricycle');
Route::post('/tricycle/deletetricycle', [TricycleController::class, 'deletetricycle'])->name('deletetricycle');

//vendor
Route::get('/vendor/view', [VendorController::class, 'vendor_view'])->name('vendor_view');
Route::post('/vendor/save_new_vendor', [VendorController::class, 'save_new_vendor'])->name('save_new_vendor');
Route::post('/vendor/getvendors', [VendorController::class, 'getvendors'])->name('getvendor');
Route::post('/vendor/deletevendor', [VendorController::class, 'deletevendor'])->name('deletevendor');

//waste collection
Route::get('/wastecollect/view', [WasteCollectController::class, 'wastecollect_view'])->name('wastecollect_view');
Route::post('/wastecollect/save_new_wastecollect', [WasteCollectController::class, 'save_new_wastecollect'])->name('save_new_wastecollect');
Route::post('/wastecollect/getwastecollects', [WasteCollectController::class, 'getwastecollects'])->name('getwastecollect');
Route::post('/wastecollect/deletewastecollect', [WasteCollectController::class, 'deletewastecollect'])->name('deletewastecollect');

//waste bottle
Route::get('/wastebottle/view', [WasteBottleController::class, 'wastebottle_view'])->name('wastebottle_view');
Route::post('/wastebottle/save_new_wastebottle', [WasteBottleController::class, 'save_new_wastebottle'])->name('save_new_wastebottle');
Route::post('/wastebottle/getwastebottles', [WasteBottleController::class, 'getwastebottles'])->name('getwastebottle');
Route::post('/wastebottle/deletewastebottle', [WasteBottleController::class, 'deletewastebottle'])->name('deletewastebottle');
