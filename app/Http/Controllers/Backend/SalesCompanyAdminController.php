<?php

namespace App\Http\Controllers\Backend;

use App\Models\Language;
use App\Models\SalesCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SalesCompanyAdmin;

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
        $data['sales_company_admins'] = SalesCompanyAdmin::orderBy('id', 'DESC')->get();
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
        $prefix = 'SA';
        $data['adminId'] = DB::select("SELECT CONCAT('$prefix',LPAD(IFNULL(MAX(SUBSTR(table2.company_id,-5,5) )+1,1),5,'0')) AS company_id FROM (SELECT * FROM sales_companies ) AS table2 WHERE table2.company_id LIKE '$prefix%'")[0]->company_id;
        $data['languages'] = Language::pluck('language_name','language_name');
        $data['sales_companies'] = SalesCompany::pluck('company_name','company_name');

        return view('backend.sales-companies-admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'admin_id'       => 'required',
            'sales_company'  => 'required',
            'language'       => 'required',
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required',
        ],
            [
                'first_name.required'           => 'First name field is required',
                'last_name.required'           => 'Last name field is required',
                'email.required'           => 'Email name field is required',
            ]
        );

        $salesCompanyAdmin = new SalesCompanyAdmin();
        $salesCompanyAdmin->admin_id      = $request->input('admin_id');
        $salesCompanyAdmin->sales_company = $request->input('sales_company');
        $salesCompanyAdmin->language = $request->input('language');
        $salesCompanyAdmin->first_name = $request->input('first_name');
        $salesCompanyAdmin->last_name = $request->input('last_name');
        $salesCompanyAdmin->email = $request->input('email');
        $salesCompanyAdmin->is_email_sent = $request->input('is_email_sent') ? 1 : 0;
        $salesCompanyAdmin->status = 1;
        $salesCompanyAdmin->save();

        return redirect(route('admin.sales-companies-admin.index'))
                ->with('flash_success','Sales company admin was successfully created and the email notification sent.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['company_details'] = SalesCompanyAdmin::find($id);
                                
        return view("backend.sales-companies-admin.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $prefix = 'SA';
        // $data['adminId'] = DB::select("SELECT CONCAT('$prefix',LPAD(IFNULL(MAX(SUBSTR(table2.company_id,-5,5) )+1,1),5,'0')) AS company_id FROM (SELECT * FROM sales_companies ) AS table2 WHERE table2.company_id LIKE '$prefix%'")[0]->company_id;
        $data['languages'] = Language::pluck('language_name','id');

        $data['sales_companies'] = SalesCompany::pluck('company_name','id');
        $data['company_details'] = SalesCompanyAdmin::find($id);

        return view('backend.sales-companies-admin.edit', $data);
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
        $request->validate([
            'admin_id'       => 'required',
            'sales_company'  => 'required',
            'language'       => 'required',
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required',
        ],
            [
                'first_name.required'           => 'First name field is required',
                'last_name.required'           => 'Last name field is required',
                'email.required'           => 'Email name field is required',
            ]
        );

        $salesCompanyAdmin = SalesCompanyAdmin::find($id);
        $salesCompanyAdmin->admin_id      = $request->input('admin_id');
        $salesCompanyAdmin->sales_company = $request->input('sales_company');
        $salesCompanyAdmin->language = $request->input('language');
        $salesCompanyAdmin->first_name = $request->input('first_name');
        $salesCompanyAdmin->last_name = $request->input('last_name');
        $salesCompanyAdmin->email = $request->input('email');
        $salesCompanyAdmin->save();

        return redirect(route('admin.sales-companies-admin.index'))
                ->with('flash_success','Sales company admin was successfully updated.');
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

    public function deactivedSalesAdminList(Request $request)
    {
        $data = array();
        $params = $this->getSearchParams($request);
        $data['params'] = $params;
        $data['sales_companies'] = SalesCompany::pluck('company_name','id');
        $data['names'] = SalesCompany::pluck('contact_person_first_name', 'contact_person_first_name');
        $data['status'] = ["New", "Active", "In-active", "Registrationn Pending"];
      
        return view("backend.sales-companies-admin.deactivate-admin", $data);
    }

    public function deactivedSalesAdmin(Request $request)
    {
        dd(3);
        //todo:: write de activation code here
        return redirect(route('admin.sales-companies-admin.index'))
                ->with('flash_success','Sales Company Admin John Doe from the Sales Company VEBO Gastronomy was successfully deactivated..');
    }
}
