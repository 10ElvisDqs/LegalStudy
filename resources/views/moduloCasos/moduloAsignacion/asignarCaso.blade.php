
@extends('adminlte::page')

@section('title', 'Asignar Caso')

@section('content_header')
    <h1>Asignacion de Casos</h1>
@stop
{{-- @section('plugins.BootstrapSlider', true) --}}
@section('plugins.TempusDominusBs4', true)
@section('plugins.DateRangePicker', true)
@section('content')


<div class="container rounded border p-3 shadow">
    <div class="card-header">
        {{-- @foreach ($users as $user)
        
        @if($user->hasRole('Abogado'))
        <x-adminlte-input name="iUser" label="User" placeholder="{{$user->name}}" label-class="text-lightblue">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        @endif

        @endforeach  --}}
        
    </div>
    <div class="card body p-1">
        <form action="{{route('asignarcaso.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-1">
                    <x-adminlte-input name="id_abogado" label="Id" placeholder="" label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-hashtag text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-4">
                    
                    <x-adminlte-input name="iUser" label="User" placeholder="" label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    
                </div>
                <div class="col-2">
                    <x-adminlte-input name="id_caso" label="Id Caso" placeholder="ingrese en id del caso" label-class="text-lightblue">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-file text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                </div>
                <div class="col-2">
                    {{-- Placeholder, date only and append icon --}}
                    @php
                    $config = ['format' => 'YYYY-MM-DD'];
                    @endphp
                    <x-adminlte-input-date name="fecha_asignacion" :config="$config" label="Fecha Asignacion" placeholder="Choose a date..." label-class="text-lightblue" {{--igroup-size="sm"--}}>
                        <x-slot name="appendSlot">
                            <div class="input-group-text  bg-gradient-blue">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>
                <div class="col-2">
                    {{-- Placeholder, date only and append icon --}}
                    {{-- @php
                    $config = ['format' => 'YYYY-MM-DD'];
                    @endphp --}}
                    <x-adminlte-input-date name="fecha_desasignacion" :config="$config" label="Fecha de Desasignacion" placeholder="Choose a date..." label-class="text-lightblue" {{--igroup-size="sm"--}}>
                        <x-slot name="appendSlot">
                            <div class="input-group-text  bg-gradient-blue">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>
                <div class="col-2">
                    
                    
                </div>
                <div class="col-2">
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    {{-- Example with empty option (for Select2) --}}
                    

                    <x-adminlte-select2 name="rol_abogado" label="Rol del Abogado" label-class="text-lightblue"
                        igroup-size="sm" data-placeholder="Seleccione una opción...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fab fa-creative-commons-nd"></i>
                            </div>
                        </x-slot>
                        <option value="">Seleccione un tipo</option>
                            <option value="Abogado Principal" >Abogado Principal</option>
                            <option value="Asistente" >Asistente</option>
                            <option value="Consultor" >Consultor</option>

                    </x-adminlte-select2>

                </div>
                <div class="col-2">
                    <x-adminlte-select2 name="estado" label="Estado" label-class="text-lightblue"
                        igroup-size="sm" data-placeholder="Seleccione una opción...">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-gradient-info">
                                <i class="fab fa-creative-commons-nd"></i>
                            </div>
                        </x-slot>
                        <option value="">Seleccione un tipo</option>
                            <option value="activo" >Activo</option>
                            <option value="inactivo" >Inactivo</option>
                            <option value="completado" >Completado</option>

                    </x-adminlte-select2>
                </div>
                <div class="col-2">
                    <x-adminlte-input id="horasTrabajadas" igroup-size="sm"  type="number" step="0.01"  name="iUser" label="Horas Trabajadas" placeholder="0.0" label-class="text-lightblue" value="0.0">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-hourglass-half text-lightblue"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                 
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/> 
                </div>
                <div class="col-3">
              
                </div>
                <div class="col-3">
                    {{-- Minimal --}}

                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <h2>Abogados</h2>
        <div class="container rounded border p-3 shadow">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($users as $index => $user)
                        @if($user->hasRole('Abogado'))
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                        @endif
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($users as $index => $user)
                        @if($user->hasRole('Abogado'))
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-user-id="{{ $user->id }}">
                                {{-- <div class="carousel-caption d-none d-md-block bg-primary">
                                    <h5>Slide {{ $index + 1 }} label</h5>
                                    <p>Some representative placeholder content for slide {{ $index + 1 }}.</p>
                                </div> --}}
                                <h5 class="abogado-name">{{ $user->name }}</h5>
                                <x-adminlte-profile-widget  name="{{ $user->name }}" desc=" {{ $user->getRoleNames()->implode(', ') }}" theme="primary"
                                    img="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ29ghns4nBQ1f7fOYcPyzd8IsAGOzybKieZQ&usqp=CAU">
                                    <x-adminlte-profile-col-item class="text-primary border-right" icon="fas fa-lg fa-gift"
                                        title="Sales" text="25" size=6 badge="primary"/>
                                    <x-adminlte-profile-col-item class="text-danger" icon="fas fa-lg fa-users" title="Dependents"
                                        text="10" size=6 badge="danger"/>
                                </x-adminlte-profile-widget>
                            </div>
                        @endif
                    @endforeach
                    
                
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div> 
        </div>
    </div>
    <div class="col-8">
        <h2>Lista de Casos</h2>
        <div class="container rounded border p-3 shadow">
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
                <x-adminlte-datatable id="table1" :heads="$heads"  head-theme="dark" :config="$config" striped hoverable >
                    @foreach($casos as $caso)
                        <tr>
                           <td class="bg-blue text-light">{{ $caso->id}}</td>
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
                         
                        </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>


        </div>
        
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
{{-- <script>
    $(document).ready(function() {
        $('#carouselExampleCaptions').on('slid.bs.carousel', function () {
            var activeSlide = $('.carousel-item.active');
            var abogadoName = activeSlide.find('.abogado-name').text();
            $('input[name="iUser"]').val(abogadoName);
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        $('#carouselExampleCaptions').on('slid.bs.carousel', function () {
            var activeSlide = $('.carousel-item.active');
            var abogadoId = activeSlide.data('user-id'); // Asegúrate de tener este atributo en el carrusel
            $('#userInput').attr('id', 'user_' + abogadoId); // Actualiza dinámicamente el ID del input
            var abogadoName = activeSlide.find('.abogado-name').text();
            //var inputValue = abogadoName + ' (ID: ' + abogadoId + ')';
            var inputValue = abogadoName;
        console.log(inputValue+abogadoId);
            $('input[name="iUser"]').val(inputValue);
            $('input[name="id_abogado"]').val(abogadoId);

        });
    });
</script>

@stop
