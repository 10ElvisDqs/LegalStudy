<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tipo;
use Illuminate\Http\Request;

class TiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos=Tipo::all();
        $categorias = Categoria::all();
        return view('moduloCategorias.listTipo',compact('tipos','categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

         $validacion = $request->validate([
             'nombre' => 'required|string|max:100',
             'precio' => 'required|numeric',  // Mantén la validación numérica
             'id_categoria' => 'required|numeric',
         ]);
        // Obtén el ID de la categoría seleccionada
        $idCategoria = $request->input('id_categoria');


        $Tipo =new Tipo();
        $Tipo->nombre = $request->input('nombre');
        $Tipo->precio = $request->input('precio');
        $Tipo->id_categoria = $idCategoria;
        $Tipo->save();
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
