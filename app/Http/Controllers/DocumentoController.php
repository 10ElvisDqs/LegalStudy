<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Caso;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = Documento::all();
        $casos = Caso::all();
        return view('documento.index')->with('documentos', $documentos, 'casos', $casos);
    }

    public function pdf()
    {
        $documentos = Documento::all();
        $pdf = PDF::loadView('documento.pdf', ['documentos' => $documentos]);
        return $pdf->stream();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Documento::all();
        $casos = Caso::all();
        $fechaActual = Carbon::now();

        // Formatea la fecha al formato que desees, por ejemplo 'Y-m-d'
        $fechaFormateada = $fechaActual->format('Y-m-d');

        // Devuelve la vista con la variable $fechaFormateada
        return view('documento.create', compact('documentos', 'fechaFormateada', 'casos'));

        //return view('documento.create')->with('fechaFormateada', $fechaFormateada, 'documentos', $documentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $validacion = $request->validate([

            'descripcion' => 'required',
            'fecha' => 'required|date|before_or_equal:today',
            //'id_caso' => 'required',

        ]);
        try {
            DB::beginTransaction();
            $documentos = new Documento;
            if ($request->hasFile('adjunto')) {
                $archivo = $request->file('adjunto');
                $archivo->move(public_path() . '/Archivos/', $archivo->getClientOriginalName());
                $documentos->nombre = $archivo->getClientOriginalName();
            }
            $documentos->descripcion = $request->get('descripcion');
            $documentos->fecha = $request->get('fecha');
            $documentos->id_caso = $request->get('caso');
            $documentos->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return back()->with('message', 'Registrado Correctamente');
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
        $documento = Documento::find($id);
        $documentos = Documento::all();
        $casos = Caso::all();
        return view('documento.edit', compact('documento', 'casos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valida los datos del formulario
        $validacion = $request->validate([
            'descripcion' => 'required',
            'fecha' => 'required|date|before_or_equal:today',
            //'id_caso' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // Recupera el documento de la base de datos
            $documentos = Documento::find($id);

            if ($request->hasFile('adjunto')) {
                // Elimina el antiguo archivo si existe
                if ($documentos->nombre) {
                    File::delete(public_path() . '/Archivos/' . $documentos->nombre);
                }

                // Sube el nuevo archivo
                $archivo = $request->file('adjunto');
                $archivo->move(public_path() . '/Archivos/', $archivo->getClientOriginalName());

                // Actualiza el nombre del archivo en la base de datos
                $documentos->nombre = $archivo->getClientOriginalName();
            }

            // Actualiza los demás datos del documento
            $documentos->descripcion = $request->get('descripcion');
            $documentos->fecha = $request->get('fecha');
            $documentos->id_caso = $request->get('caso');

            // Guarda los cambios
            $documentos->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return back()->with('message', 'Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $documentos = Documento::find($id);
        $documentos->delete();
        return back();
    }
}
