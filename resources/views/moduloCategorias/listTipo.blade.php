@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de Tipo de Casos </h1>
@stop
@section('plugins.TempusDominusBs4', true)
@section('content')
    <p>Tipo</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- <!-- @can('Crear Cliente') -->
                    <div class="card-header">
                        <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right" data-toggle="modal" data-target="#modalPurple" />
                    </div>
                <!-- @endcan --> --}}
                <div class="card-header">
                    <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right" data-toggle="modal" data-target="#modalPurple" />
                </div>
                <div class="card-body">
                    {{-- Setup data for datatables --}}
                        @php
                        $heads = [
                            'ID',
                            'Nombre',
                            'Categoria',
                            'Precio',

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
                        <x-adminlte-datatable id="table1" :heads="$heads"  head-theme="dark" :config="$config">
                            @foreach($tipos as $tipo)
                                <tr>
                                   <td>{{ $tipo->id}}</td>
                                   <td>{{ $tipo->nombre}}</td>
                                   {{-- <td>{{ $tipo->id_categoria->nombre}}</td> --}}
                                   <td>{{ $tipo->categoria->nombre}}</td>
                                   <td>{{ $tipo->precio}}</td>

                                   <td>
                                    {{-- artic --}}
                                    <a href="{{route('tipos.edit',$tipo)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </a>
                                    {{-- form --}}
                                    @can('eliminar cliente')
                                        <form style="display: inline" action="{{route('tipos.destroy',$tipo)}}" method="post" class="formEliminar">
                                            @csrf
                                            @method('delete')
                                            {!!$btnDelete!!}
                                        </form>
                                    @endcan
                                </td>
                                </tr>
                            @endforeach
                        </x-adminlte-datatable>


                </div>
            </div>
        </div>

    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Nueva Categoria" theme="primary"
    icon="fas fa-bolt" size='lg' disable-animations>
        <form action="{{route('tipos.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <x-adminlte-input name="nombre" label="Nombre Tipo" placeholder="nombre de la categoria..."
                        fgroup-class="" disable-feedback/>

                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <x-adminlte-select2 name="id_categoria" label="Categoria" label-class="text-lightblue"
                    igroup-size="sm" data-placeholder="Selecione una opcion...">
                    <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fab fa-creative-commons-nd"></i>
                            </div>
                        </x-slot>
                        <option value="">Selecione  el   estado </option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <div class="col-6">
                    <x-adminlte-input name="precio" label="Precio" placeholder="100.00 BS" label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-dollar-sign text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-key"/>
        </form>
    </x-adminlte-modal>
    {{-- Example button to open modal --}}
    <x-adminlte-button label="Open Modal" data-toggle="modal" data-target="#modalPurple" class="bg-purple"/>
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


