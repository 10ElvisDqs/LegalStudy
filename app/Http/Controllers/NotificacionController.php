<?php

namespace App\Http\Controllers;

use App\Mail\EnviarCorreo;
use App\Models\Caso;
use App\Models\Notificacion;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\TestStatus\Notice;
use Barryvdh\DomPDF\Facade\Pdf;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notificaciones = Notificacion::all();
        $casos = Caso::all();
        return view('mails.index', compact('notificaciones'));
    }

    public function pdf()
    {
        $notificaciones = Notificacion::all();
        /* $casos = Caso::all();
        return view('mails.pdf', compact('notificaciones')); */
        $pdf = PDF::loadView('mails.pdf', ['notificaciones' => $notificaciones]);
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $casos = Caso::all();
        return view('mails.create', compact('casos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Mail::to($request->destinatario)->send(new EnviarCorreo($request->mensaje, $request->adjunto));
        $notificacion = new Notificacion();
        $notificacion->mail = $request->get('destinatario');
        $notificacion->fecha = $request->get('fecha');
        $notificacion->id_caso = $request->get('caso');
        $notificacion->save();

        //return redirect()->route('enviar_correo.index')->with('message', 'correo enviado exitosamente');
        return back()->with('message', 'correo enviado exitosamente');
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
        $notificaciones = Notificacion::find($id);
        return view('mails.edit', compact('notificaciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Mail::to($request->destinatario)->send(new EnviarCorreo($request->mensaje, $request->adjunto));
        $notificacion =  Notificacion::find($id);
        $notificacion->mail = $request->get('destinatario');
        $notificacion->fecha = $request->get('fecha');
        $notificacion->save();

        return back()->with('message', 'correo enviado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notificaciones = Notificacion::find($id);
        $notificaciones->delete();
        return back();
    }
}
