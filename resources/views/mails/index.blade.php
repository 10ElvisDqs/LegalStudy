@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>NOTIFICAIONES</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <a href="{{route('enviar-correo.create')}}" class="btn btn-primary float-right mt-2 mr-2">Nuevo</a>

        <a href="{{route('enviar_correo.pdf')}}" class="btn btn-primary float-right mt-2 mr-2">PDF</a>
    </div>



    <div class="card-body">
        {{-- Setup data for datatables --}}
        @php
        $heads = [
        'ID',
        'CORREO',
        'FECHA',
        'CASO',
        ['label' => 'Actions', 'no-export' => true, 'width' => 15],
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
            @foreach($notificaciones as $notificacion)
            <tr>
                <td>{{$notificacion->id}}</td>
                <td>{{$notificacion->mail}}</td>
                <td>{{$notificacion->fecha}}</td>
                <td>{{$notificacion->casos->titulo}}</td>
                <td><a href="{{route('enviar-correo.edit',$notificacion)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <form style="display: inline" action="{{route('enviar-correo.destroy',$notificacion)}}" method="post" class="formEliminar">
                        @csrf
                        @method('delete')
                        {!!$btnDelete!!}
                    </form>
                </td>

            </tr>

            @endforeach
        </x-adminlte-datatable>


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
                text: "Se va a eliminar un registro!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        })
    })
</script>
@stop