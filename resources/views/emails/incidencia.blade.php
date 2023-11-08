<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Reporte de incidencia</h1>
    <hr>
    <p>Estimado {{ $info->name }}, le agradecemos el reporte que ha generado.</p>
    <p>Se le ha asignado el ticket #{{ $info->id }}. Con este # de ticket usted podra dar seguimiento al estatus de su incidencia.</p>
    <br>
    <p>El personal de Laboratorio BLab comenzará de inmediato a dar seguimiento a la incidencia para tener una respuesta pronta.</p>
</body>
</html>