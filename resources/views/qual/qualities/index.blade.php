@extends('layouts.app')

@section('title', 'SGC')

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
                                <h4>Sistema de gestión de la calidad</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear calidad')
                                    <a class="btn btn-primary float-right" href="{{ route('qualities.create') }}">Nuevo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de documentos</h3>
                        <hr>
                        <table id="qualities" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Fecha de emisión</th>
                                    <th>Fecha de revisión</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($qualities as $quality)
                                    <tr>
                                        <td>{{ $quality->id }}</td>
                                        <td>
                                            <a href="/calidad/documents/{{ $quality->document }}" target="_blank">{{ $quality->name }}</a>
                                        </td>
                                        <td>{{ $quality->release_date }}</td>
                                        <td>{{ $quality->revision_date }}</td>
                                        <td>{{ $quality->status }}</td>
                                        <td>
                                            <a href="{{ route('qualities.show', [$quality->id]) }}" class='btn btn-primary btn-xs'><i class="far fa-eye"></i></a>
                                            @can('Editar calidad')
                                                <a href="{{ route('qualities.edit', [$quality->id]) }}" class='btn btn-warning btn-xs'><i class="far fa-edit"></i></a>
                                            @endcan
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
            $('#qualities').DataTable({
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