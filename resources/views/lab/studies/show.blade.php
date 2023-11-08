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
                                <h3>Detalle del estudio</h3>
                            </div>
                            <div class="col-sm-6">
                                @if($study->reports->count() > 0)
                                    <a class="btn btn-success float-right" href="{{ route('studies.report', [$study->id]) }}">Ver reporte de resultados</a>
                                @endif
                                @can('Configurar reporte')
                                    <a class="btn btn-info float-right" href="{{ route('studies.report', [$study->id]) }}">Configurar reporte de resultados</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-9">
                            <p><strong>Precio de lista:</strong></p>
                            <p>${{ $study->price }}</p>
                            <p><strong>Área de proceso:</strong></p>
                            <p>{{ $study->area->name }}</p>
                            <p><strong>Texto para etiqueta:</strong></p>
                            <p>{{ $study->label }}</p>
                            <p><strong>Tiempo de entrega:</strong></p>
                            <p>{{ $study->delivery }} días hábiles</p>
                            <p><strong>Tipo de muestra:</strong></p>
                            @foreach($study->specimens as $specimen)
                                <ul>
                                    <li>{{ $specimen->name }}</li>
                                </ul>
                            @endforeach   
                            <p><strong>Contenedores:</strong></p>
                            @foreach($study->containers as $container)
                                <ul>
                                    <li>{{ $container->name }}</li>
                                </ul>
                            @endforeach   
                            <p><strong>Indicaciones:</strong></p>
                            @foreach($study->indications as $indication)
                                <ul>
                                    <li>{{ $indication->name }}</li>
                                </ul>
                            @endforeach   
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('studies.index') }}" class="btn btn-danger btn-block">Volver</a>
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
            $('#studies').DataTable({
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