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
                                <h3>Configuración de temperaturas</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    {!! Form::model($thermometer, ['route' => ['thermometers.registertemperaturestore', $thermometer->id], 'method' => 'patch']) !!}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::hidden('termometro_id', $thermometer->id) !!}
                            </div>
                            <div class="form-group col-sm-6 col-lg-6">
                                {!! Form::label('min_temp', 'Temperatura mínima:') !!}
                                {!! Form::text('min_temp', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-6 col-lg-6">
                                {!! Form::label('max_temp', 'Temperatura máxima:') !!}
                                {!! Form::text('max_temp', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('thermometers.index') }}" class="btn btn-danger">Cancelar</a>
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