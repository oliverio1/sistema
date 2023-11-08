@extends('layouts.app')

@section('title', 'Compras')

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
                                <h4>Compras</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de compras</h3>
                        <hr>
                        <table id="clients" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Area solicitante</th>
                                    <th>Fecha de solicitud</th>
                                    <th>Estatus</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                    @if($purchase->status == 'Pendiente')
                                        <tr class="table-warning">
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{ $purchase->area->name }}</td>
                                            <td>{{ $purchase->created_at }}</td>
                                            <td>{{ $purchase->status }}</td>
                                            <td>
                                                <a href="{{ route('purchases.show', [$purchase->id]) }}" class='btn btn-primary btn-xs'><i class="far fa-eye"></i></a>
                                                <a href="{{ route('purchases.report', [$purchase->id]) }}" class='btn btn-secondary btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                                                <a href="{{ route('purchases.bought', [$purchase->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-shopping-cart"></i></a>
                                            </td>
                                        </tr>
                                    @elseif($purchase->status == 'Atendida')
                                        <tr class="table-secondary">
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{ $purchase->area->name }}</td>
                                            <td>{{ $purchase->created_at }}</td>
                                            <td>{{ $purchase->status }}</td>
                                            <td>
                                                <a href="{{ route('purchases.show', [$purchase->id]) }}" class='btn btn-primary btn-xs'><i class="far fa-eye"></i></a>
                                                <a href="{{ route('purchases.report', [$purchase->id]) }}" class='btn btn-secondary btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                                                <a href="{{ route('purchases.receipt', [$purchase->id]) }}" class='btn btn-warning btn-xs'><i class="fa fa-clock-o"></i></a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-success">
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{ $purchase->area->name }}</td>
                                            <td>{{ $purchase->created_at }}</td>
                                            <td>{{ $purchase->status }}</td>
                                            <td>
                                                <a href="{{ route('purchases.show', [$purchase->id]) }}" class='btn btn-primary btn-xs'><i class="far fa-eye"></i></a>
                                                <a href="{{ route('purchases.report', [$purchase->id]) }}" class='btn btn-secondary btn-xs'><i class="fa fa-file-pdf-o"></i></a>
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


@endsection

@section('page_css')
@endsection

@section('page_scripts')
    <script>
        $(document).ready(function () {
            $('#purchases').DataTable({
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