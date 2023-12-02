
@extends('adminlte::page')

@section('title', 'Nuevo Caso')

@section('content_header')
    <h1>Informacion del Caso</h1>
@stop
{{-- @section('plugins.BootstrapSlider', true) --}}
@section('plugins.TempusDominusBs4', true)
@section('content')

    <h3>Ingrese la informacion de un cliente</h3>
    <h3></h3>


    <div class="card">

        <div class="card-body">
            <form action="{{route('casos.store')}}" method="post">
                @csrf
                {{-- With prepend slot, sm size and label --}}
                {{-- With prepend slot --}}
                <div class="row">
                    {{-- With multiple slots and lg size --}}
                    <div class="col-3">


                    </div>
                    <div class="col-6">
                        <ul id="showlist" tabindex="1" class="list-group"></ul>

                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <x-adminlte-input id="user" name="user" label="User" placeholder="{{ $caso->cliente->nombre }}" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                    </div>
                    <div class="col-6  px-4">
                        {{-- With prepend slot --}}
                        <x-adminlte-input id="dni" name="dni" label="DNI" placeholder="{{ $caso->cliente->dni }}" label-class="text-lightblue" >
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-address-card text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>

                <div class="row">

                    <div class="col-6">
                        <x-adminlte-input name="titulo" label="Titulo" placeholder="{{$caso->titulo}}" label-class="text-lightblue">
                            <x-slot name="prependSlot">

                                <div class="input-group-text" >
                                    <i class="fas fa-user text-lightblue"></i>

                                </div>
                            </x-slot>
                        </x-adminlte-input>

                    </div>
                    <div class="col-3 px-4 ">


                        {{-- Placeholder, date only and append icon --}}
                        @php
                        $config = ['format' => 'YYYY-MM-DD'];
                        @endphp
                        <x-adminlte-input-date name="fecha_apertura" :config="$config" label="Fecha" placeholder="{{$caso->fecha_apertura}}" label-class="text-lightblue" igroup-size="sm">
                            <x-slot name="appendSlot">
                                <div class="input-group-text  bg-gradient-blue">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>

                    </div>
                    <div class="col-3">
                        <x-adminlte-select2 name="estado" label="Estado" label-class="text-lightblue"
                                    igroup-size="sm" data-placeholder="">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </div>
                                    </x-slot>
                                    <option value="">{{$caso->estado}}</option>


                        </x-adminlte-select2>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        {{-- ['descripcion', 'fecha_apertura', 'estado', 'tipo_caso', 'id_cliente']; --}}
                        <x-adminlte-textarea name="descripcion" label="Descripcion" rows=5 label-class="text-lightblue"
                        igroup-size="sm" placeholder="{{$caso->descripcion}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-dark">
                                    <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                                </div>
                            </x-slot>
                            {{old('descripcion')}}
                        </x-adminlte-textarea>

                    </div>
                    <div class="col-6 px-4">

                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h3>Detalle del Servicio</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">

                                {{-- With prepend slot, label and data-placeholder config --}}
                                <x-adminlte-select2 name="categoria" label="Categoria" label-class="text-lightblue"
                                    igroup-size="sm" data-placeholder="asdasd" class="select-categoria">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </div>
                                    </x-slot>
                                    <option value="">{{$caso->tipo->categoria->nombre }}</option>

                                </x-adminlte-select2>
                            </div>
                            <div class="col-5">
                                {{-- With prepend slot, label and data-placeholder config --}}
                                <x-adminlte-select2 name="tipo" label="Tipo" label-class="text-lightblue"
                                    igroup-size="sm" data-placeholder="Seleccione una opción..." class="select-tipo">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </div>
                                    </x-slot>
                                    <option value="">{{$caso->tipo->nombre }}</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" data-precio="{{ $tipo->precio }}" data-categoria-id="{{ $tipo->id_categoria }}">{{ $tipo->nombre }}</option>
                                        {{-- <option value="{{ $tipo->id }}" data-categoria-id="{{ $tipo->id_categoria }}">{{ $tipo->nombre }}</option> --}}
                                    @endforeach
                                </x-adminlte-select2>
                            </div>
                            <div class="col-2">
                                {{-- With prepend slot --}}
                                <x-adminlte-input name="precio" label="Precio" placeholder="{{$caso->tipo->precio}}" label-class="text-lightblue" igroup-size="sm">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-money-bill-wave text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                        </div>
                    </div>

                </div>




             </form>

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{asset('search/js/search.js')}}" type="module">

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var selectCategoria = document.querySelector('.select-categoria');
            var selectTipo = document.querySelector('.select-tipo');

            // Manejar el cambio en el select de categoría
            selectCategoria.addEventListener('change', function () {
                // Obtener el valor seleccionado
                var selectedCategoriaId = selectCategoria.value;

                // Filtrar las opciones del select de tipo
                for (var i = 0; i < selectTipo.options.length; i++) {
                    var tipoOption = selectTipo.options[i];
                    var categoriaId = tipoOption.getAttribute('data-categoria-id');

                    // Mostrar/ocultar la opción según si pertenece a la categoría seleccionada
                    tipoOption.style.display = (selectedCategoriaId === '' || categoriaId === selectedCategoriaId) ? '' : 'none';
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var selectTipo = document.querySelector('.select-tipo');
            var inputPrecio = document.querySelector('input[name="precio"]');

            // Manejar el cambio en el select de tipo
            selectTipo.addEventListener('change', function () {
                // Obtener el valor seleccionado
                var selectedTipoId = selectTipo.value;

                // Buscar el tipo seleccionado en la lista de tipos
                var selectedTipo = null;
                for (var i = 0; i < selectTipo.options.length; i++) {
                    var tipoOption = selectTipo.options[i];
                    if (tipoOption.value === selectedTipoId) {
                        selectedTipo = tipoOption;
                        break;
                    }
                }

                // Autocompletar el precio con el valor del tipo seleccionado
                if (selectedTipo !== null) {
                    var precio = selectedTipo.getAttribute('data-precio');

                    // Actualizar el valor del campo de precio
                    inputPrecio.value = precio;
                } else {
                    // Limpiar el campo de precio si no hay tipo seleccionado
                    inputPrecio.value = '';
                }
            });
        });
    </script>




@stop
