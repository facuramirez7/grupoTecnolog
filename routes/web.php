<?php

use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Models\Client;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\Part;
use App\Models\PartType;
use App\Models\Rol;
use App\Models\Service;
use App\Models\User;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});



/* Devices */
Route::get('/equipos', function () {
    return view('admin.device.index');
})->name('devices.index');
Route::get('/equipo/{device}', function(Device $device) {
    return view('admin.device.show')->with('device', $device);
})->name('device.show');


/* Users */
Route::get('/usuarios', function () {
    return view('admin.user.index');
})->name('users.index');
Route::get('/usuario/{user}', function(User $user) {
    return view('admin.user.show')->with('user', $user);
})->name('users.show');

/* Roles ONLY SUPER ADMIN = ME*/
Route::get('/roles', function () {
    return view('admin.rol.index');
})->name('rols.index');
Route::get('/rol/{rol}', function(Rol $rol) {
    return view('admin.rol.show')->with('rol', $rol);
})->name('rols.show');

/* Device Types ONLY SUPER ADMIN = ME*/
Route::get('/tipos-de-equipos', function () {
    return view('admin.devType.index');
})->name('device-type.index');
Route::get('/tipo-de-equipo/{type}', function(DeviceType $type) {
    return view('admin.devType.show')->with('type', $type);
})->name('device-types.show');

/* Part Type ONLY SUPER ADMIN = ME*/
Route::get('/tipos-de-repuestos', function () {
    return view('admin.partType.index');
})->name('part-type.index');
Route::get('/tipo-de-repuesto/{type}', function(PartType $type) {
    return view('admin.partType.show')->with('type', $type);
})->name('part-types.show');

/* Clients */
Route::get('/clientes', function () {
    return view('admin.client.index');
})->name('clients.index');
Route::get('/cliente/{client}', function(Client $client) {
    return view('admin.client.show')->with('client', $client);
})->name('clients.show');

/* Services */
Route::get('/servicios', function () {
    return view('admin.service.index');
})->name('services.index');
Route::get('/servicio/{service}', function(Service $service) {
    return view('admin.service.show')->with('service', $service);
})->name('service.show');


/* Parts */
Route::get('/repuestos', function () {
    return view('admin.part.index');
})->name('parts.index');
Route::get('/repuesto/{part}', function(Part $part) {
    return view('admin.part.show')->with('part', $part);
})->name('part.show');
