@php
    $path_style = app_path('CoreFacturalo'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
@endphp
<head>
    <link href="{{ $path_style }}" rel="stylesheet" />
</head>
<body>
<table class="full-width">
    <tr>
        <td class="text-center desc font-bold">Representación impresa del Comprobante de Pago Electrónico. <br/>Esta puede ser consultada en {!! url('/buscar') !!}</td>
        @isset($document->qr)
            @isset($document->hash)
            <td width="35%" class="text-right">
                <img src="data:image/png;base64, {{ $document->qr }}" style="margin-right: -0px;" />
                <p style="font-size: 9px">Código Hash: {{ $document->hash }}</p>
            </td>
            @endisset
        @endisset
    </tr>
</table>
</body>