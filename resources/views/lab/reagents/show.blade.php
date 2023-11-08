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
                                <h3>Detalle del reactivo</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3" align="center">
                                <img src="{{ asset('reactivos/images/'.$reagent->image ) }}"
                                    class="img-responsive" width="80%">
                                    <hr>
                                <h2>{{ $reagent->name }}</h2>
                                <h6>{{ $reagent->code }}</h6>
                            </div>
                            <div class=" col-md-9 col-lg-9 "> 
                                <table class="table table-reagent-information">
                                    <tbody>
                                        <tr>
                                            <td>Producto:</td>
                                            <td>{{ $reagent->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Área:</td>
                                            <td>{{ $reagent->area->name }}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Mínimos y máximos</td>
                                            <td>{{ $reagent->min }} - {{ $reagent->max }}</td>
                                        </tr>
                                        <tr>
                                            <td>Descripción</td>
                                            <td>{{ $reagent->description }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('reagents.index') }}" class="btn btn-danger btn-block">Volver</a>
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