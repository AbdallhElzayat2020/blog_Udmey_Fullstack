<?php

    use App\Http\Controllers\Admin\AdminAuthController;
    use App\Http\Controllers\Admin\AdminProfileController;
    use App\Http\Controllers\Admin\DashboardController;
    use App\Http\Controllers\Admin\LanguageController;
    use Illuminate\Support\Facades\Route;

        //Public Routes
    Route::group([ 'prefix' => 'admin' , 'as' => 'admin.' ] , function () {
        //Auth Routes
        Route::get('login' , [ AdminAuthController::class , 'login' ])->name('login');

        Route::post('login' , [ AdminAuthController::class , 'handleLogin' ])->name('handle-login');

        Route::post('logout' , [ AdminAuthController::class , 'logout' ])->name('logout');

        //Reset Password
        Route::get('forgot-password' , [ AdminAuthController::class , 'forgotPassword' ])->name('forgot-password');

        Route::post('forgot-password' , [ AdminAuthController::class , 'sendResetLink' ])->name('forgot-password.send');

        Route::get('reset-password/{token}' , [ AdminAuthController::class , 'resetPassword' ])->name('reset-password');

        Route::post('reset-password' , [ AdminAuthController::class , 'handleResetPassword' ])->name('reset-password.send');

    });

        //Protected Routes
    Route::group([ 'prefix' => 'admin' , 'as' => 'admin.' , 'middleware' => [ 'admin' ] ] , function () {

        Route::get('dashboard' , [ DashboardController::class , 'index' ])->name('dashboard');

        //Profile Routes
        Route::put('profile-password/{id}' , [ AdminProfileController::class , 'passwordUpdate' ])->name('profile-password.update');

        Route::resource('profile' , AdminProfileController::class);
        //Language Routes
        Route::resource('language' , LanguageController::class);

    });

