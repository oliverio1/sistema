@extends('layouts.app')

@section('title', 'Clientes')

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
                                <h3>Edición de clientes</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($client, ['route' => ['clients.update', $client], 'method' => 'put', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('name', 'Nombre del cliente:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del cliente
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre del cliente es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('social', 'Razón social:') !!}
                                {!! Form::text('social', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese la razón social
                                </div>
                                @error('social')
                                    <span class="text-danger">La razón social es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('contact', 'Contacto:') !!}
                                {!! Form::text('contact', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del contacto
                                </div>
                                @error('contact')
                                    <span class="text-danger">El nombre del contacto es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('position', 'Cargo:') !!}
                                {!! Form::text('position', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el cargo del contacto
                                </div>
                                @error('position')
                                    <span class="text-danger">El puesto del contacto es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('email', 'Correo electrónico:') !!}
                                {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el correo electrónico del contacto
                                </div>
                                @error('email')
                                    <span class="text-danger">El correo electrónico del contacto es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('phone', '# telefónico:') !!}
                                {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el # telefónico del contacto
                                </div>
                                @error('phone')
                                    <span class="text-danger">El teléfono del contacto es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('contact2', 'Contacto 2:') !!}
                                {!! Form::text('contact2', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del contacto
                                </div>
                                @error('contact2')
                                    <span class="text-danger">El nombre del contacto es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('position2', 'Cargo 2:') !!}
                                {!! Form::text('position2', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el cargo del contacto
                                </div>
                                @error('position2')
                                    <span class="text-danger">El puesto del contacto es obligatorio</span>
                                @enderror                            
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('email2', 'Correo electrónico 2:') !!}
                                {!! Form::text('email2', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el correo electrónico del contacto
                                </div>
                                @error('email2')
                                    <span class="text-danger">El correo electrónico del contacto es obligatorio</span>
                                @enderror                            
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('phone2', '# telefónico 2:') !!}
                                {!! Form::text('phone2', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el # telefónico del contacto
                                </div>
                                @error('phone2')
                                    <span class="text-danger">El teléfono del contacto es obligatorio</span>
                                @enderror                            
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('bank', 'Banco:') !!}
                                {!! Form::text('bank', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el banco del cliente
                                </div>
                                @error('bank')
                                    <span class="text-danger">El banco es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('bank_count', 'Cuenta bancaria:') !!}
                                {!! Form::text('bank_count', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese la cuenta bancaria
                                </div>
                                @error('bank_count')
                                    <span class="text-danger">La cuenta bancaria es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('clabe', 'Clabe:') !!}
                                {!! Form::text('clabe', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese la clabe
                                </div>
                                @error('name')
                                    <span class="text-danger">La clabe interbancaria es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('seller', 'Vendedor:') !!}
                                {!! Form::text('seller', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el vendedor responsable del cliente
                                </div>
                                @error('seller')
                                    <span class="text-danger">El vendedor es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('address', 'Dirección:') !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese la dirección del cliente
                                </div>
                                @error('name')
                                    <span class="text-danger">La dirección es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('observation', 'Observaciones:') !!}
                                {!! Form::textarea('observation', null, ['class' => 'form-control']) !!}
                                <div class="invalid-feedback">
                                    Ingrese las condiciones de trabajo para el cliente
                                </div>
                                @error('name')
                                    <span class="text-danger">Las observaciones son obligatorias</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('file', 'Expediente:') !!}
                                <div class="input-group">
                                    <div class="custom-file">
                                        {!! Form::file('file', ['class' => 'custom-file-input', 'accept' => 'application/pdf']) !!}
                                        {!! Form::label('file', 'Expediente del cliente', ['class' => 'custom-file-label']) !!}
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Seleccione el expediente del cliente
                                </div>
                                @error('name')
                                    <span class="text-danger">El expediente es obligatorio</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('clients.index') }}" class="btn btn-danger">Cancelar</a>
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