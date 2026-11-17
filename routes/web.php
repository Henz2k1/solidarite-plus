<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes Publiques (Accessibles à tout le monde)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/approach', function () {
    return view('approach');
})->name('approach');

/*
|--------------------------------------------------------------------------
| Routes d'Authentification (Sans le middleware guest pour éviter les blocages)
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/admin', 'index')->name('login');
    Route::post('/connected', 'get_connected')->name('auth.get-connected');

    Route::get('/forgot', 'forgot')->name('forgot');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');

    Route::get('/reset-password/{token}', 'resetForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Routes Protégées (Accessibles uniquement aux utilisateurs connectés / Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Déconnexion
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'get_logged_out')->name('logout');
        Route::get('/get-logged-out', 'get_logged_out')->name('auth.get-logged-out');
    });

    // Tableau de bord / Dashboard Admin
    Route::prefix('dashboard')->group(function () {
        Route::redirect('/', '/dashboard/analytics');

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/analytics', 'index')->name('dashboard.analytics');
        });
    });

    // Gestion des utilisateurs et du profil administrateur
    Route::controller(UserController::class)->group(function () {
        Route::resource('utilisateurs', UserController::class);

        Route::get('profil', 'profile')->name('profile');
        Route::post('/profile/update', 'updateProfile')->name('profile.update');
        Route::get('resend-cred/{user}', 'resendCred')->name('resend-cred');
        Route::delete('dm-usr', 'delete_multiples')->name('dm-usr');
    });
    Route::resource('contents', ContentController::class);
    Route::controller(DonationController::class)->group(function () {
        Route::get('/admin/donations', 'index')->name('donations.index');
        Route::post('/admin/donations', 'store')->name('donations.store');
        Route::get('/admin/donations/{donation}/edit', 'edit')->name('donations.edit');
        Route::put('/admin/donations/{donation}', 'update')->name('donations.update');
        Route::delete('/admin/donations/{donation}', 'destroy')->name('donations.destroy');
        Route::delete('/admin/donations-multiple', 'destroyMultiple')->name('donations.destroy.multiple');
    });

    Route::delete('/events/destroy-multiple', [EventController::class, 'destroyMultiple'])
    ->name('events.destroyMultiple');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', EventController::class)->except(['show']);
});

});

Route::get('/events', function () {
    return view('events');
});

Route::get('/blog', function () {
    return view('blog');
});

