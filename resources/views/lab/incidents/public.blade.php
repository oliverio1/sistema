<!DOCTYPE html>
<html lang="en">
<head>
    <title>Solicitudes y quejas BLab</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <h1>BLab</h1>
    <p>Formulario de quejas, sugerencias y solicitudes</p>
</div>

<div class="container">
    <div class="row">
        {!! Form::open(['route' => 'incidents.storepublic']) !!}
            <div class="card">
                <div class="card-body">
                    <div class="form-group col-sm-12">
                        {!! Form::label('name', 'Nombre:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        @error('name')
                            <span class="text-danger">Ingrese su nombre</span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('email', 'Correo electrónico:') !!}
                        {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        @error('email')
                            <span class="text-danger">Ingrese un correo</span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-lg-12">
                        {!! Form::label('description', 'Describa la solicitud o queja:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        @error('assigned')
                            <span class="text-danger">Describa su queja y/o sugerencia</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group col-sm-6 col-lg-6">
                        {!! Form::submit('Enviar', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    <div class="form-group col-sm-6 col-lg-6">
                        <a href="http://127.0.0.1:8000/" class="btn btn-info btn-block">Volver</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

</body>
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
</html>
