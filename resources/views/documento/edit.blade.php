@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <form action="{{route('documento.update',$documento)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-adminlte-textarea name="descripcion" label="Descripcion" rows=5 label-class="text-lightblue" igroup-size="sm">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                    </div>
                </x-slot>
                {{($documento->descripcion)}}
            </x-adminlte-textarea>
            <br>
            <label label="Fecha" rows=5 label-class="text-lightblue">Fecha</label>
            <br>
            <input type="date" name="fecha" label="Fecha" value="{{$documento->fecha}}">

            <br>
            <x-adminlte-input type="file" name="adjunto" label="ADJUNTO" label-class="text-lightblue"></x-adminlte-input>

            <br>
            <x-adminlte-select2 name="caso" label="CASO" label-class="text-lightblue" igroup-size="lg" class="select-tipo">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-gavel"></i>
                    </div>
                </x-slot>
                @foreach($casos as $caso)
                <option value="{{ $caso->id }}" {{ $documento->caso == $caso->id ? 'selected' : '' }}>{{ $caso->titulo }}</option>
                @endforeach
                <option value="">Seleccione un Caso</option>
            </x-adminlte-select2>

            <x-adminlte-button type="submit" theme="primary" label="Guardar" icon="fas fa-save" />


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