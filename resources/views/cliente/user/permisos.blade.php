@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de Permisos</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right" data-toggle="modal" data-target="#modalPurple" />
        </div>
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
                    @foreach($permisos as $permiso)
                        <tr>
                           <td>{{ $permiso->id}}</td>
                           <td>{{ $permiso->name}}</td>
                           <td>
                            {{-- artic --}}
                            <a href="{{route('permisos.edit',$permiso)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            {{-- form --}}
                            <form style="display: inline" action="{{route('permisos.destroy',$permiso)}}" method="post" class="formEliminar">
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
    <x-adminlte-modal id="modalPurple" title="Nuevo Permiso" theme="primary"
    icon="fas fa-bolt" size='lg' disable-animations>
        <form action="{{route('permisos.store')}}" method="post">
            @csrf

            {{-- With label, invalid feedback disabled and form group class --}}
            <div class="row">
                <x-adminlte-input name="nombre" label="Nombre" placeholder="Aqui su permiso..."
                    fgroup-class="col-md-6" disable-feedback/>
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
