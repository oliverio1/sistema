@extends('layouts.app')

@section('title', 'Médicos')

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
                                <h3>Edición de médicos</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($medic, ['route' => ['medics.update', $medic], 'method' => 'put', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('name', 'Nombre del médico:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del médico
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre del médico es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('mail', 'Correo electrónico:') !!}
                                {!! Form::text('mail', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el correo electrónico del médico
                                </div>
                                @error('mail')
                                    <span class="text-danger">El correo electrónico del médico es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('phone', '# telefónico:') !!}
                                {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el # telefónico del médico
                                </div>
                                @error('phone')
                                    <span class="text-danger">El teléfono del contacto es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('address', 'Dirección:') !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese la dirección del médico
                                </div>
                                @error('address')
                                    <span class="text-danger">La dirección es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('observation', 'Observaciones:') !!}
                                {!! Form::textarea('observation', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese las condiciones de trabajo para el médico
                                </div>
                                @error('observation')
                                    <span class="text-danger">Las observaciones son obligatorias</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('medics.index') }}" class="btn btn-danger">Cancelar</a>
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