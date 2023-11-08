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
                                <a class="btn btn-primary float-right" href="{{ route('reagents.create') }}">Nuevo</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'reagents.storeRequest', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    {!! Form::label('area_id', 'Área solicitante:') !!}
                                    {!! Form::select('area_id', $areas, null, array('class'=>'form-control', 'placeholder'=>'Selecciona el área')) !!}
                                    <div class="invalid-feedback">
                                        Selecciona el área a la que pertenece el artículo
                                    </div>
                                    @error('area_id')
                                        <span class="text-danger">El área es obligatoria</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#reactivos">
                                        Agregar reactivos
                                    </button>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <table id="detalles" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Opciones</th>
                                                <th>Estudio</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('reagents.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reactivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selección de reactivos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="react" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Agregar</th>
                                <th>Folio</th>
                                <th>Producto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reagents as $reagent)
                                <tr>
                                    <td><button class="btn btn-success" onclick="agregarReactivo('{{ $reagent->id }}','{{ $reagent->name }}')"><i class="fa fa-plus"></i></button></td>
                                    <td>{{ $reagent->code }}</td>
                                    <td>{{ $reagent->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
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
        (function () {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')
        
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <script>
        $(document).ready(function () {
            $('#react').DataTable({
                dom: '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
                buttons: [
                ],
                language: {
                    url: '/datatables.json'
                }
            });
        });
    </script>
    <script>
        var cont = 0;
        var detalles = 0;
        function agregarReactivo(id,name) {
            var fila = '<tr class="filas" id="fila'+cont+'">'+
            '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
            '<td><input type="hidden" name="reagent_id[]" value="'+id+'">'+name+'</td>'+
            '<td><input type="number" name="cant[]"></td>'+
            '</tr>';
            cont++;
            detalles++;
            $('#detalles').append(fila);
        }
        function eliminarDetalle(indice) {
            $("#fila" + indice).remove();
            detalles = detalles - 1;
        }
    </script>
@endsection