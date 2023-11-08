@extends('layouts.app')

@section('title', 'Usuarios')

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
                                <h3>Edición de usuarios</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-sm-9">
                                {!! Form::label('name', 'Nombre del usuario:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus','autocomplete' => 'off']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del usuario
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre del usuario es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-3">
                                {!! Form::label('initials', 'Iniciales del usuario:') !!}
                                {!! Form::text('initials', $user->details->initials, ['class' => 'form-control', 'required' => 'required', 'autofocus','autocomplete' => 'off']) !!}
                                <div class="invalid-feedback">
                                    Ingrese las iniciales del usuario
                                </div>
                                @error('initials')
                                    <span class="text-danger">Las iniciales del usuario es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('email', 'Correo electrónico:') !!}
                                {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el correo electrónico
                                </div>
                                @error('email')
                                    <span class="text-danger">El correo electrónico del usuario es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('address', 'Dirección:') !!}
                                {!! Form::textarea('address', $user->details->address, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese la dirección del usuario
                                </div>
                                @error('address')
                                    <span class="text-danger">La dirección usuario es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('phone', 'Teléfono celular:') !!}
                                {!! Form::text('phone', $user->details->phone, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el teléfono
                                </div>
                                @error('phone')
                                    <span class="text-danger">El teléfono del usuario es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('emergency_phone', 'Teléfono de emergencia:') !!}
                                {!! Form::text('emergency_phone', $user->details->emergency_phone, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el teléfono de emergencia
                                </div>
                                @error('emergency_phone')
                                    <span class="text-danger">El teléfono de emergencia del usuario es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('emergency_contact', 'Contacto de emergencia:') !!}
                                {!! Form::text('emergency_contact', $user->details->emergency_contact, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el contacto de emergencia
                                </div>
                                @error('emergency_contact')
                                    <span class="text-danger">El nombre del contacto de emergencia del usuario es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('position', 'Cargo:') !!}
                                {!! Form::text('position', $user->details->position, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el cargo del usuario
                                </div>
                                @error('position')
                                    <span class="text-danger">El cargo del usuario es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('file', 'Fotografía:') !!}
                                <div class="input-group">
                                    <div class="custom-file">
                                        {!! Form::file('file', ['class' => 'custom-file-input', 'accept' => 'image/*']) !!}
                                        {!! Form::label('file', 'Seleccione una imagen', ['class' => 'custom-file-label']) !!}
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Seleccione una imagen
                                </div>
                                @error('file')
                                    <span class="text-danger">La fotografía del usuario es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('signature', 'Firma del usuario:') !!}
                                <div class="input-group">
                                    <div class="custom-file">
                                        {!! Form::file('signature', ['class' => 'custom-file-input', 'accept' => 'image/*']) !!}
                                        {!! Form::label('signature', 'Firma del usuario', ['class' => 'custom-file-label']) !!}
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Firma del usuario
                                </div>
                                @error('signature')
                                    <span class="text-danger">La firma del usuario es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <hr>
                                <h3>Seleccione el rol asignado al usuario</h3>
                                <hr>
                                @foreach($roles as $rol)
                                    <div>
                                        <label>
                                            {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'mr-2']) !!}
                                            {{ $rol->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('roles')
                                    <span class="text-danger">Debe seleccionar un rol para el usuario</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
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