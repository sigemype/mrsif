@php
    $path_style = app_path('CoreFacturalo'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
@endphp
<head>
    <link href="{{ $path_style }}" rel="stylesheet" />
</head>
<body>
<table class="full-width">
    @php
    $company = \App\Models\Tenant\Company::first();
@endphp
@if ($company->footer_logo)
    @php
        $footer_logo = "storage/uploads/logos/{$company->footer_logo}";
    @endphp
    <tr>
        <td class="text-center pt-5">
            <img style="max-height: 40px;"
                src="data:{{ mime_content_type(public_path("{$footer_logo}")) }};base64, {{ base64_encode(file_get_contents(public_path("{$footer_logo}"))) }}"
                alt="{{ $company->name }}">
        </td>
    </tr>
@endif
@if ($company->footer_text_template)
    <tr>
        <td class="text-center desc pt-5">
            {!! func_str_find_url($company->footer_text_template) !!}
        </td>
    </tr>
@endif
    <tr>
        <td class="text-center desc font-bold">Representación impresa del Comprobante de Pago Electrónico. <br/>Esta puede ser consultada en {!! url('/buscar') !!}</td>
    </tr>
</table>
</body>