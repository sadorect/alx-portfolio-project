<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnniversaryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('userDashboard');
})->middleware(['auth'])->name('dashboard');

/*
Route::middleware('check_admin')->group(function () {
    Route::get('/admin');
});
*/


Route::middleware('user_auth')->group(function () {

Route::post('/post/record', [AnniversaryController::class, 'postRecord'])->name('post.record');
Route::get('/add/record', [AnniversaryController::class, 'addRecord'])->name('add.record');
Route::get('/show/record/{user_id}', [AnniversaryController::class, 'showRecord'])->name('show.record');
Route::get('/edit/record/{id}', [AnniversaryController::class, 'editRecord'])->name('edit.record');
Route::post('/update/record', [AnniversaryController::class, 'updateRecord'])->name('update.record');
Route::get('/delete/record/{id}', [AnniversaryController::class, 'deleteRecord'])->name('delete.record');

Route::get('/upcoming/birthdays', [AnniversaryController::class, 'upcomingBirthdays'])->name('upcoming.birthdays');
Route::get('/upcoming/weddings', [AnniversaryController::class, 'upcomingWeddings'])->name('upcoming.weddings');

Route::get('/send/notice', [AnniversaryController::class, 'sendNotice'])->name('send.notice');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
