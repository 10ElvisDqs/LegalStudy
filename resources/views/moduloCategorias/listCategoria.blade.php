@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de Categorias de Casos </h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @can('Crear Cliente')
                    <div class="card-header">
                        <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right" data-toggle="modal" data-target="#modalPurple" />
                    </div>
                @endcan
                <div class="card-body">
                    {{-- Setup data for datatables --}}
                        @php
                        $heads = [
                            'ID',
                            'Nombre',

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
                            @foreach($categorias as $categoria)
                                <tr>
                                   <td>{{ $categoria->id}}</td>
                                   <td>{{ $categoria->nombre}}</td>

                                   <td>
                                    {{-- artic --}}
                                    <a href="{{route('categorias.edit',$categoria)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </a>
                                    {{-- form --}}
                                    @can('eliminar cliente')
                                        <form style="display: inline" action="{{route('categorias.destroy',$categoria)}}" method="post" class="formEliminar">
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
        <form action="{{route('categorias.store')}}" method="post">
            @csrf

            {{-- With label, invalid feedback disabled and form group class --}}
            <div class="row">
                <div class="col-7 ">

                            <x-adminlte-input name="nombre" label="Nombre Categoria" placeholder="nombre de la categoria..."
                                fgroup-class="" disable-feedback/>


                </div>
                <div class="col-5">
                    
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


