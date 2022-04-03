<?php

namespace App\DataTables;


use App\Models\SalesCompany;
use Carbon\Carbon;
use Yajra\DataTables\Services\DataTable;
use function datatables;


class SalesCompaniesDataTable extends DataTable
{

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $html = "";
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($data) {
                $html = '<a href="javascript:void(0)" class="action-link" title="Sales comapny details"><i class="c-icon c-icon-lg cil-menu"></i></a> ';
                $html .='<div class="action-options-append vebo-display-none">
                    <ul class="action-options">
                        <li class="details-action"><a href="/admin/sales-companies/details/' . $data->id .'">Details</a></li>
                        <li class="edit-action"><a href="/admin/sales-companies/edit/' . $data->id .'">Edit</a></li>
                    </ul>
                </div>';
                return $html;
            })
            ->editColumn('created_at',function($data){
                return str_replace('-','.',Carbon::parse($data->created_at)->toDateString());
            })
            ->editColumn('contact_person_first_name',function($data){
                return $data->contact_person_first_name.' '.$data->contact_person_last_name;
            })
            ->editColumn('is_api_lock_connection',function ($data){
                $is_api_lock_connection = ($data->is_api_lock_connection) ? "<i class='fa fa-unlock'></i>" : "<i class='fa fa-unlock text-secondary'></i>";
                $is_push_notification = ($data->is_push_notification) ? "<i class='fa fa-bell pl-4 pr-4'></i>" : "<i class='fa fa-bell text-secondary pl-4 pr-4'></i>";
                $is_feedback_option = ($data->is_feedback_option) ? "<i class='fa fa-comment'></i>" : "<i class='fa fa fa-comment text-secondary'></i>";
                return $is_api_lock_connection .' '. $is_push_notification .' '. $is_feedback_option;
            })
            ->editColumn('status',function ($data){
                return ($data->status) ? "<i class='fa fa-circle text-success font-xs'></i>" : "<i class='fa fa-circle text-danger font-xs'></i>";
            })
            ->rawColumns(['action','is_api_lock_connection','status'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     * @return \Illuminate\Database\Eloquent\Builder
     * @internal param \App\Models\AgentBalanceTransactionHistory $model
     */
    public function query()
    {
        $params['created_at'] = $this->created_at;
        $params['sales_company'] = $this->sales_company;
        $params['city'] = $this->city;
        $params['status'] = $this->status;
        $query = SalesCompany::getData($params);
        $data = $query->select([
            'sales_companies.*'
        ]);
        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                'dom' => 'Blfrtip',
                'responsive' => true,
                'autoWidth' => false,
                'paging' => true,
                "pagingType" => "full_numbers",
                'searching' => true,
                'info' => true,
                'searchDelay' => 350,
                "serverSide" => true,
                'applicant' => [[1, 'asc']],
                'buttons' => [],
                'pageLength' => 10,
                'lengthMenu' => [[10, 20, 25, 50, 100, 500, -1], [10, 20, 25, 50, 100, 500, 'All']],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'creation_date'       => ['data' => 'created_at', 'name' => 'created_at', 'orderable' => true, 'searchable' => true],
            'company_id'          => ['data' => 'company_id', 'name' => 'company_id', 'orderable' => true, 'searchable' => true],
            'company_name'        => ['data' => 'company_name', 'name' => 'company_name', 'orderable' => true, 'searchable' => true],
            'contact_person'      => ['data' => 'contact_person_first_name', 'name' => 'contact_person_first_name', 'orderable' => true, 'searchable' => true],
            'optional_features'   => ['data' => 'is_api_lock_connection', 'name' => 'is_api_lock_connection', 'className'=>'text-center', 'orderable' => true, 'searchable' => true],
            'status'              => ['data' => 'status', 'name' => 'status', 'className'=>'text-center', 'orderable' => true, 'searchable' => true],
            'action'              => ['searchable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(){
        return 'list_' . date('Y_m_d_H_i_s');
    }
}
