@php
$establishment = $document->establishment;
$establishment__ = \App\Models\Tenant\Establishment::find($document->establishment_id);
$logo = $establishment__->logo ?? $company->logo;

if ($logo === null && !file_exists(public_path("$logo}"))) {
    $logo = "{$company->logo}";
}

if ($logo) {
    $logo = "storage/uploads/logos/{$logo}";
    $logo = str_replace("storage/uploads/logos/storage/uploads/logos/", "storage/uploads/logos/", $logo);
}


    $customer = $document->customer;
    //$path_style = app_path('CoreFacturalo'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
    $tittle = $document->prefix.'-'.str_pad($document->number ?? $document->id, 8, '0', STR_PAD_LEFT);
@endphp
<html>
<head>
    {{--<title>{{ $tittle }}</title>--}}
    {{--<link href="{{ $path_style }}" rel="stylesheet" />--}}
</head>
<body>
<table class="full-width">
    <tr>
        @if($company->logo)
            <td width="20%">
                <div class="company_logo_box">
                    <img src="data:{{mime_content_type(public_path("storage/uploads/logos/{$company->logo}"))}};base64, {{base64_encode(file_get_contents(public_path("storage/uploads/logos/{$company->logo}")))}}" alt="{{$company->name}}" class="company_logo" style="max-width: 150px;">
                </div>
            </td>
        @else
            <td width="20%">
                {{--<img src="{{ asset('logo/logo.jpg') }}" class="company_logo" style="max-width: 150px">--}}
            </td>
        @endif
        <td width="50%" class="pl-3">
            <div class="text-left">
                <h4 class="">{{ $company->name }}</h4>
                <h5>{{ 'RUC '.$company->number }}</h5>
                <h6 style="text-transform: uppercase;">
                    {{ ($establishment->address !== '-')? $establishment->address : '' }}
                    {{ ($establishment->district_id !== '-')? ', '.$establishment->district->description : '' }}
                    {{ ($establishment->province_id !== '-')? ', '.$establishment->province->description : '' }}
                    {{ ($establishment->department_id !== '-')? '- '.$establishment->department->description : '' }}
                </h6>
                <h6>{{ ($establishment->email !== '-')? $establishment->email : '' }}</h6>
                <h6>{{ ($establishment->telephone !== '-')? $establishment->telephone : '' }}</h6>
            </div>
        </td>
        <td width="30%" class="border-box py-4 px-2 text-center">
            <h5 class="text-center">{{ get_document_name('quotation', 'Cotización') }}</h5>
            <h3 class="text-center">{{ $tittle }}</h3>
        </td>
    </tr>
</table>
<table class="full-width mt-5">
    <tr>
        <td width="15%">Cliente:</td>
        <td width="45%">{{ $customer->name }}</td>
        <td width="25%">Fecha de emisión:</td>
        <td width="15%">{{ $document->date_of_issue->format('Y-m-d') }}</td>
    </tr>
    <tr>
        <td>{{ $customer->identity_document_type->description }}:</td>
        <td>{{ $customer->number }}</td>
    </tr>
    @if ($customer->address !== '')
    <tr>
        <td class="align-top">Dirección:</td>
        <td colspan="3">
            {{ $customer->address }}
            {{ ($customer->district_id !== '-')? ', '.$customer->district->description : '' }}
            {{ ($customer->province_id !== '-')? ', '.$customer->province->description : '' }}
            {{ ($customer->department_id !== '-')? '- '.$customer->department->description : '' }}
        </td>
    </tr>
    @endif
</table>

<table class="full-width mt-3">
    @if ($document->description)
        <tr>
            <td width="15%" class="align-top">Descripción: </td>
            <td width="85%">{{ $document->description }}</td>
        </tr>
    @endif
</table>

{{-- <table class="full-width mt-3">
    @if ($document->purchase_order)
        <tr>
            <td width="25%">Orden de compra: </td>
            <td>:</td>
            <td class="text-left">{{ $document->purchase_order }}</td>
        </tr>
    @endif
</table> --}}

@if ($document->guides)
<br/>
{{--<strong>Guías:</strong>--}}
<table>
    @foreach($document->guides as $guide)
        <tr>
            @if(isset($guide->document_type_description))
            <td>{{ $guide->document_type_description }}</td>
            @else
            <td>{{ $guide->document_type_id }}</td>
            @endif
            <td>:</td>
            <td>{{ $guide->number }}</td>
        </tr>
    @endforeach
</table>
@endif

