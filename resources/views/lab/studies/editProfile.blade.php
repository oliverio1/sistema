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
                                <h3>Edición de perfil</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($study, ['route' => ['profiles.update', $study], 'method' => 'put', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-sm-9">
                                {!! Form::label('name', 'Nombre del perfil:') !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del perfil
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre del perfil es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-3">
                                {!! Form::label('price', 'Precio:') !!}
                                {!! Form::text('price', old('price'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el precio del perfil
                                </div>
                                @error('price')
                                    <span class="text-danger">El precio del estudio es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('delivery', 'Tiempo de entrega:') !!}
                                {!! Form::number('delivery', old('delivery'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el tiempo de entrega
                                </div>
                                @error('delivery')
                                    <span class="text-danger">El tiempo de entrega es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('label', 'Texto para etiqueta:') !!}
                                {!! Form::text('label', old('label'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el texto para la etiqueta
                                </div>
                                @error('label')
                                    <span class="text-danger">El texto para etiqueta es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('area_id', 'Área de proceso:') !!}
                                {!! Form::select('area_id', $areas, null, array('class' => 'form-control', 'id' => 'area_id', 'style' => 'width:100%')) !!}
                                <div class="invalid-feedback">
                                    Seleccione el área de proceso
                                </div>
                                @error('area_id')
                                    <span class="text-danger">El área es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('maquila', 'El estudio se maquila:') !!}
                                {!! Form::select('maquila', [1 => 'SI', 0 => 'NO'], null, array('class' => 'form-control')) !!}
                                <div class="invalid-feedback">
                                    Seleccione si el estudio se maquila
                                </div>
                                @error('maquila')
                                    <span class="text-danger">La maquila es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('provider_id', 'Laboratorio de maquila:') !!}
                                {!! Form::select('provider_id', $providers, null, array('class'=>'form-control', 'required' => 'required')) !!}
                                <div class="invalid-feedback">
                                    Ingrese el laboratorio maquilador
                                </div>
                                @error('provider_id')
                                    <span class="text-danger">El laboratorio de maquila es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('lab_code', 'Folio de examen del maquilador:') !!}
                                {!! Form::text('lab_code', old('lab_code'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el folio del maquilador
                                </div>
                                @error('lab_code')
                                    <span class="text-danger">El folio del maquila es obligatorio</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4>Estudios que contiene el perfil</h4>
                                <table id="estudios" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Estudio</th>
                                            <th>Orden</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($estudios as $estudio)
                                            <tr>
                                                <td>{{ $estudio->name }}</td>
                                                <td>{{ $estudio->order }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-sm-12">
                                <hr>
                                <h5>Nueva configuración de perfil</h5>
                                <small style="color: red">Al modificar un perfil agregando o eliminando estudios, se perderá la configuración del perfil anterior</small>
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#EST">
                                    Agregar estudios
                                </button>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <table id="detalles" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Estudio</th>
                                            <th>Orden</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('studies.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EST" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selección de estudios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="studies" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Agregar</th>
                                <th>Folio</th>
                                <th>Estudio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studies as $study)
                                <tr>
                                    <td><button class="btn btn-success" onclick="agregarEstudio('{{ $study->id }}','{{ $study->name }}')"><i class="fa fa-plus"></i></button></td>
                                    <td>{{ $study->id }}</td>
                                    <td>{{ $study->name }}</td>
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
        $('#area_id').select2({
            theme: 'bootstrap-5'
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#studies').DataTable({
                dom: '<"container-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
                buttons: [
                ],
                language: {
                    url: '/datatables.json'
                }
            });
        });
        var cont = 0;
        var detalles = 0;
        function agregarEstudio(id,name) {
            var fila = '<tr class="filas" id="fila'+cont+'">'+
            '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
            '<td><input type="hidden" name="study_id[]" value="'+id+'">'+name+'</td>'+
            '<td><input type="number" name="order[]"></td>'+
            '</tr>';
            cont++;
            detalles++<
            $('#detalles').append(fila);
        }
        function eliminarDetalle(indice) {
            $("#fila" + indice).remove();
            detalles = detalles - 1;
        }
    </script>
@endsection