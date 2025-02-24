<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CelebrantController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('celebrants', CelebrantController::class);
// Add this route within your auth middleware group
Route::post('/celebrants/import', [CelebrantController::class, 'import'])->name('celebrants.import');
Route::get('/celebrants/sample', [CelebrantController::class, 'downloadSample'])->name('celebrants.sample');


     
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

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/activities', [AdminController::class, 'activities'])->name('admin.activities');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/users/{user}', [AdminController::class, 'showUser'])->name('admin.users.show');

});
