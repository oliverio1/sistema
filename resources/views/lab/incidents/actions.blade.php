@extends('layouts.app')

@section('title', 'Incidencias')

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
                                <h4>Acciones</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row m-3">
                            <div class="col md-12">
                                <p><strong>Socio:</strong> {{ $incident->client->name }}</p>
                                <p><strong>Persona que levanta la queja:</strong> {{ $incident->name }}</p>
                                <p><strong>Vía de reporte:</strong> {{ $incident->source }}</p>
                            </div>
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Acción</th>
                                            <th>Estatus</th>
                                            <th>Fecha de registro</th>
                                            <th>Responsable</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $detail)
                                            @if($detail->status == 1)
                                                <tr>
                                                    <td>{{ $detail->id }}</td>
                                                    <td>{{ $detail->action }}</td>
                                                    <td>Pendiente</td>
                                                    <td>{{ $detail->created_at }}</td>
                                                    <td>{{ $detail->user->name }}</td>
                                                    <td>
                                                        <a href="{{ route('incidents.solveaction', $detail->id) }}">Resolver</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        Volver
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
        $(document).ready(function() {
            $('#qualities-table').DataTable({
                language: {
                    url: '/datatables.json'
                },
            });
        } );
    </script>
@endsection