@extends('adminlte::page')

@section('title', 'Gestion de Casos')

@section('content_header')
    <h1>Administracion de Casos</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Nuevo Caso" theme="primary" icon="fas fa-file-alt" class="float-right" data-toggle="modal" data-target="#modalPurple" />
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
                @php
                $heads = [
                    'ID',
                    'Nombre',
                    'Correo',
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
                    @foreach($users as $user)
                        <tr>
                           <td>{{ $user->id}}</td>
                           <td>{{ $user->name}}</td>
                           <td>{{ $user->email}}</td>
                           <td>
                            {{-- artic --}}
                            <a href="{{route('asignar.edit',$user)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            {{-- form --}}
                            <form style="display: inline" action="{{route('asignar.destroy',$user)}}" method="post" class="formEliminar">
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
