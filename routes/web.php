<?php

use App\Http\Controllers\FrontController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('index');
    Route::post('/prompt', [FrontController::class, 'prompt'])->name('prompt');
    Route::get('/edit_profile', [FrontController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/update_profile', [FrontController::class, 'update_profile'])->name('update_profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
