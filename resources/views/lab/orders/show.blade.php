@extends('layouts.app')

@section('title', 'Registro')

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
                                <h3>Detalles del registro</h3>
                            </div>
                            <div class="col-sm-6">
                                @can('Imprimir ordenes')
                                    <a href="{{ route('orders.printLabels',[$order->id]) }}" class='btn btn-secondary btn-sm float-right'><i class="fa fa-tags"></i> Imprimir etiquetas</a>
                                    <a href="{{ route('orders.printReports',[$order->id]) }}" class='btn btn-info btn-sm float-right mr-2'><i class="fa fa-print"></i> Imprimir resultados</a>                            </div>
                                @endcan
                            </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $order->clave }} {{ $order->name }} {{ $order->pater }} {{ $order->mater }}</td>
                                <th>Sexo</th>
                                <td>{{ $order->sex }}</td>
                            </tr>
                            <tr>
                                <th>Edad</th>
                                <td> {{ $order->age }} años</td>
                                <th>Médico</th>
                                @if($order->medic == null)
                                    <td>A quien corresponda</td>
                                @else
                                    <td>{{ $order->medic->name }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Teléfono</th>
                                <td>{{ $order->phone }}</td>
                                <th>Correo electrónico</th>
                                <td>{{ $order->mail }}</td>
                            </tr>
                        </table>
                        <hr>
                        <h5>Datos del cliente</h5>
                        <table class="table">
                            <tr>
                                <th>Cliente</th>
                                <td>{{ $order->client->name }}</td>
                                <th></th>
                                <td></td>
                                <th></th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Contacto</th>
                                <td>{{ $order->client->contact }}</td>
                                <th>Teléfono</th>
                                <td>{{ $order->client->phone }}</td>
                                <th>Correo</th>
                                <td>{{ $order->client->email }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('areas.index') }}" class="btn btn-danger btn-block">Volver</a>
                    </div>
                </div>
                <div class="card">
                    <div class="row m-3">
                        <div class="col-md-12">
                            <h5>Listado de estudios</h5>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Clave</th>
                                        <th>Estudio</th>
                                        <th>Estatus</th>
                                        <th>Fecha de registro</th>
                                        <th>Fecha de entrega</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details as $detail)
                                        @if(\Carbon\Carbon::parse($detail->created_at)->addWeekdays($detail->delivery)->isPast() && $detail->status == 'Registro')
                                            <tr class="table-danger">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $detail->code }}</td>
                                                <td>{{ $detail->name }}</td>
                                                <td>{{ $detail->status }}</td>
                                                <td>{{ \Carbon\Carbon::parse($detail->created_at)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($detail->created_at)->addWeekdays($detail->delivery)->format('d-m-Y') }}</td>
                                                <td>
                                                    @if($detail->status == 'Capturado' || $detail->status == 'Liberado')
                                                        @can('Ver resultados')
                                                            <a href="{{ route('orders.showResult',[$order->id,$detail->study_id,$detail->id]) }}" class='btn btn-success btn-xs'><i class="fa fa-eye"></i></a>
                                                        @endcan
                                                    @else
                                                        @can('Reportar resultados')
                                                            <a href="{{ route('orders.report',[$order->id,$detail->study_id,$detail->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-pen"></i></a>
                                                        @endcan
                                                    @endif
                                                    @can('Imprimir ordenes')
                                                        <a href="{{ route('orders.printReport',[$order->id,$detail->study_id,$detail->id]) }}" class='btn btn-info btn-xs'><i class="fa fa-print"></i></a>
                                                        <a href="{{ route('orders.printLabel',[$order->id,$detail->study_id,$detail->id]) }}" class='btn btn-info btn-xs'><i class="fa fa-tag"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $detail->code }}</td>
                                                <td>{{ $detail->name }}</td>
                                                <td>{{ $detail->status }}</td>
                                                <td>{{ \Carbon\Carbon::parse($detail->created_at)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($detail->created_at)->addWeekdays($detail->delivery)->format('d-m-Y') }}</td>
                                                <td>
                                                    @if($detail->status == 'Capturado' || $detail->status == 'Liberado')
                                                        @can('Ver resultados')
                                                            <a href="{{ route('orders.showResult',[$order->id,$detail->study_id,$detail->id]) }}" class='btn btn-success btn-xs'><i class="fa fa-eye"></i></a>
                                                        @endcan
                                                    @else
                                                        @can('Reportar resultados')
                                                            <a href="{{ route('orders.report',[$order->id,$detail->study_id,$detail->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-pen"></i></a>
                                                        @endcan
                                                    @endif
                                                    @can('Imprimir ordenes')
                                                        <a href="{{ route('orders.printReport',[$order->id,$detail->study_id,$detail->id]) }}" class='btn btn-info btn-xs'><i class="fa fa-print"></i></a>
                                                        <a href="{{ route('orders.printLabel',[$order->id,$detail->study_id,$detail->id]) }}" class='btn btn-info btn-xs'><i class="fa fa-tag"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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