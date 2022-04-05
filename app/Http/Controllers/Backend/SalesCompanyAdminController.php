<?php

namespace App\Http\Controllers\Backend;

use App\Models\SalesCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesCompanyAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        $params = $this->getSearchParams($request);
        $data['params'] = $params;
        $data['sales_companies'] = SalesCompany::pluck('company_name','id');
        $data['names'] = SalesCompany::pluck('contact_person_first_name', 'contact_person_first_name');
        $data['status'] = ["New", "Active", "In-active", "Registrationn Pending"];
      
        return view("backend.sales-companies-admin.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSearchParams($request){
        $params =[];
        if(isset($request->created_at) && !empty($request->created_at)) {
            $params['created_at'] = $request->created_at;
        }

        if(isset($request->sales_company) && !empty($request->sales_company)) {
            $params['sales_company'] = $request->sales_company;
        }
        if(isset($request->city) && !empty($request->city)) {
            $params['city'] =  $request->city;
        }

        if(isset($request->status) && !empty($request->status)) {
            $params['status'] =  $request->status;
        }

        return $params;

    }
}
