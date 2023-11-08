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
                                <h4>Registro de mantenimientos</h4>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('equipments.index') }}" class="btn btn-primary float-right">Volver</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                @if($equipment->daily != null)
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-success btn-lg">Registrar mantenimiento diario</button>
                                        {!! Form::hidden('maintenance_type', 'diario') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-secondary btn-lg disabled" disabled="disabled">Registrar mantenimiento diario</button>
                                        {!! Form::hidden('maintenance_type', 'diario') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if($equipment->weekly != null)
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-success btn-lg">Registrar mantenimiento semanal</button>
                                        {!! Form::hidden('maintenance_type', 'semanal') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-secondary btn-lg disabled" disabled="disabled">Registrar mantenimiento semanal</button>
                                        {!! Form::hidden('maintenance_type', 'semanal') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if($equipment->monthly != null)
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-success btn-lg">Registrar mantenimiento mensual</button>
                                        {!! Form::hidden('maintenance_type', 'mensual') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-secondary btn-lg disabled" disabled="disabled">Registrar mantenimiento mensual</button>
                                        {!! Form::hidden('maintenance_type', 'mensual') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if($equipment->biannual != null)
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-success btn-lg">Registrar mantenimiento trimestral</button>
                                        {!! Form::hidden('maintenance_type', 'trimestral') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-secondary btn-lg disabled" disabled="disabled">Registrar mantenimiento trimestral</button>
                                        {!! Form::hidden('maintenance_type', 'trimestral') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if($equipment->biannual != null)
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-success btn-lg">Registrar mantenimiento semestral</button>
                                        {!! Form::hidden('maintenance_type', 'semestral') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-secondary btn-lg disabled" disabled="disabled">Registrar mantenimiento semestral</button>
                                        {!! Form::hidden('maintenance_type', 'semestral') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if($equipment->annual != null)
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-success btn-lg">Registrar mantenimiento anual</button>
                                        {!! Form::hidden('maintenance_type', 'anual') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::model($equipment, ['route' => ['equipments.maintenancestore', $equipment->id]]) !!}
                                        <button class="btn btn-secondary btn-lg disabled" disabled="disabled">Registrar mantenimiento anual</button>
                                        {!! Form::hidden('maintenance_type', 'anual') !!}
                                        {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Mantenimiento diario</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Realizó</th>
                                    <th>Supervisó</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daily as $d)
                                    <tr>
                                        <td>{{ $d->maintenance_date }}</td>
                                        <td>{{ $d->realizo->details->initials }}</td>
                                        <td>{{ $d->superviso->details->initials }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Mantenimiento semanal</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Realizó</th>
                                    <th>Supervisó</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($weekly as $d)
                                    <tr>
                                        <td>{{ $d->maintenance_date }}</td>
                                        <td>{{ $d->realizo->details->initials }}</td>
                                        <td>{{ $d->superviso->details->initials }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Mantenimientos mensuales, trimestrales, semestrales y anuales</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Mantenimiento</th>
                                    <th>Realizó</th>
                                    <th>Supervisó</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthly as $d)
                                    <tr>
                                        <td>{{ $d->maintenance_date }}</td>
                                        <td>{{ $d->type }}</td>
                                        <td>{{ $d->realizo->details->initials }}</td>
                                        <td>{{ $d->superviso->details->initials }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($quarterly as $d)
                                    <tr>
                                        <td>{{ $d->maintenance_date }}</td>
                                        <td>{{ $d->type }}</td>
                                        <td>{{ $d->realizo->details->initials }}</td>
                                        <td>{{ $d->superviso->details->initials }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($biannual as $d)
                                    <tr>
                                        <td>{{ $d->maintenance_date }}</td>
                                        <td>{{ $d->type }}</td>
                                        <td>{{ $d->realizo->details->initials }}</td>
                                        <td>{{ $d->superviso->details->initials }}</td>
                                    </tr>
                                @endforeach
                                @foreach ($annual as $d)
                                    <tr>
                                        <td>{{ $d->maintenance_date }}</td>
                                        <td>{{ $d->type }}</td>
                                        <td>{{ $d->realizo->details->initials }}</td>
                                        <td>{{ $d->superviso->details->initials }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Descarga de reporte</h4>
                        <hr>
                        {!! Form::open(['route' => 'equipments.maintenancereport']) !!}
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    {!! Form::label('month', 'Fecha del reporte') !!}
                                    {!! Form::month('month', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    {!! Form::hidden('equipment_id', $equipment->id) !!}
                                    <div class="invalid-feedback">
                                        Seleccione el mes que desea descargar
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    {!! Form::submit('Descargar', ['class' => 'btn btn-info btn-block']) !!}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('page_css')
@endsection

@section('page_scripts')
    <script>
        $(document).ready(function () {
            $('#equipments').DataTable({
                dom: '<"area-fluid"<"row"<"col"l><"col"B><"col"f>>>rtip',
                "columnDefs": [
                    { "type": "num", "targets": 0 }
                ],
                "order": [[ 0, "asc" ]],
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ],
                language: {
                    url: '/datatables.json'
                }
            });
        });
    </script>
@endsection