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
                                <h3>Detalle del la compra</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Persona que solicita reactivos:</strong></p>
                                <p>{{ $purchase->user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Persona que realiza la compra:</strong></p>
                                <p>{{ $purchase->user->name }}</p>
                                <br>
                            </div>
                        </div>
                        <h3 align="center">Reactivos solicitados</h3>
                        <table id="details" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reactivo</th>
                                    <th>Cantidad solicitada</th>
                                    <th>Cantidad comprada</th>
                                    <th>Fecha de compra</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->reagent->name }}</td>
                                        <td>{{ $detail->cant }}</td>
                                        <td>{{ $detail->purchased_cant }}</td>
                                        <td>{{ $detail->attended }}</td>
                                        <td>{{ $detail->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('purchases.index') }}" class="btn btn-danger btn-block">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_css')
@endsection

@section('page_scripts')
@endsection