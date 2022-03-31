@extends('backend.layouts.app')
@section('title', __('Sales Companies'))
@section('header-css')
    {!! Html::style('css/dataTables.bootstrap4.min.css') !!}
    {!! Html::style('css/buttons.dataTables.min.css') !!}
@endsection
@section('content')
    <div class="card vebo-border-none">
        <div class="card-header vebo-border-none">
            <div class="row">
                <div class="col-sm-5 pull-left">
                    <h5 class="vebo-section-title">Sales Companies</h5>
                </div><!--col-->
                <div class="col-sm-7 pull-right">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.sales-companies.create') }}" class="btn btn-sm btn-success vebo-create-btn" title="Create new"
                            data-original-title="Create New">
                            <i class="fa fa-plus"></i> Add New Sales Company
                        </a>
                    </div>
                </div><!--col-->
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
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

    @if(isset($dataTable))
        {!! $dataTable->scripts() !!}
    @endif
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

    </script>
@endsection

