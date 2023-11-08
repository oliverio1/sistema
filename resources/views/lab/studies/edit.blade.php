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
                                <h3>Edición de estudios</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($study, ['route' => ['studies.update', $study], 'method' => 'put', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-sm-7">
                                {!! Form::label('name', 'Nombre del examen:') !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del estudio
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre del estudio es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-2">
                                {!! Form::label('type', 'Tipo de estudio:') !!}
                                {!! Form::select('type', [3 => 'Analito', 1 => 'Examen', 4 => 'Alergeno'], null, array('class' => 'form-control')) !!}
                                <div class="invalid-feedback">
                                    Seleccione el tipo de estudio
                                </div>
                                @error('type')
                                    <span class="text-danger">El tipo de estudio es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-3">
                                {!! Form::label('price', 'Precio:') !!}
                                {!! Form::text('price', old('price'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el precio del estudio
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
                            <div class="form-group col-sm-12">
                                <label>Tipo de muestra</label>
                                {!! Form::select('specimens[]', $specimens, null, array('class' => 'form-control', 'multiple', 'required' => 'required', 'id' => 'specimens', 'style' => 'width:100%')) !!}
                                <div class="invalid-feedback">
                                    Seleccione el tipo de muestra para el estudio
                                </div>
                                @error('specimens')
                                    <span class="text-danger">El tipo de muestra obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Contenedores</label>
                                {!! Form::select('containers[]', $containers, null, array('class' => 'form-control', 'multiple', 'required' => 'required', 'id' => 'containers', 'style' => 'width:100%')) !!}
                                <div class="invalid-feedback">
                                    Seleccione los contenedores para el estudio
                                </div>
                                @error('containers')
                                    <span class="text-danger">El contenedor es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label>Indicaciones</label>
                                {!! Form::select('indications[]', $indications, null, array('class' => 'form-control', 'multiple', 'required' => 'required', 'id' => 'indications', 'style' => 'width:100%')) !!}
                                <div class="invalid-feedback">
                                    Seleccione las indicaciones para el estudio
                                </div>
                                @error('indications')
                                    <span class="text-danger">Las indicaciones son obligatorias</span>
                                @enderror
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
        $('#containers').select2({
            theme: 'classic'
        });
        $('#indications').select2({
            theme: 'classic'
        });
        $('#specimens').select2({
            theme: 'classic'
        });
    </script>
@endsection