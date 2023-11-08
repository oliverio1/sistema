@extends('layouts.app')

@section('title', 'Reactivos')

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
                                <h4>Inventario</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Inventario de reactivos</h3>
                        <hr>
                        <table id="inventories" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Folio</th>
                                    <th>Cantidad Inicial</th>
                                    <th>Stock</th>
                                    <th>En uso</th>
                                    <th>Finalizados</th>
                                    <th>Lote</th>
                                    <th>Caducidad</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->name }}</td>
                                        <td>{{ $inventory->code }}</td>
                                        <td>{{ $inventory->cantidad }}</td>
                                        <td>{{ $inventory->stock }}</td>
                                        <td>{{ $inventory->used }}</td>
                                        <td>{{ $inventory->finished }}</td>
                                        <td>{{ $inventory->lote }}</td>
                                        <td>{{ $inventory->caducidad }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @if($inventory->used + $inventory->finished < $inventory->cantidad)
                                                    <form action="{{ route('reagents.use', $inventory->reagent_id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-arrow-up"></i></button>
                                                    </form>
                                                @endif
                                                @if($inventory->used != 0)
                                                    <form action="{{ route('reagents.fin', $inventory->reagent_id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-arrow-down"></i></button>
                                                    </form>
                                                @endif
                                            </div>
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
            $('#inventories').DataTable({
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