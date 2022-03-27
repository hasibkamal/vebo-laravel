@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="card">
        {!! Form::open(['route'=>'admin.sales-companies.store', 'method'=>'post','enctype'=>'multipart/form-data','id'=>'dataForm']) !!}
        <div class="card-body">
            <h5><strong> Add New Sales Company</strong></h5>
            <div class="row mt-5">
                <div class="col-md-3 form-group custom-control-inline">
                    <div class="col-md-3 pl-0">
                        <img src="https://wallpaperaccess.com/full/3853138.jpg" class="company-logo img img-thumbnail" style="border-radius: 65px; height: 65px; width: 65px;">
                    </div>
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
                    {!! Form::text('contact_person_phone_number','',['class'=>'form-control required','placeholder'=>'Phone number']) !!}
                </div>
            </div><!--row-->

            <div class="row mt-4">
                <div class="col-md-12 form-group">
                    <h5>Optional Features</h5>
                </div>
                <div class="col-md-3 form-group">
                    <label><i class="fa fa-lock-open"></i> API for Lock Connection</label>
                    <p><input name="is_api_lock_connection" type="checkbox" data-toggle="toggle" data-size="xs" data-on="Active" data-off="Inactive"></p>
                </div>
                <div class="col-md-3 form-group">
                    <label><i class="fa fa-bell"></i> Push Notification</label>
                    <p><input name="is_api_lock_connection" type="checkbox" data-toggle="toggle" data-size="xs" data-on="Active" data-off="Inactive"></p>
                </div>
                <div class="col-md-3 form-group">
                    <label><i class="fa fa-circle"></i> Feedback Option</label>
                    <p><input name="is_api_lock_connection" type="checkbox" data-toggle="toggle" data-size="xs" data-on="Active" data-off="Inactive"></p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12 form-group">
                    <h5>Accepted means of Payment</h5>
                </div>
                <div class="col-md-3 form-group">
                    {!! Form::label('accepted_payment_methods','Choose Payment options',['class'=>'required-star']) !!}
                    {!! Form::select('accepted_payment_methods',$paymentMethods,'',['class'=>'form-control required','placeholder'=>'Select one']) !!}
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-3 form-group">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
                <div class="col-md-3 form-group">
                    <a href="{{ route('admin.sales-companies.index') }}" class="btn btn-secondary btn-block">Cancel</a>
                </div>
            </div>
        </div><!--card-body-->
        {!! Form::close() !!}
    </div><!--card-->
@endsection
@section('footer-script')
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
</script>
@endsection
