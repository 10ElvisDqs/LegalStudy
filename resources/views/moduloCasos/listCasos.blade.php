@extends('adminlte::page')

@section('title', 'Gestion de Casos')

@section('content_header')
    <h1>Administracion de Casos</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="card">
        <div class="card-header">
            {{-- <a href="{{route('casos.create')}}" class="btn btn-primary float-right mt-2 mr-2 fas fa-file-alt">Nuevo Caso</a> --}}
            <a href="{{route('casos.create')}}" class="btn btn-primary float-right mt-2 mr-2">Nuevo</a>
            {{-- <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right" data-toggle="modal" data-target="#modalPurple" /> --}}
            {{-- <x-adminlte-button label="Nuevo Caso" theme="primary" icon="fas fa-file-alt" class="float-right" data-toggle="modal" data-target="#modalPurple" /> --}}
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
                @php
                $heads = [
                    'ID',
                    'Titulo',
                    'Fecha',
                    'Estado',
                    ['label' => 'Actions', 'no-export' => true, 'width' => 15],
                ];

                $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>';
                $btnAsignar = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Asignar">
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
                <x-adminlte-datatable id="table1" :heads="$heads"  head-theme="dark" :config="$config">
                    @foreach($casos as $caso)
                        <tr>
                           <td>{{ $caso->id}}</td>
                           <td>{{ $caso->titulo}}</td>
                           <td>{{ $caso->fecha_apertura}}</td>
                           <td>

                                @switch($caso->estado)
                                    @case('abierto')
                                        <div class="btn btn-success rounded-pill px-3">{{$caso->estado }}</div>
                                        @break

                                    @case('ejecucion')
                                        <div class="btn btn-info rounded-pill px-3">{{$caso->estado }}</div>
                                        @break

                                    @case('cerrado')
                                        <div class="btn btn-danger rounded-pill px-3">{{$caso->estado }}</div>
                                        @break

                                    @default
                                        Opción no válida
                                @endswitch

                           </td>
                           <td>
                            <a href="{{route('casos.show',$caso->id)}}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </a>
                         
                            {{-- artic --}}
                            <a href="{{route('asignar.edit',$caso)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            {{-- form --}}
                            <form style="display: inline" action="{{route('asignar.destroy',$caso)}}" method="post" class="formEliminar">
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

    {{-- Themed --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('.formEliminar').submit(function(e){
                e.preventDefault();
                Swal.fire({
                title: 'Estas Seguro?',
                text: "Se va a eliminar tu registro!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            })
        })
    </script>
@stop
