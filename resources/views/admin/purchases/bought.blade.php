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
                                <h3>Detalle de la solicitud</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'purchases.storeBought', 'class' => "needs-validation", 'novalidate']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong># de solicitud:</strong> {{ $purchase->id }}</p>
                                    <p><strong>Fecha de solicitud:</strong> {{ $purchase->created_at }}</p>
                                    <p><strong>Solicitante:</strong> {{ $purchase->user->name }} ({{ $purchase->area->name }})</p>
                                    <hr>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reactivo</th>
                                                <th>Cantidad solicitada</th>
                                                <th>Cantidad a comprar</th>
                                                <th>Proveedor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($details as $detail)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <input type="hidden" value="{{ $detail->reagent_id }}" name="reagent_id[]">
                                                        <input type="hidden" value="{{ $purchase->id }}" name="purchase_id">
                                                        <input type="hidden" value="{{ $detail->id }}" name="detail_id">
                                                        {{ $detail->reagent->name }}
                                                    </td>
                                                    <td>{{ $detail->cant }}</td>
                                                    <td><input class="form-control" type="number" name="cant[]"></td>
                                                    <td>
                                                        <select name="provider_id[]" id="" class="form-control">
                                                            @foreach($providers as $provider)
                                                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('purchases.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
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
                dom: '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',  
                    'pdfHtml5',  
                ],
                language: {
                    url: '/datatables.json'
                }
            });
        });
    </script>
@endsection