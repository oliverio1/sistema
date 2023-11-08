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
                                <h3>Detalle del termómetro</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row m-2">
                            <div class="col-md-7 col-lg-7">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Código:</th>
                                            <td>{{ $thermometer->code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nombre:</th>
                                            <td>{{ $thermometer->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Marca:</th>
                                            <td>{{ $thermometer->brand }}</td>
                                        </tr>
                                        <tr>
                                            <th>Modelo:</th>
                                            <td>{{ $thermometer->model }}</td>
                                        </tr>
                                        <tr>
                                            <th># de serie:</th>
                                            <td>{{ $thermometer->serie }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-5 col-lg-5"> 
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Calibración:</th>
                                            <td>
                                                {{ $thermometer->calibration }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Expediente:</th>
                                            <td>
                                                <a href="{{ asset('termometros/files/'. $thermometer->file ) }}">{{ $thermometer->file }}</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @can('Configurar temperaturas')
                                    <a class="btn btn-secondary btn-block" href="{{ route('thermometers.registertemperature', $thermometer->id) }}">Configuración de temperaturas</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('thermometers.index') }}" class="btn btn-danger btn-block">Volver</a>
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