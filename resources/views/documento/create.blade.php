@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>DOCUMENTOS</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <form action="{{route('documento.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <!--  <x-adminlte-input name="nombre" label="nombre" placeholder="Ingrese el Titulo del Caso.." label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input> -->

            <x-adminlte-textarea name="descripcion" label="DESCRIOCION" rows=5 label-class="text-lightblue" igroup-size="sm" placeholder="Insert una descripcion...">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                    </div>
                </x-slot>
                {{old('descripcion')}}
            </x-adminlte-textarea>
            <div class="col-md-2">
                <x-adminlte-input type="date" name="fecha" label="FECHA" label-class="text-lightblue" value="{{$fechaFormateada}}"></x-adminlte-input>
            </div>
            <x-adminlte-input type="file" name="adjunto" label="ADJUNTO" label-class="text-lightblue"></x-adminlte-input>

            <!-- <div class="input-group mb-4">
                <input type="file" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div> -->

            <!-- <x-adminlte-select2 name="caso" label="CASO" label-class="text-lightblue" igroup-size="sm" data-placeholder="Seleccione una opción..." class="select-tipo">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fab fa-creative-commons-nd"></i>
                    </div>
                </x-slot>
                <option value="">Seleccione un tipo</option>
                @foreach($casos as $caso)
                <option value="{{ $caso->id }}">{{ $caso->titulo }}</option>
                @endforeach
            </x-adminlte-select2> -->
            <br>
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