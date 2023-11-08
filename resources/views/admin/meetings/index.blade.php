@extends('layouts.app')

@section('title', 'Agenda')

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
                                <h4>Calendario</h4>
                            </div>
                            <div class="col-sm-6">
                                @can('Crear eventos')
                                    <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#event">Agendar evento</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva reunión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'meetings.store', 'class' => "needs-validation", 'novalidate']) !!}
                    <div class="row">
                        <div class="form-group col-sm-12">
                            {!! Form::label('title', 'Nombre de la reunión:') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <div class="invalid-feedback">
                                Motivo de la reunión
                            </div>
                            @error('title')
                                <span class="text-danger">El motivo de la reunión es obligatorio</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label('description', 'Describe las actividades de la reunión:') !!}
                            {!! Form::textarea('description', null, array('class' => 'form-control', 'required' => 'required')) !!}
                            <div class="invalid-feedback">
                                Describa el motivo de la reunión
                            </div>
                            @error('description')
                                <span class="text-danger">Los puntos a tratar en la reunión son obligatorios</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label('start_date', 'Fecha y hora de inicio:') !!}
                            {!! Form::datetimeLocal('start_date', null, array('class' => 'form-control', 'required' => 'required')) !!}
                            <div class="invalid-feedback">
                                Fecha de inicio
                            </div>
                            @error('start_date')
                                <span class="text-danger">La fecha de la reunión es obligatoria</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::label('end_date', 'Fecha y hora de termino:') !!}
                            {!! Form::datetimeLocal('end_date', null, array('class' => 'form-control', 'required' => 'required')) !!}
                            <div class="invalid-feedback">
                                Fecha de termino
                            </div>
                            @error('end_date')
                                <span class="text-danger">La fecha de termino de la reunión es obligatoria</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-12">
                            <label>Personal convocado</label>
                            {!! Form::select('convocated[]', $users, null, array('class' => 'form-control', 'multiple', 'id' => 'convocated', 'style' => 'width:100%')) !!}
                            <div class="invalid-feedback">
                                Seleccione el personal convocado a la reunión
                            </div>
                            @error('convocated')
                                <span class="text-danger">El personal convocado es obligatorio</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
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
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            events: @json($meetings),
            locale: 'es',
            slotMinTime: '08:00:00',
            allDaySlot: false
        });
        calendar.render();
        });
    </script>
    <script>
        $('#convocated').select2({
            theme: 'classic'
        });
    </script>
@endsection