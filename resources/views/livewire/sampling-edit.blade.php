<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Edición de pacientes</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! Form::model($order, ['route' => ['orders.updateSampling', $order], 'method' => 'put', 'class' => 'needs-validation','novalidate', 'files' => true]) !!}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!! Form::label('client_id', 'Procedencia:') !!}
                        <input type="readonly" value="{{ $order->client->name }}" class="form-control" readonly>
                        <div class="invalid-feedback">
                            Ingrese la procedencia
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('name', 'Nombre:') !!}
                        {!! Form::text('name', null, ['wire:model' => 'name', 'class' => 'form-control', 'required' => 'required']) !!}
                        <div class="invalid-feedback">
                            Ingrese el nombre del paciente
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('sex', 'Sexo:') !!}
                        {!! Form::select('sex', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino', 'Sin dato' => 'Sin dato'], null, array('wire:model' => 'sex', 'class' => 'form-control','placeholder'=>'Selecciona el tipo de estudio')) !!}
                        <div class="invalid-feedback">
                            Seleccione el sexo del paciente
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('age', 'Edad:') !!}
                        {!! Form::text('age', null, ['wire:model' => 'age', 'class' => 'form-control', 'required' => 'required', 'onchange' => 'calcularBirthday(this.value)']) !!}
                        <div class="invalid-feedback">
                            Ingrese la edad del paciente
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('observation', 'Observaciones:') !!}
                        {!! Form::textarea('observation', null, ['wire:model' => 'observation', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-12">
            
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#estudios">
                            Agregar estudios
                        </button>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <table id="detalles" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Estudio</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('orders.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="modal fade" id="estudios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selección de estudios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="estos" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Agregar</th>
                                <th>Folio</th>
                                <th>Estudio</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studies as $study)
                                <tr>
                                    <td><button class="btn btn-success" onclick="agregarEstudio('{{ $study->code }}','{{ $study->name }}','{{ $study->price }}')"><i class="fa fa-plus"></i></button></td>
                                    <td>{{ $study->code }}</td>
                                    <td>{{ $study->name }}</td>
                                    <td>{{ $study->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