<table class="full-width mt-10 mb-10">
    <thead class="">
    <tr class="bg-grey">
        <th class="border-top-bottom text-center py-2" width="8%">Cant.</th>
        <th class="border-top-bottom text-center py-2" width="8%">Unidad</th>
        <th class="border-top-bottom text-left py-2">Descripción</th>
        <th class="border-top-bottom text-right py-2" width="12%">P.Unit</th>
        <th class="border-top-bottom text-right py-2" width="8%">Dto.</th>
        <th class="border-top-bottom text-right py-2" width="12%">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($document->items as $row)
        <tr>
            <td class="text-center align-top">
                @if(((int)$row->quantity != $row->quantity))
                    {{ $row->quantity }}
                @else
                    {{ number_format($row->quantity, 0) }}
                @endif
            </td>
            <td class="text-center align-top">{{symbol_or_code( symbol_or_code($row->item->unit_type_id))}}</td>
            <td class="text-left">
                {!!$row->item->description!!} @if (!empty($row->item->presentation)) {!!$row->item->presentation->description!!} @endif
                @if($row->attributes)
                    @foreach($row->attributes as $attr)
                        <br/><span style="font-size: 9px">{!! $attr->description !!} : {{ $attr->value }}</span>
                    @endforeach
                @endif
                @if($row->discounts)
                    @foreach($row->discounts as $dtos)
                        <br/><span style="font-size: 9px">{{ $dtos->factor * 100 }}% {{$dtos->description }}</span>
                    @endforeach
                @endif
                  @if($row->item !== null && property_exists($row->item,'extra_attr_value') && $row->item->extra_attr_value != '')
                    <br/><span style="font-size: 9px">{{$row->item->extra_attr_name}}: {{ $row->item->extra_attr_value }}</span>
                @endif
            </td>
            <td class="text-right align-top">{{ number_format($row->unit_price, 2) }}</td>
            <td class="text-right align-top">
                @if($row->discounts)
                    @php
                        $total_discount_line = 0;
                        foreach ($row->discounts as $disto) {
                            $total_discount_line = $total_discount_line + $disto->amount;
                        }
                    @endphp
                    {{ number_format($total_discount_line, 2) }}
                @else
                0
                @endif
            </td>
            <td class="text-right align-top">{{ number_format($row->total, 2) }}</td>
        </tr>
        <tr>
            <td colspan="6" class="border-bottom"></td>
        </tr>
    @endforeach
        @if($document->total_exportation > 0)
            <tr>
                <td colspan="5" class="text-right font-bold">Op. Exportación: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_exportation, 2) }}</td>
            </tr>
        @endif
        @if($document->total_free > 0)
            <tr>
                <td colspan="5" class="text-right font-bold">Op. Gratuitas: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_free, 2) }}</td>
            </tr>
        @endif
        @if($document->total_unaffected > 0)
            <tr>
                <td colspan="5" class="text-right font-bold">Op. Inafectas: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_unaffected, 2) }}</td>
            </tr>
        @endif
        @if($document->total_exonerated > 0)
            <tr>
                <td colspan="5" class="text-right font-bold">Op. Exoneradas: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_exonerated, 2) }}</td>
            </tr>
        @endif
        @if($document->total_taxed > 0)
            <tr>
                <td colspan="5" class="text-right font-bold">Op. Gravadas: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_taxed, 2) }}</td>
            </tr>
        @endif
        @if($document->total_discount > 0)
            <tr>
                <td colspan="5" class="text-right font-bold">{{(($document->total_prepayment > 0) ? 'Anticipo':'Descuento TOTAL')}}: {{ $document->currency_type->symbol }}</td>
                <td class="text-right font-bold">{{ number_format($document->total_discount, 2) }}</td>
            </tr>
        @endif
        <tr>
            <td colspan="5" class="text-right font-bold">IGV: {{ $document->currency_type->symbol }}</td>
            <td class="text-right font-bold">{{ number_format($document->total_igv, 2) }}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right font-bold">Total a pagar: {{ $document->currency_type->symbol }}</td>
            <td class="text-right font-bold">{{ number_format($document->total, 2) }}</td>
        </tr>
    </tbody>
</table>
<table class="full-width">
    <tr>
        {{-- <td width="65%">
            @foreach($document->legends as $row)
                <p>Son: <span class="font-bold">{{ $row->value }} {{ $document->currency_type->description }}</span></p>
            @endforeach
            <br/>
            <strong>Información adicional</strong>
            @foreach($document->additional_information as $information)
                <p>{{ $information }}</p>
            @endforeach
        </td> --}}
    </tr>
</table>
</body>
</html>
