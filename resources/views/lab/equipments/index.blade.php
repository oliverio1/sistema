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
                                <h4>Equipos</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear equipos')
                                    <a class="btn btn-primary float-right" href="{{ route('equipments.create') }}">Nuevo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de equipos</h3>
                        <hr>
                        <table id="equipments" class="table table-hover table-striped">
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
                                @foreach ($equipments as $equipment)
                                    <tr>
                                        <td>{{ $equipment->code }}</td>
                                        <td>{{ $equipment->name }}</td>
                                        <td>{{ $equipment->brand }}</td>
                                        <td>{{ $equipment->serie }}</td>
                                        <td>{{ $equipment->created_at }}</td>
                                        <td>
                                            @if($equipment->status)
                                                <form action="{{ route('equipments.deactivate', $equipment->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('equipments.label', [$equipment->id]) }}" class='btn btn-secondary btn-sm'><i class="fa fa-tag"></i></a>
                                                    <a href="{{ route('equipments.show', [$equipment->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @if($equipment->daily || $equipment->weekly || $equipment->monthly || $equipment->quarterly || $equipment->biannual || $equipment->annual)
                                                        @can('Registrar mantenimientos')
                                                            <a href="{{ route('equipments.maintenance', [$equipment->id]) }}" class='btn btn-success btn-sm'><i class="fa fa-list"></i></a>
                                                        @endcan
                                                    @endif
                                                    @can('Editar equipos')
                                                        <a href="{{ route('equipments.edit', [$equipment->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar equipos')
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                                    @endcan
                                                </form>
                                            @else
                                                <form action="{{ route('equipments.activate', $equipment->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('equipments.show', [$equipment->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Editar equipos')
                                                        <a href="{{ route('equipments.edit', [$equipment->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar equipos')
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
            $('#equipments').DataTable({
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