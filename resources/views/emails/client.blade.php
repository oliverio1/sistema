<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta de cliente</title>
</head>
<body>
    <h1>Alta de cliente</h1>
    <hr>
    <p>Estimado {{ $client->name }}, le agradecemos la confianza que deposita en Laboratorio Clínico de Referencia GUMAPO.</p>
    <p>Tenga la certeza que el personal opera con ética profesional para ofrecerle un servicio de excelencia.</p>
    <p>A continuación le compartimos las credenciales de acceso al sistema.</p>
    <p><strong>Usuario: </strong>{{ $client->email }}</p>
    <p><strong>Contraseña: </strong>{{ $random }}</p>
    <hr>
    <h4>Laboratorio B-Lab.</h4>
    <p>Nos mueve tu salud!</p>
</body>
</html>