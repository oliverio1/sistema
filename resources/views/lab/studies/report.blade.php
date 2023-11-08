@extends('layouts.app')

@section('title', 'Estudios')

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
                                <h4>Configuración de reporte de resultados</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row m-2">
                            <div class="col-sm-6">
                                <h3>{{ $study->code }} - {{ $study->name }}</h3>
                            </div>
                            <div class="col-sm-6">
                                @can('Configurar valores')
                                    <a class="btn btn-info float-right" href="{{ route('studies.references', [$study->id]) }}">Configurar valores de referencia</a>
                                @endcan
                            </div>
                        </div>
                        <hr>
                        <div class="btn btn-block btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info" onclick="titulo('{{ $study->id }}')">Texto libre</button>
                            <button type="button" class="btn btn-info" onclick="variable('{{ $study->id }}')">Analito</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Formato de resultados</h3>
                    </div>
                    {!! Form::open(['route' => 'studies.storereport', 'class' => "needs-validation", 'novalidate']) !!}
                    {!! Form::hidden('study_id', $study->id, ['class' => 'form-control', 'required' => 'required']) !!}
                        <div class="card-body">
                            <table class="table table-hover table-striped" id="detalles">
                                <tr>
                                    <th>Eliminar</th>
                                    <th>Analito</th>
                                    <th>Unidades</th>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('studies.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card">
                    @if($study->reports->count() > 0)
                        <div class="class-header p-3">
                            <h3>Formato final</h3>
                            <hr>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th>Analito</th>
                                    <th>Unidades</th>
                                    <td><strong>Valores de referencia</strong><br/>(Sexo, edad, referencia)</td>
                                </tr>
                                @foreach($study->reports as $analito)
                                    <tr>
                                        @if($analito->analito == 'NA')
                                            <td colspan="3"><strong>{{ $analito->text }}</strong></td>
                                        @else
                                            <td>{{ $analito->analito }}</td>
                                            <td>{{ $analito->units }}</td>
                                            <td>
                                                @foreach($analito->references as $ref)
                                                    <ul>
                                                        <li>{{ $ref->sex }}, de {{ $ref->age_in }} a {{ $ref->age_fin }} años: {{ $ref->min }} - {{ $ref->max }} {{ $analito->units }}</li>
                                                    </ul>
                                                @endforeach
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_css')
@endsection

@section('page_scripts')
    <script>
        var cont = 0;
        var detalles = 0;
        function titulo(id) {
            var fila = '<tr class="filas" id="fila'+cont+'">'+
            '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
            '<td colspan="2"><input type="text" name="text[]" class="w-100">'+
            '<input type="hidden" name="units[]" value="NA">'+
            '<input type="hidden" name="analito[]" value="NA">'+
            '<input type="hidden" name="orden[]" value="'+cont+'">'+
            '</tr>';
            cont++;
            detalles++<
            $('#detalles').append(fila);
        }
        function variable(id) {
            var fila = '<tr class="filas" id="fila'+cont+'">'+
            '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
            '<td><input type="text" name="analito[]" required><div class="invalid-feedback"><strong>Este dato es obligatorio</strong></div></td>'+
            '<td><input type="text" name="units[]" required><div class="invalid-feedback"><strong>Este dato es obligatorio</strong></div>'+
            '<input type="hidden" name="orden[]" value="'+cont+'"></td>'+
            '<input type="hidden" name="text[]" value=""></td>'+
            '</tr>';
            cont++;
            detalles++<
            $('#detalles').append(fila);
        }
        function eliminarDetalle(indice) {
            $("#fila" + indice).remove();
            detalles = detalles - 1;
        }
    </script>
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
    </script>
@endsection