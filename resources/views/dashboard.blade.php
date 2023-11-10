@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h3>¡Hola! {{ auth()->user()->name }} 👋 Bienvenido a LegalStudy</h3>
    <div class="container">

    {{-- Layout Classic / Custom --}}
    <x-adminlte-profile-widget name="{{ auth()->user()->name }}" desc="{{ auth()->user()->adminlte_desc() }}" class="elevation-4"
        img="{{ auth()->user()->adminlte_image() }}" cover="https://picsum.photos/550/200"
        layout-type="classic" header-class="text-right" footer-class="bg-gradient-primary">
        <x-adminlte-profile-col-item class="border-right text-dark" icon="fas fa-lg fa-tasks"
            title="Projects Done" text="25" size=6 badge="lime"/>
        <x-adminlte-profile-col-item class="text-dark" icon="fas fa-lg fa-tasks"
            title="Projects Pending" text="5" size=6 badge="danger"/>
        <x-adminlte-profile-row-item title="Contact me on:" class="text-center text-dark border-bottom"/>
        <x-adminlte-profile-row-item icon="fab fa-fw fa-2x fa-instagram text-dark" title="Instagram"
            url="#" size=4/>
        <x-adminlte-profile-row-item icon="fab fa-fw fa-2x fa-facebook text-dark" title="Facebook"
            url="#" size=4/>
        <x-adminlte-profile-row-item icon="fab fa-fw fa-2x fa-twitter text-dark" title="Twitter"
            url="#" size=4/>
    </x-adminlte-profile-widget>
    </div>
    <div class="container">
        {{-- Minimal with title, text and icon --}}
    <x-adminlte-small-box title="Title" text="some text" icon="fas fa-star"/>
        <div class="row">
            <div class="col">
                {{-- Loading --}}
                <x-adminlte-small-box title="Loading" text="Loading data..." icon="fas fa-chart-bar"
                    theme="info" url="#" url-text="More info" loading/>

            </div>
            <div class="col">
                {{-- Themes --}}
                <x-adminlte-small-box title="424" text="Views" icon="fas fa-eye text-dark"
                    theme="teal" url="#" url-text="View details"/>

            </div>
            <div class="col">
                <x-adminlte-small-box title="Downloads" text="1205" icon="fas fa-download text-white"
                    theme="purple"/>

            </div>
            <div class="col">
                <x-adminlte-small-box title="{{$counter}}" text="User Registrations" icon="fas fa-user-plus text-teal"
                    theme="primary" url="#" url-text="View all users"/>

            </div>
        </div>
    </div>





{{-- Updatable --}}
<x-adminlte-small-box title="0" text="Reputation" icon="fas fa-medal text-dark"
    theme="danger" url="#" url-text="Reputation history" id="sbUpdatable"/>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>

    $(document).ready(function() {

        let sBox = new _AdminLTE_SmallBox('sbUpdatable');

        let updateBox = () =>
        {
            // Stop loading animation.
            sBox.toggleLoading();

            // Update data.
            let rep = Math.floor(1000 * Math.random());
            let idx = rep < 100 ? 0 : (rep > 500 ? 2 : 1);
            let text = 'Reputation - ' + ['Basic', 'Silver', 'Gold'][idx];
            let icon = 'fas fa-medal ' + ['text-primary', 'text-light', 'text-warning'][idx];
            let url = ['url1', 'url2', 'url3'][idx];

            let data = {text, title: rep, icon, url};
            sBox.update(data);
        };

        let startUpdateProcedure = () =>
        {
            // Simulate loading procedure.
            sBox.toggleLoading();

            // Wait and update the data.
            setTimeout(updateBox, 2000);
        };

        setInterval(startUpdateProcedure, 10000);
    })

</script>
@stop
