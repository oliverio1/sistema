@extends('layouts.app')

@section('title', 'Proveedores')

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
                                <h4>Proveedores</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear proveedores')
                                    <a class="btn btn-primary float-right" href="{{ route('providers.create') }}">Nuevo</a>
                                @endcan
                            </div>
                            <div class="col-sm-12">
                                <hr>
                                <h5>Documentación requerida para proveedores</h5>
                                <p>Acta constitutiva, INE de representante legal, Contrato, Acuerdo de confidencialidad, Constancia de situación fiscal, Opinión de cumplimiento, Comprobante de domicilio, Datos bancarios, Aviso de funcionamiento</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de proveedores</h3>
                        <hr>
                        <table id="providers" class="table table-hover table-striped">
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
                                @foreach ($providers as $provider)
                                    <tr>
                                        <td>{{ $provider->id }}</td>
                                        <td>{{ $provider->name }}</td>
                                        <td>{{ $provider->contact }}</td>
                                        <td>{{ $provider->phone }}</td>
                                        <td>{{ $provider->email }}</td>
                                        <td>{{ $provider->address }}</td>
                                        <td>
                                            @if($provider->status)
                                                <form action="{{ route('providers.deactivate', $provider->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('providers.show', [$provider->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Editar proveedores')
                                                        <a href="{{ route('providers.edit', [$provider->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar proveedores')
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-times"></i></button>
                                                    @endcan
                                                </form>
                                            @else
                                                <form action="{{ route('providers.activate', $provider->id)}}" method="POST">
                                                    @csrf
                                                    <a href="{{ route('providers.show', [$provider->id]) }}" class='btn btn-primary btn-sm'><i class="far fa-eye"></i></a>
                                                    @can('Editar proveedores')
                                                        <a href="{{ route('providers.edit', [$provider->id]) }}" class='btn btn-warning btn-sm'><i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('Eliminar proveedores')
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
            $('#providers').DataTable({
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