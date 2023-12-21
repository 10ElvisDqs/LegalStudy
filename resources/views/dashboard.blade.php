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
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                 <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">
                            10
                            <small>%</small>
                        </span>
                    </div>
                
                </div>
            
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number">{{$canClient}}</span>
                    </div>
                
                </div>
            
            </div>
            
            
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Dinero</span>
                        <span class="info-box-number">{{$totalPreciosCasos}}</span>
                    </div>
            
                </div>
            
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Usuarios</span>
                        <span class="info-box-number">{{$counter}}</span>
                    </div>
                
                </div>
            </div>
            
        </div>
        <div class="row">
            <div style="width:75%;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        {{-- Minimal with title, text and icon --}}
        <div class="row">
            <div class="col-2">
                <div>
                    <label for="mesSeleccionado">Selecciona un mes:</label>
                    <select id="mesSeleccionado" onchange="actualizarGrafico()">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Nobiembre</option>
                        <option value="12">Diciembre</option>
                        <!-- Agrega los demás meses según sea necesario -->
                    </select>
                </div>
            </div>
            <div class="col-4">
                <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <canvas id="casosPorMesChart" width="400" height="200"></canvas>
            </div>
        </div>
    







@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
{{-- Por MEs --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar el gráfico con el mes predeterminado (por ejemplo, enero)
        actualizarGrafico();
    });

    function actualizarGrafico() {
        var mesSeleccionado = document.getElementById('mesSeleccionado').value;

        axios.get('/casos-por-mes/' + mesSeleccionado)
            .then(function (response) {
                if (response.data.length > 0) {
                    var datasets = response.data.reduce(function (acc, item) {
                        var tipoIndex = acc.findIndex(function (dataset) {
                            return dataset.label === item.tipo;
                        });

                        var color = getRandomColor(); // Función para obtener un color aleatorio

                        if (tipoIndex === -1) {
                            acc.push({
                                label: item.tipo,
                                data: [item.cantidad],
                                backgroundColor: color,
                                borderColor: color,
                                borderWidth: 1
                            });
                        } else {
                            acc[tipoIndex].data.push(item.cantidad);
                        }

                        return acc;
                    }, []);

                    var ctx = document.getElementById('casosPorMesChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.data.map(function (item) {
                                return item.tipo;
                            }),
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } else {
                    // Si no hay datos para el mes seleccionado, limpiar el gráfico
                    var ctx = document.getElementById('casosPorMesChart').getContext('2d');
                    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
                }
            })
            .catch(function (error) {
                console.error('Error al obtener datos:', error);
            });
    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>
{{--  --}}
<script>
    var data = @json($formattedData);

    var labels = Object.keys(data);
    var datasets = [{
        label: 'Cantidad de Casos',
        data: Object.values(data),
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
    }];

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tipo de Caso'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad de Casos'
                    }
                }
            }
        }
    });
</script>

<script>
    console.log(@json($formattedData));
</scrip>



<script src="plugins/jquery/jquery.min.js"></>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js?v=3.2.0"></script>
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard2.js"></script>
@stop
