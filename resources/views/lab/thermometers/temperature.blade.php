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
                                <h3>Registro de temperaturas</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($thermometer, ['route' => ['thermometers.temperaturestore', $thermometer->id]]) !!}
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                {!! Form::label('type', 'Hora de registro de temperatura:') !!}
                                {!! Form::select('type', ['first' => 'Mañana', 'second' => 'Medio día', 'third' => 'Noche'], null, array('class' => 'form-control')) !!}
                                {!! Form::hidden('termometro_id', $thermometer->id) !!}
                                <div class="invalid-feedback">
                                    Seleccione la hora de registro
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                {!! Form::label('temperature', 'Temperature:') !!}
                                {!! Form::text('temperature', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese la temperatura
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('thermometers.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                {!! Form::close() !!}
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Descarga de reporte</h4>
                        <hr>
                        {!! Form::open(['route' => 'thermometers.temperaturereport']) !!}
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    {!! Form::label('month', 'Fecha del reporte') !!}
                                    {!! Form::month('month', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    {!! Form::hidden('termometro_id', $thermometer->id) !!}
                                    <div class="invalid-feedback">
                                        Seleccione el mes que desea descargar
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    {!! Form::submit('Descargar', ['class' => 'btn btn-primary btn-block']) !!}
                                </div>
                            </div>
                        {{ Form::close() }}
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
        $(document).ready(function () {
            $('#thermometers').DataTable({
                dom: '<"area-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
                "columnDefs": [
                    { "type": "num", "targets": 0 }
                ],
                "order": [[ 0, "asc" ]],
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ],
                language: {
                    url: '/datatables.json'
                }
            });
        });
    </script>
@endsection