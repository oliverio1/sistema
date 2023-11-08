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
                                <h4>Estudios</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear estudios')
                                    <a class="btn btn-primary float-right" href="{{ route('profiles.create') }}"> Nuevo perfil</a>
                                    <a class="btn btn-primary float-right mr-2" href="{{ route('studies.create') }}"> Nuevo estudio</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de estudios</h3>
                        <hr>
                        <table id="studies" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Contenedor</th>
                                    <th>Tipo de muestra</th>
                                    <th>Indicaciones</th>
                                    <th>Tiempo de entrega (DH)</th>
                                    <th>Precio</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studies as $study)
                                    <tr>
                                        <td>{{ $study->id }}</td>
                                        <td>{{ $study->name }}</td>
                                        <td>
                                            <ul style="list-style-type:none;">
                                                @foreach($study->containers as $container)
                                                    <li>{{ $container->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul style="list-style-type:none;">
                                                @foreach($study->specimens as $specimen)
                                                    <li>{{ $specimen->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul style="list-style-type:none;">
                                                @foreach($study->indications as $indication)
                                                    <li>{{ $indication->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $study->delivery }}</td>
                                        <td>${{ $study->price }}</td>
                                        <td>
                                            @if($study->status)
                                                <form action="{{ route('studies.deactivate', $study->id) }}" method="POST">
                                                    @csrf
                                                    @if($study->type == 2)
                                                        <a href="{{ route('profiles.show', [$study->id]) }}" class='btn btn-primary btn-xs'><i class="fa fa-eye"></i></a>
                                                    @else
                                                        <a href="{{ route('studies.show', [$study->id]) }}" class='btn btn-primary btn-xs'><i class="fa fa-eye"></i></a>
                                                    @endif
                                                    @if($study->type == 2)
                                                        @can('Editar estudios')
                                                            <a href="{{ route('profiles.edit', [$study->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-edit"></i></a>
                                                        @endcan
                                                    @else
                                                        @can('Editar estudios')
                                                            <a href="{{ route('studies.edit', [$study->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-edit"></i></a>
                                                        @endcan
                                                    @endif
                                                    @can('Eliminar estudios')
                                                        <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
                                                    @endcan
                                                </form>
                                            @else
                                                <form action="{{ route('studies.activate', $study->id) }}" method="POST">
                                                    @csrf
                                                    @if($study->type == 2)
                                                        <a href="{{ route('profiles.show', [$study->id]) }}" class='btn btn-primary btn-xs'><i class="fa fa-eye"></i></a>
                                                    @else
                                                        <a href="{{ route('studies.show', [$study->id]) }}" class='btn btn-primary btn-xs'><i class="fa fa-eye"></i></a>
                                                    @endif
                                                    @if($study->type == 2)
                                                        @can('Editar estudios')
                                                            <a href="{{ route('profiles.edit', [$study->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-edit"></i></a>
                                                        @endcan
                                                    @else
                                                        @can('Editar estudios')
                                                            <a href="{{ route('studies.edit', [$study->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-edit"></i></a>
                                                        @endcan
                                                    @endif
                                                    @can('Eliminar estudios')
                                                        <button class="btn btn-success btn-xs" type="submit"><i class="fa fa-check"></i></button>
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