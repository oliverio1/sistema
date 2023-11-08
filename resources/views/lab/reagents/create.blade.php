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
                                <h3>Alta de reactivos</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'reagents.store', 'class' => "needs-validation", 'novalidate']) !!}
                        <div class="row">
                            <div class="form-group col-sm-8">
                                {!! Form::label('name', 'Nombre:') !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del producto
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre del reactivo es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('area_id', 'Área:') !!}
                                {!! Form::select('area_id', $areas, null, array('class'=>'form-control', 'placeholder'=>'Selecciona el área')) !!}
                                <div class="invalid-feedback">
                                    Selecciona el área a la que pertenece el artículo
                                </div>
                                @error('area_id')
                                    <span class="text-danger">El área es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('min', 'Mínimo en stock:') !!}
                                {!! Form::number('min', old('min'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el mínimo que debe existir en stock
                                </div>
                                @error('min')
                                    <span class="text-danger">El mínimo es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('max', 'Máximo en stock:') !!}
                                {!! Form::number('max', old('max'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el máximo que debe existir en stock
                                </div>
                                @error('max')
                                    <span class="text-danger">El máximo es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('stock', 'Stock:') !!}
                                {!! Form::number('stock', old('stock'), ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el stock inicial
                                </div>
                                @error('stock')
                                    <span class="text-danger">El stock es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('description', 'Descripción:') !!}
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Agregue una descripción
                                </div>
                                @error('description')
                                    <span class="text-danger">La descripción es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('image', 'Imagen:') !!}
                                <div class="input-group">
                                    <div class="custom-file">
                                        {!! Form::file('image', ['class' => 'custom-file-input', 'accept' => 'images/*']) !!}
                                        {!! Form::label('image', 'Seleccione una imagen', ['class' => 'custom-file-label']) !!}
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Agregue una imagen del producto
                                </div>
                                @error('image')
                                    <span class="text-danger">La imagen es obligatoria</span>
                                @enderror
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