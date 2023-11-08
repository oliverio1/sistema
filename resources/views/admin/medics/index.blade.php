@extends('layouts.app')

@section('title', 'Médicos')

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
                                <h4>Médicos</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear medicos')
                                    <a class="btn btn-primary float-right" href="{{ route('medics.create') }}">Nuevo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de médicos</h3>
                        <hr>
                        <table id="medics" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Correo electrónico</th>
                                    <th>Dirección</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medics as $medic)
                                    <tr>
                                        <td>{{ $medic->id }}</td>
                                        <td>{{ $medic->name }}</td>
                                        <td>{{ $medic->phone }}</td>
                                        <td>{{ $medic->mail }}</td>
                                        <td>{{ $medic->address }}</td>
                                        <td>
                                            @if($medic->status)
                                                <form action="{{ route('medics.deactivate', $medic->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('medics.show', [$medic->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Editar medicos')
                                                        <a href="{{ route('medics.edit', [$medic->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar medicos')
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                                    @endcan
                                                </form>
                                            @else
                                                <form action="{{ route('medics.activate', $medic->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('medics.show', [$medic->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Editar medicos')
                                                        <a href="{{ route('medics.edit', [$medic->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar medicos')
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
            $('#medics').DataTable({
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