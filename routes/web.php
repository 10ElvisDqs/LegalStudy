<?php

use App\Http\Controllers\AsignarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClienteController;
use App\http\Controllers\NotificacionController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AsignarCasoController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;


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
        // $clients = Client::all();
        // $counter = User::count();
        // $totalPreciosCasos = DB::table('casos')
        // ->join('tipos', 'casos.id_tipo', '=', 'tipos.id')
        // ->select(DB::raw('SUM(tipos.precio) as total_precios_casos'))
        // ->first();
        // return view('dashboard',compact('clients','counter'.'totalPreciosCasos'));

        $clients = Client::all();
        $counter = User::count();
        $canClient = Client::count();
        $totalPreciosCasos = DB::table('casos')
            ->join('tipos', 'casos.id_tipo', '=', 'tipos.id')
            ->select(DB::raw('SUM(tipos.precio) as total_precios_casos'))
            ->first();
        

        $mes= Carbon::now()->month;
        $data = DB::table('casos')
            ->join('tipos', 'casos.id_tipo', '=', 'tipos.id')
            ->select('tipos.nombre', DB::raw('COUNT(*) as cantidad'))
            ->whereRaw("MONTH(casos.fecha_apertura) = $mes")
            ->groupBy('tipos.nombre')
            ->orderByDesc('cantidad')
            ->take(5)  // Obtener los 5 tipos más solicitados, ajusta según tus necesidades
            ->get();

        $formattedData = [];

        foreach ($data as $row) {
            $formattedData[$row->nombre] = $row->cantidad;
        }


        // Convertir el objeto stdClass a un tipo primitivo (por ejemplo, float o int)
        $totalPreciosCasos = (float) $totalPreciosCasos->total_precios_casos;
        return view('dashboard', compact('clients', 'counter', 'totalPreciosCasos','canClient','formattedData', 'mes'));
    })->name('dashboard');
    Route::get('/profile',[UsuarioController::class,'profile']);
    Route::resource('/client',ClienteController::class)->names('cliente');
    Route::resource('/roles',RoleController::class)->names('roles');
    Route::resource('/permisos',PermisoController::class)->names('permisos');
    Route::resource('/usuarios',AsignarController::class)->names('asignar');
    Route::resource('/casos',CasoController::class)->names('casos');
    Route::get('/casos/asignar', 'CasoController@asignarCaso')->name('casos.asignarCaso');
    Route::resource('/categorias',CategoriasController::class)->names('categorias');
    Route::resource('/tipos',TiposController::class)->names('tipos');
    Route::resource('/asignarcaso',AsignarCasoController::class)->names('asignarcaso');
    Route::post('myurl',[SearchController::class,'show']);
    
    Route::get('/casos-por-mes/{mes}', [CasoController::class, 'casosPorMes']);
    
});

Route::get('/auth/redirect',[AuthController::class,'redirect']);
Route::get('/auth/callback-url',[AuthController::class,'callback']);

Route::get('/Correo/index',[NotificacionController::class ,'index'])->name('enviar-correo.index');
Route::get('/Correo/create',[NotificacionController::class ,'create'])->name('enviar-correo.create');
Route::post('/Correo/store',[NotificacionController::class ,'store'])->name('enviar-correo');
Route::delete('/Correo/destroy/{id}', [NotificacionController::class, 'destroy'])->name('enviar-correo.destroy');
Route::get('/Correo/edit/{id}', [NotificacionController::class, 'edit'])->name('enviar-correo.edit');
Route::put('/Correo/update/{id}', [NotificacionController::class, 'update'])->name('enviar-correo.update');

Route::get('/Correo/pdf', [NotificacionController::class, 'pdf'])->name('enviar_correo.pdf');
// Notificacion

///modulo documento
Route::get('/documento', [DocumentoController::class, 'index'])->name('documento.index');
Route::get('/documento/create', [DocumentoController::class, 'create'])->name('documento.create');
Route::post('/documento/store', [DocumentoController::class, 'store'])->name('documento.store');
Route::delete('/documento/destroy/{id}', [DocumentoController::class, 'destroy'])->name('documento.destroy');
Route::get('/documento/edit/{id}', [DocumentoController::class, 'edit'])->name('documento.edit');
Route::put('/documento/update/{id}', [DocumentoController::class, 'update'])->name('documento.update');
Route::get('/documento/pdf', [DocumentoController::class, 'pdf'])->name('documento.pdf');


