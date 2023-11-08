@extends('layouts.app')

@section('title', 'Áreas')

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
                                <h4>Áreas</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear areas')
                                    <a class="btn btn-primary float-right" href="{{ route('areas.create') }}">Nuevo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de áreas</h3>
                        <hr>
                        <table id="areas" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($areas as $area)
                                    <tr>
                                        <td>{{ $area->id }}</td>
                                        <td>{{ $area->name }}</td>
                                        <td>
                                            <form action="{{ route('areas.destroy', $area)}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <a href="{{ route('areas.show', [$area->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                @can('Editar areas')
                                                    <a href="{{ route('areas.edit', [$area->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                @endcan
                                                @can('Eliminar areas')
                                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                                @endcan
                                            </form>
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