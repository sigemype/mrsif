@extends('tenant.layouts.app')

@section('content')
    <tenant-configurations-shortcuts :type-user="{{ json_encode(Auth::user()->type) }}"
        :configuration="{{ \App\Models\Tenant\Configuration::getPublicConfig() }}"></tenant-configurations-shortcuts>
@endsection
