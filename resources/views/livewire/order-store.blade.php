<div>
    <div class="card-body">
        {!! Form::open(['route' => 'orders.store', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
            <div class="row">
                <div class="form-group col-sm-12">
                    {!! Form::label('client_id', 'Procedencia:') !!}
                    {{-- {!! Form::select('client_id', $clients, null, array('class'=>'form-control', 'placeholder'=>'Selecciona un cliente', 'wire:model.lazy'=>'client_id')) !!} --}}
                    <select id="client_id" name="client_id" class="form-control" wire:model.lazy="client">
                        <option>Selecciona un cliente</option>
                        @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Ingrese la procedencia
                    </div>
                    @error('client_id')
                        <span class="text-alert">Seleccione el cliente</span>
                    @enderror
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('clave', 'Clave externa:') !!}
                    {!! Form::text('clave', null, ['wire:model' => 'clave', 'class' => 'form-control']) !!}
                    <div class="invalid-feedback">
                        Ingrese la clave externa del paciente
                    </div>
                    @error('clave')
                        <span class="text-alert">La clave es obligatoria</span>
                    @enderror
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', null, ['wire:model' => 'name', 'class' => 'form-control', 'required' => 'required']) !!}
                    <div class="invalid-feedback">
                        Ingrese el nombre del paciente
                    </div>
                    @error('name')
                        <span class="text-alert">El nombre del paciente es obligatorio</span>
                    @enderror
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('pater', 'Apellido paterno:') !!}
                    {!! Form::text('pater', null, ['wire:model' => 'pater', 'class' => 'form-control']) !!}
                    <div class="invalid-feedback">
                        Ingrese el apellido paterno del paciente
                    </div>
                    @error('pater')
                        <span class="text-alert">El apellido paterno es obligatorio</span>
                    @enderror
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('mater', 'Apellido materno:') !!}
                    {!! Form::text('mater', null, ['wire:model' => 'mater', 'class' => 'form-control']) !!}
                    <div class="invalid-feedback">
                        Ingrese el apellido materno del paciente
                    </div>
                    @error('mater')
                        <span class="text-alert">El apellido materno es obligatorio</span>
                    @enderror
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('sex', 'Sexo:') !!}
                    {!! Form::select('sex', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino', 'Sin dato' => 'Sin dato'], null, array('wire:model' => 'sex', 'class' => 'form-control','placeholder'=>'Selecciona el tipo de estudio')) !!}
                    <div class="invalid-feedback">
                        Seleccione el sexo del paciente
                    </div>
                    @error('sex')
                        <span class="text-alert">El sexo del paciente es obligatorio</span>
                    @enderror
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
                    {!! Form::date('birthdate', null, ['wire:model' => 'birthdate', 'class' => 'form-control', 'required' => 'required', 'onchange' => 'calcularEdad(this.value)']) !!}
                    <div class="invalid-feedback">
                        Seleccione la fecha de nacimiento
                    </div>
                    @error('birthdate')
                        <span class="text-alert">La fecha de nacimiento es obligatoria</span>
                    @enderror
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('age', 'Edad:') !!}
                    {!! Form::text('age', null, ['wire:model' => 'age', 'class' => 'form-control', 'required' => 'required', 'onchange' => 'calcularBirthday(this.value)']) !!}
                    <div class="invalid-feedback">
                        Ingrese la edad del paciente
                    </div>
                    @error('age')
                        <span class="text-alert">La edad del paciente es obligatorio</span>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('phone', 'Teléfono:') !!}
                    {!! Form::text('phone', null, ['wire:model' => 'phone', 'class' => 'form-control']) !!}
                    <div class="invalid-feedback">
                        Ingrese el teléfono del paciente
                    </div>
                    @error('phone')
                        <span class="text-alert">El teléfono del paciente es obligatorio</span>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('mail', 'Correo electrónico:') !!}
                    {!! Form::text('mail', null, ['wire:model' => 'mail', 'class' => 'form-control']) !!}
                    <div class="invalid-feedback">
                        Ingrese el correo electrónico del paciente
                    </div>
                    @error('mail')
                        <span class="text-alert">El correo electrónico del paciente es obligatorio</span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label('medic_id', 'Médico:') !!}
                    {!! Form::select('medic_id', $medics, null, array('wire:model' => 'medic_id', 'class'=>'form-control', 'placeholder'=>'Selecciona un médico')) !!}
                    <div class="invalid-feedback">
                        Ingrese el médico
                    </div>
                    @error('medic_id')
                        <span class="text-alert">El médico es obligatorio</span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label('observation', 'Observaciones:') !!}
                    {!! Form::textarea('observation', null, ['wire:model' => 'observation', 'class' => 'form-control']) !!}
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
