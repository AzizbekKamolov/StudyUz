<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\Management\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Management\RoleController;
use App\Http\Controllers\Admin\Management\UserController;
use App\Http\Controllers\Admin\UniversityController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::middleware('auth')->group(function () {
    Route::get('/log-out', [AuthController::class, 'logOut'])->name('auth.logOut');
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

        Route::controller(CountryController::class)->name('countries.')->prefix('countries')->group(function () {
            Route::get('/', 'index')->name('index')->can('countries.index');
            Route::get('/create', 'create')->name('create')->can('countries.store');
            Route::post('/store', 'store')->name('store')->can('countries.store');
            Route::get('{id}/edit', 'edit')->name('edit')->can('countries.update');
            Route::put('{id}/update', 'update')->name('update')->can('countries.update');
            Route::get('{id}/delete', 'delete')->name('delete')->can('countries.delete');
        });
        Route::controller(CityController::class)->name('cities.')->prefix('cities')->group(function () {
            Route::get('/', 'index')->name('index')->can('cities.index');
            Route::get('/get-all-by-country-id', 'getCitiesByCountryId')->name('getCitiesByCountryId')->can('cities.store');
            Route::get('/create', 'create')->name('create')->can('cities.store');
            Route::post('/store', 'store')->name('store')->can('cities.store');
            Route::get('{id}/edit', 'edit')->name('edit')->can('cities.update');
            Route::put('{id}/update', 'update')->name('update')->can('cities.update');
            Route::get('{id}/delete', 'delete')->name('delete')->can('cities.delete');
        });
        Route::controller(UniversityController::class)->name('universities.')->prefix('universities')->group(function () {
            Route::get('/', 'index')->name('index')->can('universities.index');
            Route::get('/create', 'create')->name('create')->can('universities.store');
            Route::post('/store', 'store')->name('store')->can('universities.store');
            Route::get('{id}/edit', 'edit')->name('edit')->can('universities.update');
            Route::put('{id}/update', 'update')->name('update')->can('universities.update');
            Route::get('{id}/delete', 'delete')->name('delete')->can('universities.delete');
        });

        Route::controller(PermissionController::class)->name('permissions.')->prefix('permissions')->group(function () {
            Route::get('/', 'index')->name('index')->can('permissions.index');
            Route::get('/create', 'create')->name('create')->can('permissions.store');
            Route::post('/store', 'store')->name('store')->can('permissions.store');
            Route::get('{id}/edit', 'edit')->name('edit')->can('permissions.update');
            Route::put('{id}/update', 'update')->name('update')->can('permissions.update');
            Route::get('{id}/delete', 'delete')->name('delete')->can('permissions.delete');
        });
        Route::controller(RoleController::class)->name('roles.')->prefix('roles')->group(function () {
            Route::get('/', 'index')->name('index')->can('roles.index');
            Route::get('/create', 'create')->name('create')->can('roles.store');
            Route::post('/store', 'store')->name('store')->can('roles.store');
            Route::get('{id}/edit', 'edit')->name('edit')->can('roles.update');
            Route::put('{id}/update', 'update')->name('update')->can('roles.update');
            Route::get('{id}/delete', 'delete')->name('delete')->can('roles.delete');
        });
        Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
            Route::get('/', 'index')->name('index')->can('users.index');
            Route::get('/create', 'create')->name('create')->can('users.store');
            Route::post('/store', 'store')->name('store')->can('users.store');
            Route::get('{id}/edit', 'edit')->name('edit')->can('users.update');
            Route::put('{id}/update', 'update')->name('update')->can('users.update');
            Route::get('{id}/delete', 'delete')->name('delete')->can('users.delete');
        });
    });
});
