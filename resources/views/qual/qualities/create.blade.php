@extends('layouts.app')

@section('title', 'SGC')

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
                                <h3>Alta de documentos</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'qualities.store', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    {{ Form::label('numeral', 'Numeral:') }}
                                    {{ Form::select('numeral', [
                                        '4.1. Organización y responsabilidad de la dirección' => '4.1. Organización y responsabilidad de la dirección', 
                                        '4.2. Sistema de gestión de la calidad' => '4.2. Sistema de gestión de la calidad', 
                                        '4.3. Control de documentos' => '4.3. Control de documentos', 
                                        '4.4. Contratos de prestación de servicios' => '4.4. Contratos de prestación de servicios', 
                                        '4.5. Laboratorios subcontratados' => '4.5. Laboratorios subcontratados', 
                                        '4.6. Servicios externos y suministros' => '4.6. Servicios externos y suministros', 
                                        '4.7. Servicios de asesoria' => '4.7. Servicios de asesoria', 
                                        '4.8. Resolución de quejas' => '4.8. Resolución de quejas', 
                                        '4.9. Identificación y control de no conformidades' => '4.9. Identificación y control de no conformidades', 
                                        '4.10. Acciones correctivas' => '4.10. Acciones correctivas', 
                                        '4.11. Acciones preventivas' => '4.11. Acciones preventivas', 
                                        '4.12. Mejora continua' => '4.12. Mejora continua', 
                                        '4.13. Control de registros' => '4.13. Control de registros', 
                                        '4.14. Evaluación y auditorias' => '4.14. Evaluación y auditorias', 
                                        '4.15. Revisión por la dirección' => '4.15. Revisión por la dirección', 
                                        '5.1. Personal' => '5.1. Personal', 
                                        '5.2. Instalaciones y condiciones ambientales' => '5.2. Instalaciones y condiciones ambientales', 
                                        '5.3. Equipos de laboratorio, reactivos y consumibles' => '5.3. Equipos de laboratorio, reactivos y consumibles', 
                                        '5.4. Procesos pre examen' => '5.4. Procesos pre examen', 
                                        '5.5. Procesos de examen' => '5.5. Procesos de examen', 
                                        '5.6. Aseguramiento de la calidad de los resultados' => '5.6. Aseguramiento de la calidad de los resultados', 
                                        '5.7. Procesos post examen' => '5.7. Procesos post examen', 
                                        '5.8. Informe de resultados' => '5.8. Informe de resultados', 
                                        '5.9. Liberación de resultados' => '5.9. Liberación de resultados', 
                                        '5.10. Gestión de la información del laboratorio' => '5.10. Gestión de la información del laboratorio', 
                                        ], null, array('class' => 'form-control')) }}
                                    <div class="invalid-feedback">
                                        Ingrese el numeral al que pertenece el documento
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    {{ Form::label('type', 'Tipo:') }}
                                    {{ Form::select('type', [
                                        'FO' => 'Formato', 
                                        'MA' => 'Manual', 
                                        'PR' => 'Programa', 
                                        'DP' =>  'Descripción de puestos', 
                                        'PP' =>  'Perfil de puestos', 
                                        'RH' => 'Recursos humanos', 
                                        'IT' => 'Instructivo', 
                                        'DI' => 'Diagrama técnico', 
                                        'PG' => 'Procedimiento de gestión', 
                                        'PT' => 'Procedimiento técnico', 
                                        'LI' => 'Lista', 
                                        'CO' => 'Código', 
                                        'PL' => 'Plan', 
                                        'PO' => 'Política', 
                                        ], null, array('class' => 'form-control')) }}
                                    <div class="invalid-feedback">
                                        Seleccione el tipo de documento
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('name', 'Nombre:') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    <div class="invalid-feedback">
                                        Nombre del documento
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-lg-12">
                                    {!! Form::label('release_date', 'Fecha de emisión:') !!}
                                    {!! Form::date('release_date', null, ['class' => 'form-control']) !!}
                                    <div class="invalid-feedback">
                                        Fecha de liberación
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-lg-12">
                                    {!! Form::label('revision_date', 'Fecha de revisión:') !!}
                                    {!! Form::date('revision_date', null, ['class' => 'form-control']) !!}
                                    <div class="invalid-feedback">
                                        Fecha de revisión
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    {!! Form::label('document', 'Documento:') !!}
                                    <div class="input-group">
                                        <div class="custom-file">
                                            {!! Form::file('document', ['class' => 'custom-file-input', 'accept' => '.pdf']) !!}
                                            {!! Form::label('document', 'Selecciona un archivo', ['class' => 'custom-file-label']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('qualities.index') }}" class="btn btn-danger">Cancelar</a>
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