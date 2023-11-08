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
                                <h3>Detalle de la incidencia</h3>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#registeraction">
                                    Agregar acciones
                                </button>
                                {{-- <a class="btn btn-primary float-right" href="{{ route('incidents.actions', [$incident->id]) }}">Registrar acciones</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <p><strong>Socio:</strong></p>
                                <p>{{ $incident->client->name }}</p>
                                <p><strong>Persona que levanta la queja:</strong></p>
                                <p>{{ $incident->name }}</p>
                                <p><strong>Vía de reporte:</strong></p>
                                <p>{{ $incident->source }}</p>
                                <p><strong>Responsable de seguimiento:</strong></p>
                                <p>{{ $incident->assigned }}</p>
                                <p><strong>Registrada por:</strong></p>
                                <p>
                                    @if($incident->user_id === 100) 
                                        Particular
                                    @else 
                                        {{ $incident->user->name }}
                                    @endif
                                </p>
                            </div>
                            <div class="col-sm-8">
                                <p><strong>Descripción:</strong></p>
                                <p>{{ $incident->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('incidents.index') }}" class="btn btn-danger btn-block">Volver</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Acciones a realizar
                    </div>
                    {!! Form::model($incident, ['route' => ['incidents.storeactions', $incident->id], 'method' => 'post', 'class' => 'needs-validation','novalidate']) !!}
                        <div class="card-body">
                            <div class="row m-3">
                                <div class="col-md-12">
                                    <table class="table" id="actions">
                                        <thead>
                                            <tr>
                                                <th>Opciones</th>
                                                <th>Acción</th>
                                                <th>Estatus</th>
                                                <th>Responsable</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('incidents.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="card">
                    <div class="card-header">
                        Acciones pendientes
                    </div>
                    <div class="card-body">
                        <div class="row m-3">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Acción</th>
                                            <th>Estatus</th>
                                            <th>Fecha de registro</th>
                                            <th>Responsable</th>
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
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('incidents.actions', $incident->id) }}" class="btn btn-info btn-block">Detalle</a>                        
                    </div>
                </div>
                <div class="card">
                    <div class="row m-3">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Acción</th>
                                        <th>Estatus</th>
                                        <th>Fecha de registro</th>
                                        <th>Resolvió</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        @if($detail->status == 2)
                                            <tr>
                                                <td>{{ $detail->id }}</td>
                                                <td>{{ $detail->action }}</td>
                                                <td>Resuelta</td>
                                                <td>{{ $detail->updated_at }}</td>
                                                <td>{{ $detail->user->name }}</td>
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
    </div>
    <div class="modal fade" id="registeraction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Acciones a tomar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="accion">Acción a tomar</label>
                            <textarea name="accion" id="accion" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="responsable">Responsable</label>
                            <select name="asignado" id="asignado" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id}}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="addAction()">Agregar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
            $('#incidents').DataTable({
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
    <script>
        var actions = new Array();
        var toma = new Array();
        var cont = 0;
        var detalles = 0;
        function addAction() {
            var accion = $('#accion').val();
            var nombre = $('#asignado option:selected').text();
            var responsable_id = $('#asignado').val();
            console.log(accion,asignado);
            var fila = '<tr class="filas" id="fila'+cont+'">'+
                '<td><button type="button" class="btn btn-danger" onclick="deleteAction('+cont+')">X</button></td>'+
                '<td><p>'+accion+'</p><input value="'+accion+'" type="hidden" name="action[]"></td>'+
                '<td><p>Pendiente</p><input value="Pendiente" type="hidden"></td>'+
                '<td><p>'+nombre+'</p><input value="'+responsable_id+'" type="hidden" name="responsable[]"></td>'+
                '</tr>';
            cont++;
            detalles++;
            $('#actions').append(fila);
            $('#accion').val('');
            $('#asignado').val('');
            $('#registeraction').modal('toggle');
        }
        function deleteAction(indice) {
            $("#fila" + indice).remove();
            detalles = detalles - 1;
        }
    </script>
@endsection