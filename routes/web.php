<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\Management\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Management\RoleController;
use App\Http\Controllers\Admin\Management\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::middleware('auth')->group(function () {
    Route::get('/log-out', [AuthController::class, 'logOut'])->name('auth.logOut');
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
        Route::controller(PermissionController::class)->name('permissions.')->prefix('permissions')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('{id}/edit', 'edit')->name('edit');
            Route::put('{id}/update', 'update')->name('update');
            Route::get('{id}/delete', 'delete')->name('delete');
        });
        Route::controller(RoleController::class)->name('roles.')->prefix('roles')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('{id}/edit', 'edit')->name('edit');
            Route::put('{id}/update', 'update')->name('update');
            Route::get('{id}/delete', 'delete')->name('delete');
        });
        Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('{id}/edit', 'edit')->name('edit');
            Route::put('{id}/update', 'update')->name('update');
            Route::get('{id}/delete', 'delete')->name('delete');
        });
    });
});
