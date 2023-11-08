@extends('layouts.app')

@section('title', 'Equipos')

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
                                <h3>Detalle del equipo</h3>
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
                                            <td>{{ $equipment->code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nombre:</th>
                                            <td>{{ $equipment->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Marca:</th>
                                            <td>{{ $equipment->brand }}</td>
                                        </tr>
                                        <tr>
                                            <th>Modelo:</th>
                                            <td>{{ $equipment->model }}</td>
                                        </tr>
                                        <tr>
                                            <th># de serie:</th>
                                            <td>{{ $equipment->serie }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-5 col-lg-5"> 
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Primer mantenimiento:</th>
                                            <td>
                                                {{ $equipment->prevent1 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Segundo mantenimiento:</th>
                                            <td>
                                                {{ $equipment->prevent2 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Expediente:</th>
                                            <td>
                                                <a href="{{ asset('equipos/files/'. $equipment->file ) }}">{{ $equipment->file }}</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @can('Configurar mantenimientos')
                                    <a class="btn btn-secondary btn-block" href="{{ route('equipments.registermaintenance', $equipment->id) }}">Configuración de mantenimientos</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('equipments.index') }}" class="btn btn-danger btn-block">Volver</a>
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
            $('#areas').DataTable({
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