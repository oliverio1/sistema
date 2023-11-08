<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de temperaturas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #circlered {
            display: inline-block;
            background: red;
            width: 20px;
            height: 20px;
        }
        #circlegreen {
            display: inline-block;
            background: green;
            width: 20px;
            height: 20px;
        }
        #circleyellow {
            display: inline-block;
            background: yellow;
            width: 20px;
            height: 20px;
        }
        .diagonalCross2 {
            background: linear-gradient(to bottom right, #fff calc(50% - 1px), black , #fff calc(50% + 1px) )
        }
        @page { size: letter landscape; }
    </style>
    <body>
        <table width="100%">
            <thead>
                <tr>
                    <th width="20%">BAGC</th>
                    <th width="60%">TEMPERATURAS DE {{ $thermometer->name }}</th>
                    <th width="20%">CÓDIGO<br>{{ $thermometer->format_code }}<br>FECHA DE EMISIÓN<br>31 AGOSTO 2016</th>
                </tr>
            </thead>
        </table>
        <table width="100%">
            <thead>
                <tr>
                    <th width="10%"></th>
                    <th width="20%">Año: {{ $year }}</th>
                    <th width="20%">Mes: 
                        {{ $mes == '01' ? 'Enero' : ($mes == '02' ? 'Febrero' : ($mes == '03' ? 'Marzo' : ($mes == '04' ? 'Abril' : ($mes == '05' ? 'Mayo' : ($mes == '06' ? 'Junio' : ($mes == '07' ? 'Julio' : ($mes == '08' ? 'Agosto' : ($mes == '09' ? 'Septiembre' : ($mes == '10' ? 'Octubre' : ($mes == '11' ? 'Noviembre' : 'Diciembre')))))))))) }}
                    </th>
                    <th width="30%">Clave del equipo: {{ $thermometer->code }}</th>
                    <th width="20%"></th>
                </tr>
            </thead>
        </table>
        <br>
        @if($cuantos == 0)
            <div>
                <p>No hay registro de temperaturas</p>
            </div>
        @else
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <th colspan="32">REGISTRO DE TEMPERATURAS DEL MES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="font-size: 10px";>Fecha</th>
                        @for($i = 0; $i < 31; $i++)
                            <td style="font-size: 10px";>{{ $i+1 }}</td>
                        @endfor
                    </tr>
                    <tr>
                        <th style="font-size: 10px";>Temperatura 1</th>
                        @for($i = 1; $i < 32; $i++)
                            <td style="{{ !in_array($i,$days) ? 'background-color:#FF0000;' : 'font-size: 10px;'}}">{{ in_array($i,$days) ? $temperature1[$i] : '' }}</td>
                        @endfor
                    </tr>
                    <tr>
                        <th style="font-size: 10px";>Temperatura 2</th>
                        @for($i = 1; $i < 32; $i++)
                            <td style="{{ !in_array($i,$days) ? 'background-color:#FF0000;' : 'font-size: 10px;'}}">{{ in_array($i,$days) ? $temperature2[$i] : '' }}</td>
                        @endfor
                    </tr>
                    <tr>
                        <th style="font-size: 10px";>Temperatura 3</th>
                        @for($i = 1; $i < 32; $i++)
                            <td style="{{ !in_array($i,$days) ? 'background-color:#FF0000;' : 'font-size: 10px;'}}">{{ in_array($i,$days) ? $temperature3[$i] : '' }}</td>
                        @endfor
                    </tr>
                    <tr>
                        <th style="font-size: 10px";>Realizó</th>
                        @for($i = 1; $i < 32; $i++)
                            <td style="{{ !in_array($i,$days) ? 'background-color:#FF0000;' : 'font-size: 10px;'}}">{{ in_array($i,$days) ? $realizo[$i]->details->initials : '' }}</td>
                        @endfor
                    </tr>
                    <tr>
                        <th style="font-size: 10px";>Supervisó</th>
                        @for($i = 1; $i < 32; $i++)
                            <td style="{{ !in_array($i,$days) ? 'background-color:#FF0000;' : 'font-size: 10px;'}}">{{ in_array($i,$days) ? $superviso[$i]->details->initials : '' }}</td>
                        @endfor
                    </tr>
                </tbody>
            </table>
        @endif
    </body>
</html>


