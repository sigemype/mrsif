@extends('tenant.layouts.app')

@push('styles')
    <style type="text/css">
        .v-modal {
            opacity: 0.2 !important;
        }
        .border-custom {
            border-color: rgba(0,136,204, .5) !important;
        }
        @media only screen and (min-width: 768px) {
        	.inner-wrapper {
			    padding-top: 60px !important;
			}
        }
        .card-header {
		    border-radius: 0px 0px 0px !important;
		}
    </style>
@endpush
<?php
    //dd($api_token);
?>
@section('content')
    <tenant-documents-invoice-generate
    :suscriptionames="{{ $suscriptionames }}"
        :is_contingency="{{ json_encode($is_contingency) }}"
        :type-user="{{json_encode(Auth::user()->type)}}"
        :establishment ="{{ json_encode($establishment)}}"
        :api_token ="{{ json_encode($api_token) }}"
        :establishment_auth ="{{ json_encode($establishment_auth)}}"
        :auth-user="{{json_encode(Auth::user()->getDataOnlyAuthUser())}}"
        :configuration="{{\App\Models\Tenant\Configuration::getPublicConfig()}}"
        :document-id="{{ $documentId ?? 0 }}"
        :quotations_optional="{{ json_encode($quotations_optional) }}"
        :quotations_optional_value="{{ json_encode($quotations_optional_value) }}"
        :is-update="{{ json_encode($isUpdate ?? false) }}"
        :table="{{ json_encode($table ?? null) }}"
        :table-id="{{ json_encode($table_id ?? null) }}"
        :id-user="{{json_encode(Auth::user()->id)}}"></tenant-documents-invoice-generate>
@endsection

@push('scripts')
<script type="text/javascript">
	var count = 0;
	$(document).on("click", "#card-click", function(event){
		count = count + 1;
		if (count == 1) {
			$("#card-section").removeClass("card-collapsed");
		}
	});
</script>

    <!-- QZ -->
    <script src="{{ asset('js/sha-256.min.js') }}"></script>
    <script src="{{ asset('js/qz-tray.js') }}"></script>
    <script src="{{ asset('js/rsvp-3.1.0.min.js') }}"></script>
    <script src="{{ asset('js/jsrsasign-all-min.js') }}"></script>
    <script src="{{ asset('js/sign-message.js') }}"></script>
    <script src="{{ asset('js/function-qztray.js') }}"></script>
    <!-- END QZ -->

@endpush
