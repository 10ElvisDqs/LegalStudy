@extends('adminlte::page')

@section('title', 'Nuevo Caso')

@section('content_header')
    <h1>Registrar Nuevo Caso</h1>
@stop
{{-- @section('plugins.BootstrapSlider', true) --}}
@section('plugins.TempusDominusBs4', true)
@section('content')

    <h3>Ingrese la informacion de un cliente</h3>
    @php
            if (session()) {
                if (session('message')=='ok') {
                    // {{-- Custom --}}
                    echo'
                    <x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Done" dismissable>
                        Éxito registro completado!
                    </x-adminlte-alert>
                    ';
                }
            }
    @endphp

    <div class="card">

        <div class="card-body">
            <form action="{{route('casos.store')}}" method="post">
                @csrf
                {{-- With prepend slot, sm size and label --}}
                {{-- With prepend slot --}}
                <div class="row">
                    {{-- With multiple slots and lg size --}}
                    <div class="col-3">
                        <x-adminlte-input id="mysearch" name="iSearch" label="Search" placeholder="search" igroup-size="sm">
                            <x-slot name="appendSlot">
                                <x-adminlte-button theme="outline-danger" label="Go!"/>
                            </x-slot>
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-blue">
                                    <i class="fas fa-search"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                    </div>
                    <div class="col-6">
                        <ul id="showlist" tabindex="1" class="list-group"></ul>

                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <x-adminlte-input id="user" name="user" label="User" placeholder="username" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>

                    </div>
                    <div class="col-6  px-4">
                        {{-- With prepend slot --}}
                        <x-adminlte-input id="dni" name="dni" label="DNI" placeholder="D.N.I" label-class="text-lightblue" >
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
                        <x-adminlte-input name="titulo" label="Titulo" placeholder="Ingrese el Titulo del Caso.." label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
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
                        <x-adminlte-input-date name="fecha_apertura" :config="$config" label="Fecha" placeholder="Choose a date..." label-class="text-lightblue" igroup-size="sm">
                            <x-slot name="appendSlot">
                                <div class="input-group-text  bg-gradient-blue">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>

                    </div>
                    <div class="col-3">
                        <x-adminlte-select2 name="estado" label="Estado" label-class="text-lightblue"
                                    igroup-size="sm" data-placeholder="Seleccione una opción...">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </div>
                                    </x-slot>
                                    <option value="">Seleccione un tipo</option>
                                        <option value="Abierto" >Abierto</option>
                                        <option value="Ejecucion" >Ejecucion</option>
                                        <option value="Cerrado" >Cerrado</option>

                        </x-adminlte-select2>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        {{-- ['descripcion', 'fecha_apertura', 'estado', 'tipo_caso', 'id_cliente']; --}}
                        <x-adminlte-textarea name="descripcion" label="Descripcion" rows=5 label-class="text-lightblue"
                        igroup-size="sm" placeholder="Insert una descripcion...">
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
                                    igroup-size="sm" data-placeholder="Seleccione una opción..." class="select-categoria">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fab fa-creative-commons-nd"></i>
                                        </div>
                                    </x-slot>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
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
                                    <option value="">Seleccione un tipo</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" data-precio="{{ $tipo->precio }}" data-categoria-id="{{ $tipo->id_categoria }}">{{ $tipo->nombre }}</option>
                                        {{-- <option value="{{ $tipo->id }}" data-categoria-id="{{ $tipo->id_categoria }}">{{ $tipo->nombre }}</option> --}}
                                    @endforeach
                                </x-adminlte-select2>
                            </div>
                            <div class="col-2">
                                {{-- With prepend slot --}}
                                <x-adminlte-input name="precio" label="Precio" placeholder="precio.." label-class="text-lightblue" igroup-size="sm">
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


                    <x-adminlte-button type="submit" theme="primary" label="Guardar" icon="fas fa-save"/>

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
