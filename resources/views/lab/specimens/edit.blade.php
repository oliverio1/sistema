@extends('layouts.app')

@section('title', 'Tipos de muestra')

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
                                <h3>Edición de tipos de muestra</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($specimen, ['route' => ['specimens.update', $specimen], 'method' => 'put', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('name', 'Tipo de muestra:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus','autocomplete' => 'off']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el tipo de muestra
                                </div>
                                @error('name')
                                    <span class="text-danger">El tipo de muestra es obligatorio</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('specimens.index') }}" class="btn btn-danger">Cancelar</a>
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