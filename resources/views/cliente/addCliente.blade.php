@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gestion de Usuaios</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <form action="{{route('cliente.store')}}" method="post">
        @csrf
        <x-adminlte-input  type="number" name="dni" label="D.N.I." placeholder="Ingrese su DNI" label-class="text-lightblue" value="{{old('dni')}}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-input  type="text" name="apellido" label="Apellido" placeholder="Ingrese su apellido" label-class="text-lightblue" value="{{old('apellido')}}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input  type="text" name="nombre" label="Nombre" placeholder="Ingrese su nombre" label-class="text-lightblue" value="{{old('nombre')}}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input  type="email" name="email" label="Email" placeholder="ej. exameple@gmail.com" label-class="text-lightblue" value="{{old('email')}}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fa fa-envelope text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input  type="number" name="telefono" label="Telefono" placeholder="ej. 72591280" label-class="text-lightblue" value="{{old('telefono')}}">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fa fa-phone text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        {{-- With prepend slot, sm size and label --}}
        <x-adminlte-textarea name="direccion" label="Direccion" rows=5 label-class="text-lightblue"
        igroup-size="sm" placeholder="Insert su direccion...">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-dark">
                    <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                </div>
            </x-slot>
            {{old('direccion')}}
        </x-adminlte-textarea>


        {{-- With prepend slot, label and data-placeholder config --}}
        <x-adminlte-select2 name="estado" label="Estado" label-class="text-lightblue"
        igroup-size="lg" data-placeholder="Selecione una opcion...">
        <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
                <i class="fas fa-car-side"></i>
            </div>
        </x-slot>
        <option value="">Selecione el estado civil</option>
        <option value="casado">casado</option>
        <option value="soltero">soltero</option>
        <option value="union libre">unón libre</option>
        </x-adminlte-select2>

        <x-adminlte-button type="submit" theme="primary" label="Guardar" icon="fas fa-save"/>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
