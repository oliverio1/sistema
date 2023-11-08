@extends('layouts.app')

@section('title', 'Contenedores')

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
                                <h4>Contenedores</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear contenedores')
                                    <a class="btn btn-primary float-right" href="{{ route('containers.create') }}">Nuevo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de contenedores</h3>
                        <hr>
                        <table id="containers" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($containers as $container)
                                    <tr>
                                        <td>{{ $container->id }}</td>
                                        <td>{{ $container->name }}</td>
                                        <td>
                                            <form action="{{ route('containers.destroy', $container)}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <a href="{{ route('containers.show', [$container->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                @can('Editar contenedores')
                                                    <a href="{{ route('containers.edit', [$container->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                @endcan
                                                @can('Eliminar contenedores')
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
            $('#containers').DataTable({
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