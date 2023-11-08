<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Etiquetas de estudios</title>
    <style>
        @page {
            size:  2.125in 1.0in;
            margin: 3px 5px 3px 5px;
        }
        @media print {
            .pagebreak {
                page-break-after: always;
                margin: 5px 20px 5px 5px;
            }
            .page {
                margin: 5px 5px 5px 5px;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
            }
        }
    </style>
    <body>
        @foreach($studies as $study)
            <div class="pagebreak">
                <p style="font-size:9px; line-height: 55%"><strong>BLAB | {{ $study->folio }}</strong></p>
                <img style="width:100px; height:15px" src="data:image/png;base64,{!! DNS1D::getBarcodePNG($study->folio, 'C39') !!}" alt="barcode" />
                <p style="font-size:9px; line-height: 55%">{{ $study->clave ?? "" }} {{ $study->name }} {{ $study->pater }} {{ $study->mater }} ({{ $study->sex }}, {{ $study->age }})</p>
                <p style="font-size:9px; line-height: 55%">{{ $study->study }}</p>
            </div>
        @endforeach
    </body>
</html>
