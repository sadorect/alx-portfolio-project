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
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/settings/email', [AdminController::class, 'emailSettings'])->name('admin.settings.email');
    Route::post('/settings/test-email', [AdminController::class, 'testEmail'])->name('admin.settings.test-email');
    Route::get('/settings/notifications', [AdminController::class, 'notificationSettings'])
    ->name('admin.settings.notifications');
    Route::get('/settings/system', [AdminController::class, 'systemSettings'])
        ->name('admin.settings.system');
    
    Route::get('/admin/users/{user}', [AdminController::class, 'showUser'])->name('admin.users.show');

    Route::get('/activities', [AdminController::class, 'activities'])->name('admin.activities');
    Route::get('/activities/{activity}', [AdminController::class, 'showActivity'])->name('admin.activities.show');
   
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/notifications/{notification}', [AdminController::class, 'showNotification'])->name('admin.notifications.show');
    Route::post('/notifications', [AdminController::class, 'storeNotification'])->name('admin.notifications.store');
    Route::put('/notifications/{notification}/resolve', [AdminController::class, 'resolveNotification'])->name('admin.notifications.resolve');
});
