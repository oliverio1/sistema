@extends('layouts.app')

@section('title', 'Registros')

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
                                <h4>Registros</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear ordenes')
                                    <a href="{{ route('orders.create') }}" class="btn btn-primary float-right">Registro de paciente</a>
                                    <a href="{{ route('orders.sampling') }}" class="btn btn-primary float-right mr-2">Registro rápido</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de registros</h3>
                        <hr>
                        <table id="orders" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Registro</th>
                                    <th>Nombre</th>
                                    <th>Cliente</th>
                                    <th>Estatus</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>{{ $order->clave }} {{ $order->name }} {{ $order->pater }} {{ $order->mater }}</td>
                                        @if(Auth::user()->can('Modificar cliente'))
                                            <td><a href="#changeClient" data-toggle="modal" data-target="#changeClient">{{ $order->client->name }}</a></td>
                                        @else
                                            <td>{{ $order->client->name }}</td>
                                        @endif
                                        <td>{{ $order->status }}</td>
                                        <td>
                                            <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <a href="{{ route('orders.show', [$order->id]) }}" class='btn btn-primary btn-sm'><i class="fa fa-eye"></i></a>
                                                @can('Imprimir ordenes')
                                                    <a href="{{ route('orders.printOrder', [$order->id]) }}" class='btn btn-secondary btn-sm'><i class="fa fa-print"></i></a>
                                                @endcan
                                                <a href="{{ route('orders.printLabels',[$order->id]) }}" class='btn btn-info btn-sm'><i class="fa fa-tag"></i></a>
                                                @can('Editar ordenes')
                                                    @if($order->type == 'Normal')
                                                        <a href="{{ route('orders.edit', [$order->id]) }}" class='btn btn-warning btn-sm'><i class="fa fa-edit"></i></a>
                                                    @else
                                                        <a href="{{ route('orders.editSampling', [$order->id]) }}" class='btn btn-warning btn-sm'><i class="fa fa-edit"></i></a>
                                                    @endif
                                                @endcan
                                                @can('Eliminar ordenes')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-times"></i></button>
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
    <div class="modal fade changeClient" tabindex="-1" role="dialog" aria-labelledby="changeClient" aria-hidden="true" id="changeClient">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambio de cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($orders->first())
                        {!! Form::model($order, ['route' => ['orders.updateClient', $order], 'method' => 'patch', 'class' => 'needs-validation','novalidate', 'files' => true]) !!}
                            {!! Form::label('client_id', 'Procedencia:') !!}
                                <select id="client_id" name="client_id" class="form-control" wire:model.lazy="client">
                                    <option>Selecciona un cliente</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Ingrese la procedencia
                                </div>
                            </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            {!! Form::close() !!}  
                        </div>
                    @endif
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
            $('#orders').DataTable({
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