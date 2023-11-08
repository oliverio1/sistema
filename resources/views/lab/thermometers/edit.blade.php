@extends('layouts.app')

@section('title', 'Termómetros')

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
                                <h3>Edición de termómetros</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($thermometer, ['route' => ['thermometers.update', $thermometer], 'method' => 'put', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('name', 'Nombre del termómetro:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus','autocomplete' => 'off']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del termómetro
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre del termómetro es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('brand', 'Marca:') !!}
                                {!! Form::text('brand', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese la marca del termómetro
                                </div>
                                @error('brand')
                                    <span class="text-danger">La marca es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('model', 'Modelo:') !!}
                                {!! Form::text('model', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el modelo del termómetro
                                </div>
                                @error('model')
                                    <span class="text-danger">El modelo es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('serie', 'Número de serie:') !!}
                                {!! Form::text('serie', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el número de serie del termómetro
                                </div>
                                @error('serie')
                                    <span class="text-danger">El número de serie es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {{ Form::label('provider_id', 'Encargado de calibración') }}
                                {{ Form::select('provider_id', $providers, null, array('class'=>'form-control', 'placeholder'=>'Selecciona el proveedor de calibración')) }}
                                <div class="invalid-feedback">
                                    Seleccione el proveedor de calibración
                                </div>
                                @error('provider_id')
                                    <span class="text-danger">El proveedor de mantenimiento es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('calibration', 'Fecha de calibración:') !!}
                                {!! Form::month('calibration', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Seleccione el mes en el que debe realizar la calibración
                                </div>
                                @error('calibration')
                                    <span class="text-danger">La fecha de calibración es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('expedient', 'Expediente:') !!}
                                <div class="input-group">
                                    <div class="custom-file">
                                        {!! Form::file('expedient', ['class' => 'custom-file-input']) !!}
                                        {!! Form::label('Expediente', null, ['class' => 'custom-file-label']) !!}
                                    </div>
                                    @error('expedient')
                                        <span class="text-danger">El expediente es obligatorio</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('thermometers.index') }}" class="btn btn-danger">Cancelar</a>
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
    </script>
@endsection