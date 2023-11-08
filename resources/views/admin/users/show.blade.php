@extends('layouts.app')

@section('title', 'Usuarios')

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
                                <h3>Detalle del usuario {{ $user->name }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            @if(isset($user->details->profile_image))
                                                <img class="img-responsive" src="/usuarios/images/{{ $user->details->profile_image }}" alt="{{ $user->details->profile_image }}" width="100%">
                                            @else
                                                <img src="/usuarios/images/sinimagen.png" alt="{{ $user->name }}" width="100%">
                                            @endif
                                            <div class="mt-3">
                                                
                                                <h4>{{ $user->name }}</h4>
                                                <p class="text-secondary mb-1">{{ $user->position }}</p>
                                                @isset($details)
                                                    <p class="text-gray text-sm">{{ $details->position }}</p>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nombre completo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Correo electrónico</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Teléfono celular</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ isset($user->details->phone) ? $user->details->phone : null }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Teléfono de emergencia</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ isset($user->details->emergency_phone) ? $user->details->emergency_phone : null }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Contacto de emergencia</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ isset($user->details->emergency_contact) ? $user->details->emergency_contact : null }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Dirección</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ isset($user->details->address) ? $user->details->address : null }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @can('Editar usuarios')
                                                    <a class="btn btn-primary btn-block" href="{{ route('users.edit', $user->id) }}">Editar</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('Ver expediente')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Expediente</h4>
                                        </div>
                                        <div class="card-header">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Documento</th>
                                                        <th style="text-align: right">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Acta de nacimiento</td>
                                                        <td>
                                                            <button type="button" id="btnmodal1" class="btn btn-secondary float-right" data-toggle="modal" data-target="#document">Agregar acta</button>
                                                            <a href="{{ asset('usuarios/exp/'. $user->id . '-Acta.pdf' ) }}" class='btn btn-warning float-right mr-2 ml-2'>Ver</a>
                                                            <a href="{{ route('users.upload', [$user->id, 1])}}" class='btn btn-danger float-right'>Eliminar</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Comprobante de domicilio</td>
                                                        <td>
                                                            <button type="button" id="btnmodal2" class="btn btn-secondary float-right" data-toggle="modal" data-target="#document">Agregar comprobante</button>
                                                            <a href="{{ asset('usuarios/exp/'. $user->id . '-Comp.pdf' ) }}" class='btn btn-warning float-right mr-2 ml-2'>Ver</a>
                                                            <a href="{{ route('users.upload', [$user->id, 1])}}" class='btn btn-danger float-right'>Eliminar</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>INE</td>
                                                        <td>
                                                            <button type="button" id="btnmodal3" class="btn btn-secondary float-right" data-toggle="modal" data-target="#document">Agregar INE</button>
                                                            <a href="{{ asset('usuarios/exp/'. $user->id . '-INE.pdf' ) }}" class='btn btn-warning float-right mr-2 ml-2'>Ver</a>
                                                            <a href="{{ route('users.upload', [$user->id, 1])}}" class='btn btn-danger float-right'>Eliminar</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Título y cédula</td>
                                                        <td>
                                                            <button type="button" id="btnmodal4" class="btn btn-secondary float-right" data-toggle="modal" data-target="#document">Agregar título</button>
                                                            <a href="{{ asset('usuarios/exp/'. $user->id . '-Tit.pdf' ) }}" class='btn btn-warning float-right mr-2 ml-2'>Ver</a>
                                                            <a href="{{ route('users.upload', [$user->id, 1])}}" class='btn btn-danger float-right'>Eliminar</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Constancias</td>
                                                        <td>
                                                            <button type="button" id="btnmodal5" class="btn btn-secondary float-right" data-toggle="modal" data-target="#document">Agregar constancias</button>
                                                            <a href="{{ asset('usuarios/exp/'. $user->id . '-Const.pdf' ) }}" class='btn btn-warning float-right mr-2 ml-2'>Ver</a>
                                                            <a href="{{ route('users.upload', [$user->id, 4])}}" class='btn btn-danger float-right'>Eliminar</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-danger btn-block">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alta de documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'users.upload', 'class' => "needs-validation", 'novalidate', 'files' => true]) !!}
                    <div class="row">
                        <div class="form-group col-sm-12">
                            {!! Form::label('file', 'Documento:') !!}
                            <div class="input-group">
                                <div class="custom-file">
                                    {!! Form::file('file', ['class' => 'custom-file-input', 'accept' => '.pdf']) !!}
                                    {!! Form::label('file', 'Seleccione un documento', ['class' => 'custom-file-label']) !!}
                                </div>
                                {!! Form::hidden('dc', null, ['class' => 'form-control']) !!}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </div>
                            <div class="invalid-feedback">
                                Seleccione un documento
                            </div>
                            @error('file')
                                <span class="text-danger">No ha seleccionado un documento</span>
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
    $(document).ready(function() {
        $("#btnmodal1").click(function() {
            var doc = 'Acta';
            $("input[name='dc']").val(doc);
            console.log(doc);
        });
        $("#btnmodal2").click(function() {
            var doc = 'Comp';
            $("input[name='dc']").val(doc);
            console.log(doc);
        });
        $("#btnmodal3").click(function() {
            var doc = 'INE';
            $("input[name='dc']").val(doc);
            console.log(doc);
        });
        $("#btnmodal4").click(function() {
            var doc = 'Tit';
            $("input[name='dc']").val(doc);
            console.log(doc);
        });
        $("#btnmodal5").click(function() {
            var doc = 'Const';
            $("input[name='dc']").val(doc);
            console.log(doc);
        });
    });
</script>
@endsection