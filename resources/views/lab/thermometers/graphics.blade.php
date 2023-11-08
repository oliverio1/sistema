@extends('layouts.app')

@section('title', 'Termómetros')

@section('content')
    @if(session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>{{ session('info') }}</strong>
        </div>    
    @endif
    <div class="content px-3">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Gráfico de temperaturas</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('thermometers.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_css')
@endsection

@section('page_scripts')
<script>
    var labels =  {{ Js::from($days) }};
    var temperature1 =  {{ Js::from($temperature1) }};
    var temperature2 =  {{ Js::from($temperature2) }};
    var temperature3 =  {{ Js::from($temperature3) }};
    var min = {{ Js::from($min) }};
    var MinArray = new Array(temperature1.length).fill(min);
    var max = {{ Js::from($max) }};
    var MaxArray = new Array(temperature1.length).fill(max);

    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Curva de temperaturas matutinas',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                borderColor: "red",
                data: temperature1,
                tension: 0.2
            },
            {
                label: 'Curva de temperaturas a medio día',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                borderColor: "green",
                data: temperature2,
                tension: 0.2
            },
            {
                label: 'Curva de temperaturas nocturnas',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                borderColor: "blue",
                data: temperature3,
                tension: 0.2
            },
            {
                label: 'Temperatura mínima',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                borderColor: "black",
                data: MinArray,
                tension: 0.2
            },
            {
                label: 'Temperatura máxima',
                backgroundColor: 'rgba(0, 0, 0, 0)',
                borderColor: "black",
                data: MaxArray,
                tension: 0.2
            },
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                            display: true,
                            labelString: 'Día'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                            display: true,
                            labelString: 'Temperatura ( °C )'
                    }
                }]
            },
            annotation: {
            annotations: [
                {
                type: "line",
                mode: "vertical",
                scaleID: "x-axis-0",
                borderColor: "red",
                label: {
                    content: "",
                    enabled: true,
                    position: "top"
                }
                }
            ]
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
@endsection