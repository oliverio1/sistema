<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catálogo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <style>
        @page { 
            size: letter landscape;
            margin-bottom: 4.4cm;
            margin-right: 1.4cm;
            margin-left: 1.4cm;
            margin-top: 1.9cm;
        }
        table {
            width: 100%;
        }
        #derecha {
            vertical-align: right;
            text-align: right;
        }
        tr {
            line-height: 14px;
            min-height: 14px;
            height: 10px;
            background: #e2edd9;
        }
        th {
            background-color:#551100;
            color: white;
            height: 30px;
        }
        td {
            padding-left: 10px;
        }
        tr:nth-child(even) {
            background-color: #ba7c39;
        }
        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 30px;
            color: #01AA9E;
            text-align: center;
            line-height: 15px;
        }
        .page-number:before {
            content: "Página " {counter(page)};
        }
        .fa {
            display: inline;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 1;
            font-family: FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        div.c {
           line-height: 50%;
        }
    </style>
    <body>
        <table>
            <thead>
                <tr>
                    <th style="font-size: 10px; padding-left:10px" width="5%">FOLIO</th>
                    <th style="font-size: 10px; padding-left:10px" width="20%">ESTUDIO</th>
                    <th style="font-size: 10px; padding-left:10px" width="10%">ENTREGA (DH)</th>
                    <th style="font-size: 10px; padding-left:10px" width="15%">ESPÉCIMEN</th>
                    <th style="font-size: 10px; padding-left:10px" width="50%">INDICACIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($studies as $study)
                    <tr>
                        <td style="font-size: 10px;" width="5%">{{ $study->code }}</td>
                        <td style="font-size: 10px;" width="15%">{{ $study->name }}</td>
                        <td style="font-size: 10px; text-align: center" width="8%">{{ $study->delivery }}</td>
                        <td style="font-size: 10px;" width="12%">
                            @foreach($study->specimens as $specimen)
                                {{ $specimen->name }}<br>
                            @endforeach
                        </td>
                        <td style="font-size: 10px;" width="60%">
                            @foreach($study->indications as $indication)
                                {{ $indication->name }}<br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>