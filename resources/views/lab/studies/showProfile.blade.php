@extends('layouts.app')

@section('title', 'Estudios')

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
                                <h3>Detalle del perfil</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-9">
                            <p><strong>Estudio:</strong></p>
                            <p>{{ $study->name }}</p>
                            <p><strong>Precio:</strong></p>
                            <p>${{ $study->price }}</p>
                            <p><strong>Texto para etiqueta:</strong></p>
                            <p>{{ $study->label }}</p>
                            <p><strong>Tiempo de entrega:</strong></p>
                            <p>{{ $study->delivery }} días hábiles</p>
                        </div>
                        <div class="col-sm-3">
                            <strong>Estudios que contiene el perfil</strong>
                            <ul>
                                @foreach($studies as $s)
                                    <li>{{ $s->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('studies.index') }}" class="btn btn-danger btn-block">Volver</a>
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
            $('#studies').DataTable({
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