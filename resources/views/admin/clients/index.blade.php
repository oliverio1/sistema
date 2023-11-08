@extends('layouts.app')

@section('title', 'Clientes')

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
                                <h4>Clientes</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear clientes')
                                    <a class="btn btn-primary float-right" href="{{ route('clients.create') }}">Nuevo</a>
                                @endcan
                            </div>
                            <div class="col-sm-12">
                                <hr>
                                <h5>Documentación requerida para clientes</h5>
                                <p>Acta constitutiva, INE de representante legal, Contrato, Convenio de confidencialidad, Constancia de situación fiscal, Comprobante de domicilio, Aviso de funcionamiento, Cédula de responsable sanitario</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de clientes</h3>
                        <hr>
                        <table id="clients" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Contacto</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Dirección</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->contact }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->address }}</td>
                                        <td>
                                            @if($client->status)
                                                <form action="{{ route('clients.deactivate', $client->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('clients.show', [$client->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Editar precios')
                                                        <a href="{{ route('clients.prices', [$client->id]) }}" class='btn btn-secondary btn-sm'><i class="fas fa-dollar-sign"></i></a>
                                                    @endcan
                                                    @can('Editar clientes')
                                                        <a href="{{ route('clients.edit', [$client->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar clientes')
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                                    @endcan
                                                </form>
                                            @else
                                                <form action="{{ route('clients.activate', $client->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('clients.show', [$client->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Editar clientes')
                                                        <a href="{{ route('clients.edit', [$client->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar clientes')
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
            $('#clients').DataTable({
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