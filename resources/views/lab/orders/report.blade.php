@extends('layouts.app')

@section('title', 'Reporte')

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
                                <h4>Reporte de resultados</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5>Datos del paciente</h5>
                        <table class="table">
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $order->clave }} {{ $order->name }} {{ $order->pat }} {{ $order->mat }}</td>
                                <th>Sexo</th>
                                <td>{{ $order->sex }}</td>
                            </tr>
                            <tr>
                                <th>Edad</th>
                                <td>{{ $order->age }} años</td>
                                <th>Médico</th>
                                @if($order->medic == null)
                                    <td>A quien corresponda</td>
                                @else
                                    <td>{{ $order->medic->name }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Teléfono</th>
                                <td>{{ $order->phone }}</td>
                                <th>Correo electrónico</th>
                                <td>{{ $order->mail }}</td>
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
                <div class="card">
                    {!! Form::open(['route' => 'orders.storeresults', 'class' => "needs-validation", 'novalidate']) !!}
                        <div class="card-header">
                            <h4 class="text-center">Reporte de resultados de: {{ $study->name }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table" id="resultados">
                                <tr>
                                    <th>ID</th>
                                    <th>Analito</th>
                                    <th>Resultado</th>
                                    <th>Valores de referencia</th>
                                </tr>
                                @foreach($reports as $report)
                                    <tr>
                                        @if($report->analito == 'NA')
                                            <td class="bg-light"></td>
                                            <td colspan="4" class="bg-light">
                                                <strong>{{ $report->text }}</strong>
                                                <input type="hidden" name="results[{{ $loop->iteration }}][resultado]" class="form-control" value="0">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][alert]" class="form-control" value="0">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][orden]" class="form-control" value="{{ $report->orden }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][analito_id]" class="form-control" value="0">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][min]" class="form-control" value="0">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][max]" class="form-control" value="0">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][analito]" class="form-control" value="{{ $report->analito }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][text]" class="form-control" value="{{ $report->text ? $report->text : '0' }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][units]" class="form-control" value="{{ $report->units ? $report->units : '0' }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][order_id]" class="form-control" value="{{ $order->id }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][study_id]" class="form-control" value="{{ $study->id }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][order_study_id]" class="form-control" value="{{ $order_study_id }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][user_id]" class="form-control" value="{{ Auth::user()->id }}">
                                                <input type="hidden" id="ordenestudio" name="ordenestudio" value="{{ $order_study_id }}" />
                                            </td>
                                        @else
                                            <td>{{ chr(65 + $report->orden) }}</td>
                                            <td>{{ $report->analito }}</td>
                                            <td>
                                                <input type="text" name="results[{{ $loop->iteration }}][resultado]" class="form-control" id="{{ chr(65+$report->orden) }}" oninput="buscarFilaEnTabla()" 
                                                    onchange="revisar(this.value,'{{ $report->min }}','{{ $report->max }}','{{chr(65+$report->orden)}}')" required='required'>
                                                <div class="invalid-feedback">
                                                Ingrese el resultado del estudio
                                                </div>
                                                <input type="hidden" name="results[{{ $loop->iteration }}][alert]" class="form-control" id="alert{{ chr(65+$report->orden) }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][orden]" class="form-control" value="{{ $report->orden }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][analito_id]" class="form-control" value="{{ $report->ar_id }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][study_report_id]" class="form-control" value="{{ $report->sr_id }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][min]" class="form-control" id="min{{ chr(65+$report->orden) }}" value="{{ $report->min }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][max]" class="form-control" id="max{{ chr(65+$report->orden) }}" value="{{ $report->max }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][analito]" class="form-control" value="{{ $report->analito }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][text]" class="form-control" value="{{ $report->referencia }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][units]" class="form-control" value="{{ $report->units }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][order_id]" class="form-control" value="{{ $order->id }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][study_id]" class="form-control" value="{{ $study->id }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][order_study_id]" class="form-control" value="{{ $order_study_id }}">
                                                <input type="hidden" name="results[{{ $loop->iteration }}][user_id]" class="form-control" value="{{ Auth::user()->id }}">
                                                <input type="hidden" id="orden_id" name="orden_id" value="{{ $order->id }}" />
                                                <input type="hidden" id="ordenestudio" name="ordenestudio" value="{{ $order_study_id }}" />
                                            </td>
                                            <td>{{ $report->referencia }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr> 
                                    <td colspan="3"><input type="textarea" name="observaciones" class="form-control" placeholder="Observaciones"></td>
                                </tr>
                            </table>
                            <div class="pl-4 pr-4">
                                <label for="formFile" class="form-label">Anexos</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('orders.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                {!! Form::close() !!}
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
        function revisar(resultado,min,max,loop) {
            console.log(resultado,min,max,loop);
            var res = parseFloat(resultado);
            var mi = parseFloat(min);
            var ma = parseFloat(max);
            var alert = '';
            if(res < mi) {
                alert = 'B';
                document.getElementById(loop).classList.add('text-danger');
                // $('#resultado'+loop).addClass('text-danger');
            } else if(res > ma) {
                alert = 'A';
                document.getElementById(loop).classList.add('text-danger');
                // $('#resultado'+loop).addClass('text-danger');
            } else {
                alert = 'C';
                document.getElementById(loop).classList.remove('text-danger');
                // $('#resultado'+loop).removeClass('text-danger');
            }
            // return $('#alert'+loop).val(alert);
            return document.getElementById('alert'+loop).value = alert;
        }
    </script>
    <script>
        var formulas = {!! json_encode($formulas) !!};
        const f = Object.values(formulas);
        window.onload = function verificarCampos() {
            for(let i = 0; i < formulas.length; i++) {
                const item = formulas[i];
                const analitoBuscado = item.analito;
                for(let j = 0; j < analitoBuscado.length; j++) {
                    const analito = analitoBuscado[j];
                    document.getElementById(analito).readOnly = true;
                }
            }
        }

        function buscarFilaEnTabla() {
            const tabla = document.getElementById('resultados');
            for(let i = 0; i < formulas.length; i++) {
                const item = formulas[i];
                const analitoBuscado = item.analito;
                const decimal = item.decimales;
                const form = item.formula;
                for(let j = 0; j < tabla.rows.length; j++) {
                    const fila = tabla.rows[j];
                    const valorCelda = fila.cells[0].innerText;
                    if(valorCelda === analitoBuscado) {
                        let resultado = item.formula;
                        const regex = /[A-Za-z]/g;
                        const variables = item.formula.match(regex);
                        for(let k = 0; k < variables.length; k++) {
                            const variable = variables[k];
                            const valor = parseFloat(document.getElementById(variable).value);
                            resultado = resultado.replace(new RegExp(variable,"g"),valor);
                            const res = eval(resultado);
                            const red = res.toFixed(decimal);
                            if(!isNaN(red)) {
                                document.getElementById(analitoBuscado).value = red;
                                const min = document.getElementById('min'+analitoBuscado).value;
                                const max = document.getElementById('max'+analitoBuscado).value;
                                revisar(red,min,max,analitoBuscado);
                            }
                        }
                    } else {
                    }
                }
            }
        }
    </script>
@endsection