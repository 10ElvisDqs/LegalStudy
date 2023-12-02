<!-- Iterar sobre los datos directos -->
<h2>Datos directos:</h2>
<h1>{{$result}}</h1>
@foreach ($data as $key => $value)
    <p>{{ $key }}: {{ $value }}</p>
@endforeach
