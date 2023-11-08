<div>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Seleccionar</th>
                            <th>ID</th>
                            <th>Analito</th>
                            <th>Unidades</th>
                        </tr>
                        @foreach($analitos as $analito)
                            <tr>
                                <td><input type="radio" name="radio{{$analito->is}}" wire:click="agregar({{ $analito->id }})" id="{{ $analito->id }}"/></td>
                                <td>{{ chr(65 + $analito->orden) }}</td>
                                <td>{{ $analito->analito }}</td>
                                <td>{{ $analito->units }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    @if($referencias == null)
                    @else
                        @foreach($referencias as $ref)
                            @if($loop->first)
                                <h4>Valores de referencia para {{ $ref->analito }}</h4>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-hoover">
                        <tr>
                            <th width="10%">Sexo</th>
                            <th width="10%">Edad inicial</th>
                            <th width="10%">Edad final</th>
                            <th width="10%">Valor mínimo</th>
                            <th width="10%">Valor máximo</th>
                            <th width="40%">Texto que aparecerá en el reporte</th>
                            <th width="10%">Guardar</th>
                        </tr>
                        @foreach($referencias as $referencia)
                            <tr>
                                <td>{{ $referencia->sex }}</td>
                                <td>{{ $referencia->age_in }}</td>
                                <td>{{ $referencia->age_fin }}</td>
                                <td>{{ $referencia->min }}</td>
                                <td>{{ $referencia->text }}</td>
                                <td>{!! nl2br(e($referencia->text)) !!}</td>
                                <td><button class="btn btn-danger" wire:click="eliminar({{ $referencia->id }})"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                <select wire:model.defer="sex" class="form-control" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="Ambos">Ambos sexos</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                                @error('sex') <small style="color: red">Este campo es obligatorio</small> @enderror
                            </td>
                            <td><input required type="text" class="form-control" wire:model.defer="age_in">
                                @error('age_in') <small style="color: red">Este campo es obligatorio</small> @enderror
                            </td>
                            <td><input required type="text" class="form-control" wire:model.defer="age_fin">
                                @error('age_fin') <small style="color: red">Este campo es obligatorio</small> @enderror
                            </td>
                            <td><input required type="text" class="form-control" wire:model.defer="min" id="min">
                                @error('min') <small style="color: red">Este campo es obligatorio</small> @enderror
                            </td>
                            <td><input required type="text" class="form-control" wire:model.defer="max" id="max" onchange="texto()">
                                @error('max') <small style="color: red">Este campo es obligatorio</small> @enderror
                            </td>
                            <td><textarea style="width: 100%; height: 38px" wire:model.defer="text" id="textoref" class="form-control"></textarea>
                                @error('text') <small style="color: red">Este campo es obligatorio</small> @enderror
                            </td>
                            <td><button class="btn btn-success" wire:click="guardar()"><i class="fa fa-check"></i></button></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5><strong>Fórmula para calcular analitos</strong></h5>
                    <small>Si el analito se calcula, ingresa la formula que se utiliza para su cálculo<br/></small>
                    <small>Utiliza el ID del analito a calcular, así como los analitos que se utilicen para el cálculo<br/></small>
                </div>
                @if($calculos->count() == 0)
                @else
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="29%">Analito</th>
                                <th width="29%">Cálculo</th>
                                <th width="29%">Decimales</th>
                                <th width="13%">Eliminar cálculo</th>
                            </tr>
                            @foreach($calculos as $calculo)
                                <tr>
                                    <td>{{ $calculo->analito }}</td>
                                    <td>{{ $calculo->formula }}</td>
                                    <td>{{ $calculo->decimales }}</td>
                                    <td><button class="btn btn-danger" wire:click="eliminarCalculo({{ $calculo->id }})"><i class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Analito</label>
                            <input type="text" id="analito_calculo" wire:model="analito_calculo" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>Cálculo</label>
                            <input type="text" id="calculo" wire:model="calculo" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>Decimales</label>
                            <input type="text" id="decimales" wire:model="decimales" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label>Guardar cálculo</label>
                            <button class="btn btn-success btn-block" wire:click="agregarCalculo()"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('studies.index') }}" class="btn btn-info btn-block">Volver al listado de estudios</a>
</div>

@push('js')
    <script>
        function texto() {
            var min = $("#min").val();
            var max = $("#max").val();
            var t = min+' - '+max;
            @this.set('text', t);
            return $('#textoref').val(min+' - '+max);
        }
    </script>
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
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
@endpush
