@extends('tenant.layouts.app')

@section('content')

    <tenant-report-purchases-index
        @if(isset($apply_conversion_to_pen))
            :apply-conversion-to-pen="{{ json_encode($apply_conversion_to_pen) }}"
        @endif
        :configuration="{{\App\Models\Tenant\Configuration::getPublicConfig()}}"
    ></tenant-report-purchases-index>

@endsection