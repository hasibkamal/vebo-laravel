<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SalesCompaniesDataTable;

/**
 * Class DashboardController.
 */
class SalesCompanyController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index(SalesCompaniesDataTable $dataTable)
    {
        return $dataTable->render("backend.sales-companies.index");
    }

    public function create()
    {
        return view('backend.sales-companies.create');
    }
}
