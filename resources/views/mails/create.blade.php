@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')

@if(session('success'))
<li>{{session('success')}}</li>
@endif
<div class="card">
    <div class="card-body">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <form action="{{route('enviar-correo')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- <label for="">Destinatario</label> -->
            <!-- <input type="email" name="destinatario" required> -->

            <x-adminlte-input name="destinatario" label="DESTINATARIO" placeholder="mail@example.com" label-class="text-lightblue" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-envelope text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <!-- <textarea name="mensaje" id="" cols="30" rows="3"></textarea> -->
            <!--Textarea with icon prefix-->
            <!-- <div class="md-form">
                <label for="">Mensaje</label>
                <br>
                <textarea id="form10" name="mensaje" cols="30" rows="4"></textarea>
                <i class="fas fa-pencil-alt prefix fa-3x"></i>
            </div> -->

            <x-adminlte-textarea name="mensaje" label="MENSAJE" rows=5 igroup-size="sm" label-class="text-primary" placeholder="Write your message..." disable-feedback>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lg fa-comment-dots text-primary"></i>
                    </div>
                </x-slot>
            </x-adminlte-textarea>
            <br>
            <!-- @php
            $config = ['format' => 'DD-MM-YYYY'];
            @endphp
            <x-adminlte-input-date name="fecha" :config="$config" label="Fecha" placeholder="Choose a date..." label-class="text-lightblue" igroup-size="sm">
                <x-slot name="appendSlot">
                    <div class="input-group-text  bg-gradient-blue">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-date> -->

            <div class="col-md-2">
                <x-adminlte-input type="date" name="fecha" label="FECHA" label-class="text-lightblue"></x-adminlte-input>
            </div>

            <x-adminlte-select2 name="caso" label="CASO" label-class="text-lightblue" igroup-size="lg" data-placeholder="Seleccione una opción..." class="select-tipo" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-gavel"></i>
                    </div>
                </x-slot>
                <option value="">Seleccione un Caso</option>
                <!-- @foreach($casos as $caso)
                <option value="{{ $caso->id }}">{{ $caso->titulo }}</option>

                @endforeach -->

                @foreach($casos as $caso)
                <option value="{{ $caso->id }}" {{ old('caso') == $caso->id ? 'selected' : '' }}>{{ $caso->titulo }}</option>
                @endforeach

            </x-adminlte-select2>

            <!-- <label for="">Adjunto</label> -->
            <!-- <input type="file" name="adjunto" id=""> -->
            <x-adminlte-input type="file" name="adjunto" label="ADJUNTO" label-class="text-lightblue"></x-adminlte-input>
            <!-- <button type="submit">Enviar Correo</button> -->
            <x-adminlte-button type="submit" theme="primary" label="Enviar Correo" icon="fa fa-envelope" />
            <!-- <i class="fa-regular fa-envelope"></i> -->

        </form>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@if (session("message"))
<script>
    $(document).ready(function() {
        let mensaje = "{{ session ('message')}}";
        Swal.fire({
            'title': 'Resultado',
            'text': mensaje,
            showConfirmButton: false,
            timer: 1500,
            'icon': 'success',
        })

    })
</script>
@endif
@stop


<!-- 
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo con laravel</title>
</head>

<body>
    @if(session('success'))
    <li>{{session('success')}}</li>
    @endif
    <form action="{{route('enviar-correo')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="">Destinatario</label>
        <input type="email" name="destinatario" required>
        <label for="">Mensaje</label>
        <textarea name="mensaje" id="" cols="30" rows="3"></textarea>
        <label for="">Adjunto</label>
        <input type="file" name="adjunto" id="">
        <button type="submit">Enviar Correo</button>

    </form>
</body>

</html> -->