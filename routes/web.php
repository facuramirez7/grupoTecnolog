<?php

use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/* Users */
Route::get('/usuarios', function () {
    return view('admin.user.index');
})->name('users.index');
Route::get('/usuario/{user}', [UserController::class, 'show'])->name('users.show');

/* Rols ONLY SUPER ADMIN = ME*/
Route::get('/roles', function () {
    return view('admin.rol.index');
})->name('rols.index');
Route::get('/rol/{rol}', [RolController::class, 'show'])->name('rols.show');