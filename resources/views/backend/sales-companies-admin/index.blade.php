@extends('backend.layouts.app')
@section('title', __('Sales Companies Admins'))
@section('header-css')
    {!! Html::style('css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('css/buttons.dataTables.min.css') !!}
@endsection
@section('content')
    <div class="card vebo-border-none">
        <div class="card-header vebo-border-none">
            <div class="row">
                <h5 class="vebo-section-title">Sales Companies admins</h5>
            </div>
            <div class="row">
                <div class="col-sm-8 pl-0">
                     <input class="form-control" type="text" placeholder="Search by company name" aria-label="Search">
                </div><!--col-->
                <div class="col-sm-4 pull-right">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.sales-companies.create') }}" class="btn btn-sm btn-success vebo-create-btn" title="Create new"
                            data-original-title="Create New">
                            <i class="fa fa-plus"></i> Add New Sales Company Admin
                        </a>
                    </div>
                </div><!--col-->
            </div>
        </div>
        <div class="card-body">
            <div class="row vebo-filter-bg vebo-filter-section">
                <div class="col-sm-10 pull-left vebo-filter-options">
                    {!! Form::open(['url'=>'admin/sales-companies', 'method'=>'get', 'class'=>'filter-form']) !!}
                    <div class="row vebo-filter-row vebo-display-none">
                        <div class="col-sm-3">
                            {!! Form::label('created_at','Created Date',['class'=>'']) !!}
                            {!! Form::date('created_at',$params['created_at']??'',['class'=>'form-control filter-sales-companies','placeholder'=>'']) !!}
                        </div>
                        {{-- <div class="col-sm-3">
                            {!! Form::label('sales_company','Sales Company',['class'=>'']) !!}
                            {!! Form::select('sales_company',$sales_companies,$params['sales_company']??'',['class'=>'form-control filter-sales-companies']) !!}
                        </div> --}}
                        {{-- <div class="col-sm-3">
                            {!! Form::label('city','City',['class'=>'']) !!}
                            {!! Form::select('city',$cities,$params['city']??'',['class'=>'form-control filter-sales-companies']) !!}
                        </div> --}}
                        {{-- <div class="col-sm-3">
                            {!! Form::label('status','Status',['class'=>'']) !!}
                            {!! Form::select('status',$status,$params['status']??'',['class'=>'form-control filter-sales-companies']) !!}
                        </div> --}}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-2 pull-right">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="javascript:void(0)" class="btn btn-sm btn-success vebo-filter-btn" title="Filter"
                            data-original-title="Create New">
                            <i class="fa fa-filter"></i> Filter
                        </a>
                    </div>
                </div><!--col-->
            </div>
            <div class="row mt-4">
                <div class="col">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Creation Date</th>
                            <th scope="col">Admin Id</th>
                            <th scope="col">Sales Company</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail Address</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody class="table-light">
                          <tr>
                            <th scope="row">2021.09.07</th>
                            <td>123</td>
                            <td>ABC limited</td>
                            <td>ROBI</td>
                            <td>robi@gmail.com</td>
                            <td><i class='fa fa-circle text-success font-xs'></i></td>
                            <td>
                                <a href="javascript:void(0)" class="action-link" title="Sales comapny details"><i class="c-icon c-icon-lg cil-menu"></i></a>
                                <div class="action-options-append vebo-display-none">
                                <ul class="action-options">
                                    <li class="details-action"><a href="#">Details</a></li>
                                    <li class="edit-action"><a href="#">Edit</a></li>
                                </ul>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection

@section('footer-script')
    {!! Html::script('js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/dataTables.bootstrap4.min.js') !!}
    {!! Html::script('js/dataTables.buttons.min.js') !!}
    {!! Html::script('js/buttons.server-side.js') !!}

    {{-- @if(isset($dataTable))
        {!! $dataTable->scripts() !!}
    @endif --}}
    <script type="text/javascript">
        $(document.body).on('click', '.action-delete', function (ev) {
            ev.preventDefault();
            let URL = $(this).attr('href');
            let redirectURL = "{{ route('admin.sales-companies.index') }}";
            warnBeforeAction(URL, redirectURL);
        });

        $(document.body).on('click', '.action-link', function (ev) {
            ev.preventDefault();
            if($(this).closest("td").find('.action-options-append').hasClass("vebo-display-none") == true)
            {
                $(this).closest("td").find('.action-options-append').removeClass("vebo-display-none");
            }
            else
            {
                $(this).closest("td").find('.action-options-append').addClass("vebo-display-none");
            }
        });

        $(document.body).on("click", ".vebo-filter-btn", function(ev){
            ev.preventDefault();
            $(this).removeClass("filter-active");
            $(this).removeAttr("style");
            if($(this).closest(".vebo-filter-section").find(".vebo-filter-options .vebo-filter-row").hasClass("vebo-display-none") == true)
            {
                $(this).closest(".vebo-filter-section").find(".vebo-filter-options .vebo-filter-row").removeClass("vebo-display-none");
                $(this).addClass("filter-active");
                $(this).attr("style", "margin-top: 25px;");
            }else{
                $(this).closest(".vebo-filter-section").find(".vebo-filter-options .vebo-filter-row").addClass("vebo-display-none");
            }
        });

        $(document.body).on('change',".filter-sales-companies",function (ev){
            $('.filter-form').submit();
        })
        @if(isset($params['created_at']) || isset($params['sales_company']) || isset($params['city']) || isset($params['status']))
        $('.vebo-filter-btn').trigger('click');
        @endif

    </script>
@endsection
