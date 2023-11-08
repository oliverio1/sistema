@extends('layouts.app')

@section('title', 'Tipos de muestra')

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
                                <h4>Tipos de muestra</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear tipos de muestra')
                                    <a class="btn btn-primary float-right" href="{{ route('specimens.create') }}">Nuevo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de tipos de muestra</h3>
                        <hr>
                        <table id="specimens" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specimens as $specimen)
                                    <tr>
                                        <td>{{ $specimen->id }}</td>
                                        <td>{{ $specimen->name }}</td>
                                        <td>
                                            <form action="{{ route('specimens.destroy', $specimen)}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <a href="{{ route('specimens.show', [$specimen->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                @can('Editar tipos de muestra')
                                                    <a href="{{ route('specimens.edit', [$specimen->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                @endcan
                                                @can('Eliminar tipos de muestra')
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
            $('#specimens').DataTable({
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