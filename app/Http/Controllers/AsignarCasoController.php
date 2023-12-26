<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Caso;
use App\Models\Categoria;
use App\Models\Client;
use App\Models\Tipo;
use App\Models\AsignacionCaso;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AsignarCasoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $casos = Caso::all(); // asumiendo que tu modelo se llama Caso
        $categorias=Categoria::all();
        $tipos=Tipo::all();
        return view('moduloCasos.moduloAsignacion.asignarCaso',compact('users','casos',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        // {{-- $table->id();
        //     $table->unsignedBigInteger('id_caso');
        //     $table->unsignedBigInteger('id_abogado');
        //     $table->date('fecha_asignacion');
        //     $table->date('fecha_desasignacion')->nullable();
        //     $table->string('rol_en_caso')->nullable();//Un campo para especificar el rol que desempeña el abogado en el caso (por ejemplo, abogado principal, asistente, consultor).
        //     $table->enum('estado', ['activo', 'inactivo', 'completado'])->default('activo');//estado actual de la asignación (activo, inactivo, completado).
        //     $table->decimal('horas_trabajadas', 8, 2)->default(0.0);
        //     $table->timestamps();
            
        //     $table->foreign('id_caso')->references('id')->on('casos')->onDelete('cascade');
        //     $table->foreign('id_abogado')->references('id')->on('users')->onDelete('cascade' ); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validacion = $request->validate([

        //     'titulo'=>'required|string|max:100',
        //     'descripcion'=>'required|string|max:500',
        //     'fecha_apertura'=>'required|date',
        //     'estado'=>'required|string|max:100',
        //     'tipo'=>'required|numeric',
        //     //'id_cliente'=>'required|numeric',
        // ]);
//        dd($request->all());

      // Imprimir valores para debug
      //dd($nombre_abogado, $ID_abogado);


       $CasoAsgnado=new AsignacionCaso();
       $CasoAsgnado->id_abogado=$request->input('id_abogado');
       $CasoAsgnado->id_caso=$request->input('id_caso');

       $CasoAsgnado->fecha_asignacion= $request->input('fecha_asignacion');
       $CasoAsgnado->fecha_desasignacion= $request->input('fecha_desasignacion');
       $CasoAsgnado->rol_en_caso = $request->input('rol_abogado');
       $CasoAsgnado->estado = $request->input('estado');//horasTrabajadas
       $CasoAsgnado->horas_trabajadas =$request->input('horasTrabajadas');

       $CasoAsgnado->save();


      return back()->with('message','ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
