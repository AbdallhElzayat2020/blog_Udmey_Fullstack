<?php

    use App\Http\Controllers\Admin\AdminAuthController;
    use App\Http\Controllers\Admin\DashboardController;
    use Illuminate\Support\Facades\Route;

    //    Public Routes
    Route::group([ 'prefix' => 'admin' , 'as' => 'admin.' ] , function () {
        Route::get('login' , [ AdminAuthController::class , 'login' ])->name('login');
        Route::post('login' , [ AdminAuthController::class , 'handleLogin' ])->name('handle-login');
    });

    //    Protected Routes
    Route::group([ 'prefix' => 'admin' , 'as' => 'admin.' , 'middleware' => [ 'admin' ] ] , function () {
        Route::get('dashboard' , [ DashboardController::class , 'index' ])->name('dashboard');
    });


