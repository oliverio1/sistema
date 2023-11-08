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
                                <h4>Reactivos</h4>
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-secondary float-right" href="{{ route('reagents.create') }}"> Nuevo reactivo</a>
                                <a class="btn btn-secondary float-right mr-2" href="{{ route('reagents.request') }}"> Solicitud de reactivos</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center">Listado de reactivos</h3>
                        <hr>
                        <table id="reagents" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Folio</th>
                                    <th>Área</th>
                                    <th>Mínimos y máximos</th>
                                    <th>Stock</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reagents as $reagent)
                                    <tr>
                                        <td>{{ $reagent->id }}</td>
                                        <td>{{ $reagent->name }}</td>
                                        <td>{{ $reagent->code }}</td>
                                        <td>{{ $reagent->area->name }}</td>
                                        <td>{{ $reagent->min }} - {{ $reagent->max }}</td>
                                        <td>{{ $reagent->stock }}</td>
                                        <td>
                                            <form action="{{ route('reagents.destroy', $reagent) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <a href="{{ route('reagents.show', [$reagent->id]) }}" class='btn btn-primary btn-sm'><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('reagents.edit', [$reagent->id]) }}" class='btn btn-warning btn-sm'><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-times"></i></button>
                                            </form>
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
            $('#reagents').DataTable({
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