@extends('layouts.app')

@section('title', 'Incidencias')

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
                                <h3>Alta de incidencias</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'incidents.store', 'class' => "needs-validation", 'novalidate']) !!}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('client_id', 'Cliente:') !!}
                                {{ Form::select('client_id', $clients, null, array('class'=>'form-control', 'placeholder'=>'Selecciona el cliente')) }}
                                <div class="invalid-feedback">
                                    Ingrese el cliente
                                </div>
                                @error('client_id')
                                    <span class="text-danger">El cliente es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('name', 'Nombre:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Persona que reporta la incidencia
                                </div>
                                @error('name')
                                    <span class="text-danger">El nombre de quien reporta la queja es obligatorio</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('source', 'Vía de reporte:') !!}
                                {!! Form::select('source', 
                                [
                                    'Personal' => 'Personal',
                                    'Via telefónica' => 'Via telefónica',
                                    'Correo electrónico' => 'Correo electrónico',
                                    'Buzón de quejas' => 'Buzón de quejas',
                                    'WhatsApp' => 'WhatsApp'
                                ], null, array('class' => 'form-control', 'required' => 'required')) !!}
                                <div class="invalid-feedback">
                                    Seleccione la manera en la que se reportó la queja
                                </div>
                                @error('source')
                                    <span class="text-danger">La vía de reporte de queja es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('description', 'Descripción de la queja:') !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                <div class="invalid-feedback">
                                    Seleccione la manera en la que se reportó la queja
                                </div>
                                @error('description')
                                    <span class="text-danger">La vía de reporte de queja es obligatoria</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                {{ Form::label('assigned', 'Responsable de dar seguimiento') }}
                                <select name="assigned" class="form-control" placeholder="Asigne un responsable para el seguimiento">
                                    <option value=""></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione la persona encargada de resolver
                                </div>
                                @error('assigned')
                                    <span class="text-danger">La persona asignada a atender la queja es obligatoria</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('incidents.index') }}" class="btn btn-danger">Cancelar</a>
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