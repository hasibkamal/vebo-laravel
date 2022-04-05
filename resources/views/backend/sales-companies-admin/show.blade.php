@extends('backend.layouts.app')

@section('title', __('Dashboard'))
@section('header-css')
    <link href="{{ url('/css/intlTelInput.css') }}" rel="stylesheet">
    <link href="{{ url('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="card vebo-content-card">
		{{-- <div class="row"> --}}
			<div class="col-md-12">
				<p class="ml-3 mt-3"> <a href="javascript:void(0)" onclick="history.back()"><i class="fa fa-long-arrow-left"></i> <strong> Go Back</strong></a></p>
			</div>
		{{-- </div> --}}

        <div class="card-body">
            <h4 class="vebo-section-heading-title"><strong>Sales Company Admin Details</strong></h4>
            <div class="row mt-5">
                <div class="col-md-3 offset-md-1">
                    <p><strong>Admin ID</strong></p>
                    <p>{!! $company_details->admin_id !!}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Creation Date</strong></p>
                    {{ date('d-m-Y', strtotime($company_details->created_at)) }}</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3 offset-md-1">
                    <p><strong>Sales Company</strong></p>
                    <p>{!! $company_details->sales_company !!}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Language</strong></p>
                    {!! $company_details->language !!}
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3 offset-md-1">
                    <p><strong>Name</strong></p>
                    <p>{!! $company_details->first_name !!} {!! $company_details->last_name !!}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>E-mail</strong></p>
                    {!! $company_details->email !!}
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-3 form-group">
                    <a href="{{ route('admin.sales-companies-admin.edit', $company_details->id) }}" class="btn btn-submit btn-primary btn-block"><i class="fa fa-pen"></i>  Edit</a>
                </div>
            </div>
        </div><!--card-body-->
    </div><!--card-->
@endsection
@section('footer-script')
<script src="{{ url('/js/proper.js') }}"></script>
<script src="{{ url('/js/intlTelInput.js') }}"></script>
<script src="{{ url('/js/select2.min.js') }}"></script>
<script src="{{ url('/js/custom.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click", ".slider", function(){
            return false;
        });

    });
</script>
@endsection
