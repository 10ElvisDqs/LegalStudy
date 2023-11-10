@section('estilos')
    <style>
        .img-circle {
            border-radius: 50%; /* Hace que la imagen sea circular */
        }

        .img-tamano {
            width: 50px; /* Establece el ancho deseado */
            height: 50px; /* Establece la altura deseada */
            object-fit: cover; /* Ajusta la imagen dentro del círculo */
        }
    </style>
@endsection

@extends('adminlte::auth.login')
