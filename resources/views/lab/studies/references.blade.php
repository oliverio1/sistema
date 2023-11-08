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
                                <h4>Valores de referencia</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(!$study->reports->count() > 0)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <h4 class="m-3">No se ha configurado el reporte de resultado</h4>
                                        <hr>
                                        <div class="clearfix m-3">
                                            <span>Diseña el reporte de resultados</span>    
                                            @can('Configurar reporte')
                                                <a href="{{ route('studies.report', [$study->id]) }}" class='btn btn-info float-right'>Configurar reporte</a>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('studies.index') }}" class="btn btn-secondary btn-block">Volver</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div>
                                @livewire('references', ['study_id' => $study->id])
                            </div>
                        @endif
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