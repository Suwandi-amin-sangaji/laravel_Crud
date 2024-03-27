<?php

use App\Http\Controllers\BerandaAdminController;
use App\Http\Controllers\BerandaPetugasController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// admin
Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/home', [BerandaAdminController::class, 'index'])->name('admin.home');
    Route::resource('user', UserController::class);
});

// Petugas
Route::prefix('petugas')->middleware(['auth', 'auth.petugas'])->group(function () {
    Route::get('/home', [BerandaPetugasController::class, 'index'])->name('petugas.home');
});


// logout

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
