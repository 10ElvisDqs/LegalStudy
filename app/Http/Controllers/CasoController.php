<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use App\Models\Categoria;
use App\Models\Client;
use App\Models\Tipo;
use App\Models\User;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;

class CasoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $casos = Caso::all();
        return view('moduloCasos.listCasos',compact('users','casos'));
    }

    public function buscador(Request $request){
        $nombres=Client::where("nombre","like",$request->texto."%")->get();
        return view('moduloCasos.listCasos',compact('nombre'));
    }
    public function ver(Request $request){
        $caso=$request;
        return view('moduloCasos.detailsCasos',compact('caso'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Realiza la consulta para obtener el ID del usuario por su nombre
        //$usuario = Client::where('nombre', $nombre)->first();
        $tipos=Tipo::all();
        $categorias=Categoria::all();
        return view('moduloCasos.addCaso',compact('tipos','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validacion = $request->validate([

              'titulo'=>'required|string|max:100',
              'descripcion'=>'required|string|max:500',
              'fecha_apertura'=>'required|date',
              'estado'=>'required|string|max:100',
              'tipo'=>'required|numeric',
              //'id_cliente'=>'required|numeric',
          ]);


        // En tu controlador o en donde estés manejando la solicitu
        $input_dni = $request->input('dni');

        $id_resultado = DB::table('clients')
        ->where('dni', $input_dni)
        ->value('id');


         $Caso=new Caso();
         $Caso->titulo=$request->input('titulo');
         $Caso->fecha_apertura = $request->input('fecha_apertura');
         $Caso->descripcion = $request->input('descripcion');
         $Caso->estado = $request->input('estado');
         $Caso->id_tipo = $request->input('tipo');
         $Caso->id_cliente = $id_resultado ;

        $Caso->save();


        return back()->with('message','ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $caso)
    {
        //
        // Aquí puedes acceder a la información del caso utilizando el identificador $caso
        $caso = Caso::find($caso); // asumiendo que tu modelo se llama Caso
        $categorias=Categoria::all();
        $tipos=Tipo::all();
        return view('moduloCasos.detailsCaso',compact('caso','categorias','tipos'));
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
