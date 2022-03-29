@extends('backend.layouts.app')

@section('title', __('Dashboard'))
@section('header-css')
    <link href="{{ url('/css/intlTelInput.css') }}" rel="stylesheet">
    <link href="{{ url('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="card vebo-content-card">
        {!! Form::open(['route'=>'admin.sales-companies.store', 'method'=>'post','enctype'=>'multipart/form-data','id'=>'dataForm']) !!}
        <div class="card-body">
            <h5 class="vebo-section-heading-title"><strong> Add New Sales Company</strong></h5>
            <div class="row mt-5 vebo-w100">
                <div class="vebo-logo-section vebo-m0">
                    <img src="https://wallpaperaccess.com/full/3853138.jpg" class="vebo-company-logo company-logo img img-thumbnail">
                </div>
                <div class="col-md-3 form-group custom-control-inline">
                    <div class="col-md-9">
                        {!! Form::label('company_logo','Company Logo',['class'=>'required-star']) !!}
                        <p class="text-secondary">
                            <label><i class="fa fa-cloud-upload-alt"></i> Upload Logo<input onchange="changeFile(this)" type="file" hidden></label>
                        </p>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('company_id','Company ID',['class'=>'required-star']) !!}
                    {!! Form::hidden('company_id',$companyId) !!}
                    <p class="text-secondary">{{ $companyId }}</p>
                </div>
            </div><!--row-->
            <div class="row mt-4">
                <div class="col-md-3 form-group">
                    {!! Form::label('company_name','Company Name',['class'=>'required-star']) !!}
                    {!! Form::text('company_name','',['class'=>'form-control required','placeholder'=>'Company name']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('language','Language',['class'=>'required-star']) !!}
                    {!! Form::select('language',$languages,'',['class'=>'form-control required','placeholder'=>'Select one']) !!}
                </div>
            </div><!--row-->
            <div class="row mt-4">
                <div class="col-md-12 form-group">
                    <h5>Company Address</h5>
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('street_name','Street Name',['class'=>'required-star']) !!}
                    {!! Form::text('street_name','',['class'=>'form-control required','placeholder'=>'Street name']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('street_number','Street Number',['class'=>'required-star']) !!}
                    {!! Form::text('street_number','',['class'=>'form-control required','placeholder'=>'Street number']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('zip_code','Zip Code',['class'=>'required-star']) !!}
                    {!! Form::text('zip_code','',['class'=>'form-control required','placeholder'=>'Zip code']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('city','City',['class'=>'required-star']) !!}
                    {!! Form::text('city','',['class'=>'form-control required','placeholder'=>'City']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('country','Country',['class'=>'required-star']) !!}
                    {!! Form::select('country',$countries,'',['class'=>'form-control required','placeholder'=>'Select one']) !!}
                </div>
            </div><!--row-->

            <div class="row mt-4">
                <div class="col-md-12 form-group">
                    <h5>Contact Person</h5>
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('contact_person_first_name','First Name',['class'=>'required-star']) !!}
                    {!! Form::text('contact_person_first_name','',['class'=>'form-control required','placeholder'=>'First name']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('contact_person_last_name','Last Name',['class'=>'required-star']) !!}
                    {!! Form::text('contact_person_last_name','',['class'=>'form-control required','placeholder'=>'Last name']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!! Form::label('contact_person_email','Email',['class'=>'required-star']) !!}
                    {!! Form::text('contact_person_email','',['class'=>'form-control required','placeholder'=>'Email']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('contact_person_phone_number','Phone Number',['class'=>'required-star']) !!}
                    {!! Form::tel('contact_person_phone_number','',['class'=>'form-control contact_person_phone_number required','id'=>'contact_person_phone_number']) !!}
                </div>
            </div><!--row-->

            <div class="row mt-4">
                <div class="col-md-12 form-group">
                    <h5>Optional Features</h5>
                </div>
                <div class="col-md-3 form-group">
                    <label><i class="fa fa-unlock"></i> API for Lock Connection</label>
                    <p><input name="is_api_lock_connection" type="checkbox" data-toggle="toggle" data-size="xs" data-on="Active" data-off="Inactive"></p>
                </div>
                <div class="col-md-3 form-group">
                    <label><i class="fa fa-bell"></i> Push Notification</label>
                    <p><input name="is_api_lock_connection" type="checkbox" data-toggle="toggle" data-size="xs" data-on="Active" data-off="Inactive"></p>
                </div>
                <div class="col-md-3 form-group">
                    <label><i class="fa fa-comment"></i> Feedback Option</label>
                    <p><input name="is_api_lock_connection" type="checkbox" data-toggle="toggle" data-size="xs" data-on="Active" data-off="Inactive"></p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12 form-group">
                    <h5>Accepted means of Payment</h5>
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('payment_methods','Choose Payment options',['class'=>'required-star']) !!}
                    {!! Form::select('payment_methods',$paymentMethods,'',['class'=>'form-control js-select2 payment_methods required','multiple' => 'multiple']) !!}
                    {!! Form::hidden('accepted_payment_methods','',['class'=>'accepted_payment_methods']) !!}
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
        {!! Form::close() !!}
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
