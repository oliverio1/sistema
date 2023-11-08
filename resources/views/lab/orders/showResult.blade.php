@extends('layouts.app')

@section('title', 'Resultados')

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
                    <div class="row m-3">
                        <div class="col-sm-12">
                            <h5>Datos del paciente</h5>
                            <table class="table">
                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ $order->clave }} {{ $order->nombre }} {{ $order->ap_pat }} {{ $order->ap_mat }}</td>
                                    <th>Sexo</th>
                                    <td>{{ $order->sexo }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de nacimiento (Edad)</th>
                                    <td> {{ $order->birthday }} ({{ $order->edad }} años)</td>
                                    <th>Médico</th>
                                    @if($order->medic == null)
                                        <td>A quien corresponda</td>
                                    @else
                                        <td>{{ $order->medic->name }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>Teléfono</th>
                                    <td>{{ $order->telefono }}</td>
                                    <th>Correo electrónico</th>
                                    <td>{{ $order->correo }}</td>
                                </tr>
                            </table>
                            <h5>Datos del cliente</h5>
                            <table class="table">
                                <tr>
                                    <th>Cliente</th>
                                    <td>{{ $order->client->name }}</td>
                                    <th></th>
                                    <td></td>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Contacto</th>
                                    <td>{{ $order->client->contact }}</td>
                                    <th>Teléfono</th>
                                    <td>{{ $order->client->office_phone }}</td>
                                    <th>Correo</th>
                                    <td>{{ $order->client->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    {!! Form::open(['route' => 'orders.storeresults', 'class' => "needs-validation", 'novalidate']) !!}
                        <div class="card-header">
                            <h4 class="text-center">Resultados de resultados de: {{ $study->name }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="33%">Analito</th>
                                        <th width="33%">Resultado</th>
                                        <th width="33%">Valores de referencia</th>
                                    </tr>
                                </thead>
                                @foreach($results as $result)
                                    @if($result->analito != 'NA')
                                        <tr>
                                            <td>{{ $result->analito }}</td>
                                                @if($result->alert == 'C')
                                                    <td>{{ $result->resultado }} {{ $result->units }}</td>
                                                @elseif($result->alert == 'A')
                                                    <td class="text-danger">{{ $result->resultado }} {{ $result->units }}<i class="fa fa-arrow-up"></i></td>
                                                @else
                                                    <td class="text-danger">{{ $result->resultado }} {{ $result->units }}<i class="fa fa-arrow-down"></i></td>
                                                @endif
                                            <td>{{ $result->min }} - {{ $result->max }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="3"><strong>{{ $result->text }}</strong></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="p-3">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-block">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_css')
@endsection

@section('page_scripts')
    <script>
        (function () {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')
        
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
        function revisar(resultado,min,max) {
            var res = parseFloat(resultado);
            var mi = parseFloat(min);
            var ma = parseFloat(max);
            var alert = '';
            if(res < mi) {
                alert = 'B';
                $('#resultado').addClass('text-danger');
            } else if(res > ma) {
                alert = 'A';
                $('#resultado').addClass('text-danger');
            } else {
                alert = 'C';
                $('#resultado').removeClass('text-danger');
            }
            return $('#alert').val(alert);
        }
    </script>
@endsection