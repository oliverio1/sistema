@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="content px-3">
        <div class="clearfix"></div>
        @if(session('info'))
            <div class="alert alert-primary" role="alert">
                <strong>{{ session('info') }}</strong>
            </div>    
        @endif
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Edición de rol</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'put']) !!}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('name', 'Nombre del rol:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Ingrese el nombre del rol
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre del rol es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('permissions', 'Permisos:') !!}
                                @foreach ($permissions as $permission)
                                    <div>
                                        <label>
                                            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'form-group mr-1']) !!}
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancelar</a>
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