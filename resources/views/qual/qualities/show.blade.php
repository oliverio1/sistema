@extends('layouts.app')

@section('title', 'SGC')

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
                <div class="card" style="height:800px">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Detalle del documento</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="col-sm-12">
                                    {!! Form::label('name', 'Documento:') !!}
                                    <p>{{ $quality->name }}</p>
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('numeral', 'Numeral:') !!}
                                    <p>{{ $quality->numeral }}</p>
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('release_date', 'Fecha de emisión:') !!}
                                    <p>{{ $quality->release_date }}</p>
                                </div>
                                <div class="col-sm-12">
                                    {!! Form::label('revision_date', 'Fecha de revisión:') !!}
                                    <p>{{ $quality->revision_date }}</p>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <embed src="{{ asset('calidad/documents/'. $quality->document ) }}" width="100%" height="600px" type="application/pdf">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('qualities.index') }}" class="btn btn-danger btn-block">Volver</a>
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
            $('#qualities').DataTable({
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