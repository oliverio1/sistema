@extends('layouts.app')

@section('title', 'Incidencias')

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
                                <h4>Incidencias</h4>
                            </div>
                            <div class="col-sm-6">
                                {!! Form::open(['route' => 'incidents.reports']) !!}
                                    @can('Descargar incidencias')
                                        {!! Form::submit('Descargar reporte de incidencias', ['class' => 'btn btn-primary float-right ml-2']) !!}
                                    @endcan
                                {{ Form::close() }}
                                @can('Crear incidencias')
                                    <a class="btn btn-primary float-right" href="{{ route('incidents.create') }}">Nuevo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de incidencias</h3>
                        <hr>
                        <table id="incidents" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Nombre de quien genera</th>
                                    <th>Descripción</th>
                                    <th>Estatus</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($incidents as $incident)
                                    @if($incident->status == 'Pendiente')
                                        <tr class="table-danger">
                                            <td>{{ $incident->id }}</td>
                                            <td>{{ $incident->client->name }}</td>
                                            <td>{{ $incident->name }}</td>
                                            <td>{{ $incident->description }}</td>
                                            <td>{{ $incident->status }}</td>
                                            <td>
                                                <a href="{{ route('incidents.show', [$incident->id]) }}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                                                @can('Editar incidencias')
                                                    <a href="{{ route('incidents.edit', [$incident->id]) }}" class='btn btn-secondary btn-xs'><i class="far fa-edit"></i></a>
                                                @endcan
                                                @can('Eliminar incidencias')
                                                    <a href="{{ route('incidents.report', [$incident->id]) }}" class='btn btn-primary btn-xs'><i class="fa fa-file-pdf"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @elseif($incident->status == 'En proceso')
                                        <tr class="table-warning">
                                            <td>{{ $incident->id }}</td>
                                            <td>{{ $incident->client->name }}</td>
                                            <td>{{ $incident->name }}</td>
                                            <td>{{ $incident->description }}</td>
                                            <td>{{ $incident->status }}</td>
                                            <td>
                                                <a href="{{ route('incidents.show', [$incident->id]) }}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                                                @can('Editar incidencias')
                                                    <a href="{{ route('incidents.edit', [$incident->id]) }}" class='btn btn-secondary btn-xs'><i class="far fa-edit"></i></a>
                                                @endcan
                                                <a href="{{ route('incidents.report', [$incident->id]) }}" class='btn btn-primary btn-xs'><i class="fa fa-file-pdf"></i></a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-success">
                                            <td>{{ $incident->id }}</td>
                                            <td>{{ $incident->client->name }}</td>
                                            <td>{{ $incident->name }}</td>
                                            <td>{{ $incident->description }}</td>
                                            <td>{{ $incident->status }}</td>
                                            <td>
                                                <a href="{{ route('incidents.show', [$incident->id]) }}" class='btn btn-info btn-xs'><i class="far fa-eye"></i></a>
                                                @can('Editar incidencias')
                                                    <a href="{{ route('incidents.edit', [$incident->id]) }}" class='btn btn-secondary btn-xs'><i class="far fa-edit"></i></a>
                                                @endcan
                                                <a href="{{ route('incidents.report', [$incident->id]) }}" class='btn btn-primary btn-xs'><i class="fa fa-file-pdf"></i></a>
                                            </td>
                                        </tr>
                                    @endif
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
            $('#incidents').DataTable({
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