@extends('backend.layouts.app')

@section('title', __('Dashboard'))
@section('header-css')
    <!-- <link href="{{ url('/css/intlTelInput.css') }}" rel="stylesheet"> -->
    <link href="{{ url('/css/intlInputPhone.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/custom.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="card vebo-content-card">
        {!! Form::open(['route'=>'admin.sales-companies-admin.store', 'method'=>'post','enctype'=>'multipart/form-data','id'=>'dataForm']) !!}
        <div class="card-body">

            <h5 class="vebo-section-heading-title"><strong> Edit Sales Company Admin Details</strong></h5>

            <div class="row mt-5 vebo-w100">
                <div class="col-md-3 form-group">
                    {!! Form::label('admin_id','Admin ID',['class'=>'']) !!}
                    {!! Form::hidden('admin_id',$adminId) !!}
                    <p class="text-secondary">{{ $adminId }}</p>
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('admin_id','Creation Date',['class'=>'']) !!}
                    {!! Form::hidden('created_date',$adminId) !!}
                    <p class="text-secondary">16.03.2022</p>
                </div>
            </div><!--row-->

            <div class="row mt-4">
                <div class="col-md-3 form-group">
                    {!! Form::label('sales_company','Sales company',['class'=>'required-star']) !!}
                    {!! Form::select('sales_company', $sales_companies, '',['class'=>'form-control required','placeholder'=>'Select company']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('language','Language',['class'=>'required-star']) !!}
                    {!! Form::select('language',$languages,'',['class'=>'form-control required','placeholder'=>'Select one']) !!}
                </div>
            </div><!--row-->

            <div class="row mt-4">
                <div class="col-md-3 form-group">
                    {!! Form::label('first_name','First Name',['class'=>'required-star']) !!}
                    {!! Form::text('first_name','',['class'=>'form-control required','placeholder'=>'First name']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('last_name','Last Name',['class'=>'required-star']) !!}
                    {!! Form::text('last_name','',['class'=>'form-control required','placeholder'=>'Last name']) !!}
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('email','E-mail',['class'=>'required-star']) !!}
                    {!! Form::text('email','',['class'=>'form-control required','placeholder'=>'eg. john@gmail.com']) !!}
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
<!-- <script src="{{ url('/js/intlTelInput.js') }}"></script> -->
<script src="{{ url('/js/intlInputPhone.min.js') }}"></script>

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
        let redirectURL = "{{ route('admin.sales-companies-admin.index') }}";

        Swal.fire({
            title: 'Discard Changes??',
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

        // $(document).on("change", ".vebo-switch", function(){
        //     $(this).closest("p").find('span.switch-text').html('Inactive');
        //     $(this).closest("p").find('span.slider').css('border', '1px solid #ABBECC');
        //     if($(this).prop("checked") == true)
        //     {
        //         $(this).prop("checked", true);
        //         $(this).closest("p").find('span.slider').css('border', '1px solid limeGreen');
        //         $(this).closest("p").find('span.switch-text').html('Active');

        //     }
        // });
    });

    $('.contact_person_phone_number').intlInputPhone();

    $(document).ready(function(){
        $("#payment_methods").select2({
            closeOnSelect:false,
            templateResult: formatState,
            templateSelection: formatState
        });

        function formatState (opt) {
            if (!opt.id) {
                return opt.text.toUpperCase();
            } 

            var optimage = $(opt.element).attr('data-image'); 

            if(!optimage){
                return opt.text.toUpperCase();
            } else {                    
                var $opt = $(
                '<span><img src="' + optimage + '" class="payment_methods_icon" /> ' + opt.text.toUpperCase() + '</span>'
                );
                return $opt;
            }
        };

    });
</script>
@endsection
