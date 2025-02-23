<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CelebrantController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('celebrants', CelebrantController::class);


     
    Route::get('/birthdays', function () {
        return view('birthdays.index');
    })->name('birthdays');

    Route::get('/anniversaries', function () {
        return view('anniversaries.index');
    })->name('anniversaries');

    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings');
});



require __DIR__.'/auth.php';
