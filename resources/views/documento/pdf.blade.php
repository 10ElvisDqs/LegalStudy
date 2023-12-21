<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>documentos-pdf</title>

    <style>
        /* Estilo para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black;
            text-align: center;
            /* Alinea el texto a la izquierda */

        }

        h2 {
            text-align: center;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Estilo para los encabezados de la tabla */
        th {
            background-color: #7d884f;
            padding: 10px;
            border-radius: 10px; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Estilo para las celdas de la tabla */
        td {
            padding: 10px;
        }

        /* Estilo para las filas de la tabla al pasar el mouse sobre ellas */
        tr:hover {
            background-color: #f5f5f5;
        }
        table{
            border-collapse: collapse;
            border: none;
        }
        .borderRadius {
                border-radius: 10px; /* Puedes ajustar el valor según tu preferencia */
                background-color: blue;
            }

    </style>

</head>

<body>
    <img src="{{ asset('images/logo1.jpg') }}" alt="Texto alternativo del logo" class="img-fluid " style="width: 80px; height: 80px; ">
    <h2>DOCUMENTOS</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>FECHA</th>
            <th>CASO</th>
        </tr>
        @foreach($documentos as $documento)
        <tr>
            <td>{{$documento->id}}</td>
            <td>{{$documento->nombre}}</td>
            <td>{{$documento->descripcion}}</td>
            <td>{{$documento->fecha}}</td>
            <td>{{$documento->casos->titulo}}</td>
        </tr>

        @endforeach
    </table>
</body>



</html>