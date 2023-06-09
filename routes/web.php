<?php

use App\Http\Controllers\FirmwareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/firmware/version', [FirmwareController::class, 'version'])->name('firmware.version');
Route::get('/firmware/version.txt', [FirmwareController::class, 'versionRaw'])->name('firmware.version.raw');
Route::get('/firmware/download/{version?}', [FirmwareController::class, 'download'])->name('firmware.download');

Route::post('/reports', [ReportController::class, 'store'])->name("reports.store");


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

//require __DIR__.'/auth.php';
