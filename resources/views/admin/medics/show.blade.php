@extends('layouts.app')

@section('title', 'Médicos')

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
                                <h3>Detalle del médico</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>Médico:</strong> {{ $medic->name }}</p>
                        <p><strong>Correo electrónico:</strong> {{ $medic->mail }}</p>
                        <p><strong>Teléfono:</strong> {{ $medic->phone }}</p>
                        <hr>
                        <div>
                            <p><strong>Dirección:</strong></p>
                            <p>{{ $medic->address }}</p>    
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('medics.index') }}" class="btn btn-danger btn-block">Volver</a>
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
            $('#medics').DataTable({
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