@extends('layouts.app')

@section('title', 'Equipos')

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
                                <h3>Configuración de mantenimientos</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::model($equipment, ['route' => ['equipments.registermaintenancestore', $equipment->id], 'method' => 'patch', 'class' => 'needs-validation','novalidate', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::hidden('equipment_id', $equipment->id) !!}
                            </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('daily', 'Instrucciones del mantenimiento diario:') !!}
                                {!! Form::textarea('daily', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('weekly', 'Instrucciones del mantenimiento semanal:') !!}
                                {!! Form::textarea('weekly', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('monthly', 'Instrucciones del mantenimiento mensual:') !!}
                                {!! Form::textarea('monthly', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('quarterly', 'Instrucciones del mantenimiento trimestral:') !!}
                                {!! Form::textarea('quarterly', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('biannual', 'Instrucciones del mantenimiento semestral:') !!}
                                {!! Form::textarea('biannual', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-12 col-lg-12">
                                {!! Form::label('annual', 'Instrucciones del mantenimiento anual:') !!}
                                {!! Form::textarea('annual', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('equipments.index') }}" class="btn btn-danger">Cancelar</a>
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