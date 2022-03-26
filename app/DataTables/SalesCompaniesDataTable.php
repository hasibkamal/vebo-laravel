<?php

namespace App\DataTables;


use App\Models\SalesCompany;
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
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($data) {
                return '<a href="/admin/sales-companies/' . $data->id .'" class="btn btn-xs btn-info" title="Sales comapny details"><i class="fa fa-list-alt"></i> Details</a> ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Get query source of dataTable.
     * @return \Illuminate\Database\Eloquent\Builder
     * @internal param \App\Models\AgentBalanceTransactionHistory $model
     */
    public function query()
    {
        $query = SalesCompany::getData();
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
                'buttons' => ['excel', 'csv', 'print', 'reset', 'reload'],
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
            'company_id'          => ['data' => 'company_id', 'name' => 'company_id', 'orderable' => true, 'searchable' => true],
            'company_name'        => ['data' => 'company_name', 'name' => 'company_name', 'orderable' => true, 'searchable' => true],
            'language'            => ['data' => 'language', 'name' => 'language', 'orderable' => true, 'searchable' => true],
            'street_name'         => ['data' => 'street_name', 'name' => 'street_name', 'orderable' => true, 'searchable' => true],
            'street_number'       => ['data' => 'street_number', 'name' => 'street_number', 'orderable' => true, 'searchable' => true],
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
