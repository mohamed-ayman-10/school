<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;







Auth::routes();

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        Route::resource('grades', GradeController::class);
        Route::resource('classrooms', ClassroomController::class);

        Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete.all');
        Route::post('filter', [ClassroomController::class, 'filter'])->name('filter');

        Route::get('/{page}', [AdminController::class, 'index']);
    }
);
