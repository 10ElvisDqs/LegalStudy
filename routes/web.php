<?php

use App\Http\Controllers\AsignarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\UsuarioController;
use App\Models\Client;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $clients = Client::all();
        $counter = User::count();
        return view('dashboard',compact('clients','counter'));
    })->name('dashboard');
    Route::get('/profile',[UsuarioController::class,'profile']);
    Route::resource('/client',ClienteController::class)->names('cliente');
    Route::resource('/roles',RoleController::class)->names('roles');
    Route::resource('/permisos',PermisoController::class)->names('permisos');
    Route::resource('/usuarios',AsignarController::class)->names('asignar');
    Route::resource('/casos',CasoController::class)->names('casos');
    Route::resource('/categorias',CategoriasController::class)->names('categorias');
    Route::resource('/tipos',TiposController::class)->names('tipos');
    Route::post('myurl',[SearchController::class,'show']);
});

Route::get('/auth/redirect',[AuthController::class,'redirect']);
Route::get('/auth/callback-url',[AuthController::class,'callback']);
