@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gestion de Usuaios</h1>
@stop

@section('content')

    <h3>Ingrese la informacion de un cliente</h3>

    <div class="card">

        <div class="card-body">
            <form action="{{route('cliente.update',$cliente)}}" method="post">
                @csrf
                @method('PUT')
                <x-adminlte-input  type="number" name="dni" label="D.N.I."  label-class="text-lightblue" value="{{$cliente->dni}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-input  type="text" name="apellido" label="Apellido" label-class="text-lightblue" value="{{$cliente->apellido}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input  type="text" name="nombre" label="Nombre" label-class="text-lightblue" value="{{$cliente->nombre}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input  type="email" name="email" label="Email"  label-class="text-lightblue" value="{{$cliente->email}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fa fa-envelope text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input  type="number" name="telefono" label="Telefono" label-class="text-lightblue" value="{{$cliente->telefono}}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fa fa-phone text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                {{-- With prepend slot, sm size and label --}}
                <x-adminlte-textarea name="direccion" label="Direccion" rows=5 label-class="text-lightblue"
                igroup-size="sm" >
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-dark">
                            <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                        </div>
                    </x-slot>
                    {{$cliente->direccion}}
                </x-adminlte-textarea>


                {{-- With prepend slot, label and data-placeholder config --}}
                <x-adminlte-select2 name="estado" label="Estado" label-class="text-lightblue"
                igroup-size="lg">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-car-side"></i>
                    </div>
                </x-slot>
                <option value="">{{$cliente->estado}}</option>
                <option value="">Selecione el estado civil</option>
                <option value="casado">casado</option>
                <option value="soltero">soltero</option>
                <option value="union libre">unón libre</option>
                </x-adminlte-select2>

                <x-adminlte-button type="submit" theme="primary" label="Actualizar" icon="fas fa-save"/>
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
        $(document).ready(function(){
            let mensaje= "{{ session ('message')}}";
            Swal.fire({
                'title':'Resultado',
                'text':mensaje,
                'icon':'success',
            })
        })
    </script>

    @endif
@stop
