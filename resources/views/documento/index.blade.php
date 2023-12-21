@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Administracion de Documentos </h1>
@stop

@section('content')
<p>Welcome to this beautiful admin .</p>
<div class="card">

    <div class="card-header">
        <a href="{{route('documento.create')}}" class="btn btn-primary float-right mt-2 mr-2">Nuevo</a>
        <a href="{{route('documento.pdf')}}" class="btn btn-primary float-right mt-2 mr-2">PDF</a>
    </div>

    <div class="card-body">
        {{-- Setup data for datatables --}}
        @php
        $heads = [
        ['label' => 'ID', 'width' => 10],
        ['label' => 'NOMBRE', 'width' => 20],
        ['label' => 'DESCRIPCION', 'width' => 20],
        ['label' => 'FECHA', 'width' => 15],
        ['label' => 'CASO', 'width' => 15],
        ['label' => 'VER', 'width' => 10],
        ['label' => 'Actions', 'no-export' => true, 'width' => 30],
        ];

        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
        </button>';
        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
            <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
            <i class="fa fa-lg fa-fw fa-eye"></i>
        </button>';

        $config = [
        'language'=>[
        'url'=>'//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        ]
        ];
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config">
            @foreach($documentos as $documento)
            <tr>
                <td>{{ $documento->id}}</td>
                <td>{{ $documento->nombre}}</td>
                <td>{{ $documento->descripcion}}</td>
                <td>{{ $documento->fecha}}</td>
                <td>{{ $documento->casos->titulo}}</td>
                <td><a class="btn btn-primary " href="Archivos/{{$documento->nombre}}" target="blank_">ver</a></td>
                <td><a href="{{route('documento.edit',$documento)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>

                    <form style="display: inline" action="{{route('documento.destroy',$documento)}}" method="post" class="formEliminar">
                        @csrf
                        @method('delete')
                        {!!$btnDelete!!}
                    </form>
                </td>

                <!-- <form action="{{ route('documento.destroy', $documento->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form> -->


            </tr>
            @endforeach
        </x-adminlte-datatable>

    </div>



</div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('.formEliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Estas Seguro?',
                text: "Se va a eliminar tu registro!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        })
    })
</script>
@stop