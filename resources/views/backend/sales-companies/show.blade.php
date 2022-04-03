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
            <h4 class="vebo-section-heading-title"><strong>Sales Company Details</strong></h4>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://wallpaperaccess.com/full/3853138.jpg" class="rounded-circle" height="75" width="75">
                        </div>
                        <div class="col-md-8">
                            <p><strong>{{ $company_details->company_name }}</strong> <br>
                            Language:{{ $company_details->language_name }} <br>
                            Company ID:{{ $company_details->company_id }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <p><strong>Company Address</strong> <br>
                        {{ $company_details->street_name }} {{ $company_details->street_number }}, {{ $company_details->zip_code }}<br>
                        {{ $company_details->city }}, {{ $company_details->country_name }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Creation Date</strong> <br>
                    {{ date('d-m-Y', strtotime($company_details->created_at)) }}</p>
                </div>
            </div>
        
            <div class="row mt-5">
                <div class="col-md-12 form-group">
                    <h5>Contact Person</h5>
                </div>
                <div class="col-md-4">
                    <p><strong>Name</strong> <br>
                    {{ $company_details->contact_person_first_name }} {{ $company_details->contact_person_last_name }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Email</strong> <br>
                    {{ $company_details->contact_person_email }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Phone Number</strong> <br>
                    {{ $company_details->contact_person_phone_number }}</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 form-group">
                    <h5>Optional Features</h5>
                </div>
                <div class="col-md-4">
                    <label><i class="fa fa-unlock"></i> API for Lock Connection</label><br>
                    <label class="switch">
                        <input type="checkbox" <?= (isset($company_details->is_api_lock_connection) && $company_details->is_api_lock_connection == 1)?'checked':'';?>>
                        <span class="slider"></span>
                    </label>
                    <span class="switch-text"><?= (isset($company_details->is_api_lock_connection) && $company_details->is_api_lock_connection == 1)?'Active':'Inactive';?></span>
                </div>
                <div class="col-md-4">
                    <label><i class="fa fa-bell"></i> Push Notification</label><br>
                    <label class="switch">
                        <input type="checkbox" <?= (isset($company_details->is_push_notification) && $company_details->is_push_notification == 1)?'checked':'';?>>
                        <span class="slider"></span>
                    </label>
                    <span class="switch-text"><?= (isset($company_details->is_push_notification) && $company_details->is_push_notification == 1)?'Active':'Inactive';?></span>
                </div>
                <div class="col-md-4">
                    <label><i class="fa fa-comment"></i> Feedback Option</label><br>
                    <label class="switch">
                        <input type="checkbox" <?= (isset($company_details->is_feedback_option) && $company_details->is_feedback_option == 1)?'checked':'';?>>
                        <span class="slider"></span>
                    </label>
                    <span class="switch-text"><?= (isset($company_details->is_feedback_option) && $company_details->is_feedback_option == 1)?'Active':'Inactive';?></span>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 form-group">
                    <h5>Payment Methods</h5>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-3 form-group">
                    <button type="submit" class="btn btn-submit btn-primary btn-block">Save</button>
                </div>
                <div class="col-md-3 form-group">
                    <a href="{{ route('admin.sales-companies.index') }}" class="btn action-cancel btn-secondary btn-block">Cancel</a>
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
    function changeFile(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('.company-logo').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document.body).on('click', '.action-cancel', function (ev) {
        ev.preventDefault();
        let redirectURL = "{{ route('admin.sales-companies.index') }}";

        Swal.fire({
            title: 'Discard Changes?',
            text: "If you go back without saving, \n all changes will be discarded. Are you sure \n you really want to discard the changes?",
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: "No",
            confirmButtonClass: "btn-primary",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = redirectURL;
            }
        })
    });

    $(document).ready(function () {
        /**********************
         VALIDATION START HERE
         **********************/
        $('#dataForm').validate({
            errorPlacement: function () {
                $( ".btn-submit" ).prop( "disabled", false );
            },
            invalidHandler: function(form, validator) {
                let errors = validator.numberOfInvalids();
                if(errors){
                    Swal.fire({
                        title: 'Missing mandatory fields',
                        width: 500,
                        text: 'Please fill in all required fields.',
                    })
                }
            }
        });

        $('.payment_methods').on('change',function (){
            let selectedPaymentMethods = $(this).val();
            $('.accepted_payment_methods').val(selectedPaymentMethods);
        });
    });

    let internationalTelephoneField = document.querySelector("#contact_person_phone_number");
    window.intlTelInput(internationalTelephoneField, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
        // separateDialCode: true,
        utilsScript: "{{ url('/js/IntlTelUtils.js') }}",
    });
</script>
@endsection
