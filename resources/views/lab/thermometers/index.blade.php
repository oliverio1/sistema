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
                                <h4>Termómetros</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear termometros')
                                    <a class="btn btn-primary float-right" href="{{ route('thermometers.create') }}">Nuevo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de termómetros</h3>
                        <hr>
                        <table id="thermometers" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Serie</th>
                                    <th>Recibido</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($thermometers as $thermometer)
                                    <tr>
                                        <td>{{ $thermometer->code }}</td>
                                        <td>{{ $thermometer->name }}</td>
                                        <td>{{ $thermometer->brand }}</td>
                                        <td>{{ $thermometer->serie }}</td>
                                        <td>{{ $thermometer->created_at }}</td>
                                        <td>
                                            @if($thermometer->status)
                                                <form action="{{ route('thermometers.deactivate', $thermometer->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('thermometers.label', [$thermometer->id]) }}" class='btn btn-secondary btn-sm'><i class="fa fa-tag"></i></a>
                                                    <a href="{{ route('thermometers.show', [$thermometer->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Registrar temperaturas')
                                                        <a href="{{ route('thermometers.temperature', [$thermometer->id]) }}" class='btn btn-success btn-sm'><i class="fa fa-list"></i></a>
                                                    @endcan
                                                    @can('Ver graficas')
                                                        <a href="{{ route('thermometers.graphics', [$thermometer->id]) }}" class='btn btn-info btn-sm'><i class="fa fa-line-chart"></i></a>
                                                    @endcan
                                                    @can('Editar termometros')
                                                        <a href="{{ route('thermometers.edit', [$thermometer->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar termometros')
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                                    @endcan
                                                </form>
                                            @else
                                                <form action="{{ route('thermometers.activate', $thermometer->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('thermometers.show', [$thermometer->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Editar termometros')
                                                        <a href="{{ route('thermometers.edit', [$thermometer->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar termometros')
                                                        <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i></button>
                                                    @endcan
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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