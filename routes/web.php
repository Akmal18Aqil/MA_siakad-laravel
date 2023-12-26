<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ScheduleController;

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
    return view('pages.auth.login', ['type_menu' => '']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.app.dashboard-siakad', ['type_menu' => '']);
    })->name('home');
    Route::resource('user', UserController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('schedule', ScheduleController::class);
    Route::get('createqrcode/{schedule}', [ScheduleController::class, 'createQrcode'])->name('createqrcode');
    Route::put('generateqrcode/{schedule}', [ScheduleController::class, 'generateQrcode'])->name('generateqrcode');
});
// Route::get('showqrcode', [QrCodeController::class, 'showQrcode'])->name('showqrcode');