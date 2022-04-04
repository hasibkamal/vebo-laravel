<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SalesCompaniesDataTable;
use App\Models\Country;
use App\Models\Language;
use App\Models\PaymentMethod;
use App\Models\SalesCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class DashboardController.
 */
class SalesCompanyController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index(SalesCompaniesDataTable $dataTable, Request $request)
    {
        $data = array();
        $params = $this->getSearchParams($request);
        $data['params'] = $params;
        $data['sales_companies'] = SalesCompany::pluck('company_name','id');
        $data['cities'] = SalesCompany::pluck('city', 'city');
        $data['status'] = ["Active", "In-active", "Pending", "Suspended"];
        return $dataTable->with($params)->render("backend.sales-companies.index", $data);
    }

    public function create()
    {
        $prefix = 'SC';
        $data['companyId'] = DB::select("SELECT CONCAT('$prefix',LPAD(IFNULL(MAX(SUBSTR(table2.company_id,-5,5) )+1,1),5,'0')) AS company_id FROM (SELECT * FROM sales_companies ) AS table2 WHERE table2.company_id LIKE '$prefix%'")[0]->company_id;
        $data['languages'] = Language::pluck('language_name','id');
        $data['countries'] = Country::pluck('country_name','country_code');
        // $data['paymentMethods'] = PaymentMethod::pluck('name', 'logo','id');
        $data['paymentMethods'] = app(PaymentMethod::class)
                    ->where('status', 1)
                    ->get(['id', 'name', 'logo']);
        return view('backend.sales-companies.create', $data);
    }

    public function store(Request $request){

        $request->validate([
            'company_id'                    => 'required',
            'company_name'                  => 'required',
            'language'                      => 'required',
            'street_name'                   => 'required',
            'street_number'                 => 'required',
            'contact_person_first_name'     => 'required',
            'contact_person_last_name'      => 'required',
            'contact_person_email'          => 'required',
            'contact_person_phone_number'   => 'required',
            'accepted_payment_methods'      => 'required',

        ],
            [
                'contact_person_first_name.required'           => 'Contact person first name field is required',
                'contact_person_last_name.required'           => 'Contact person last name field is required',
                'contact_person_email.required'           => 'Contact person email name field is required',
                'contact_person_phone_number.required'           => 'Contact person phone number field is required',
            ]
        );


        $contact_number = '+'.$request->input('carrierCode').'-'.$request->input('contact_person_phone_number');

        $salesCompany = new SalesCompany();
        $salesCompany->company_id = $request->input('company_id');
        $salesCompany->company_name = $request->input('company_name');
        $salesCompany->language = $request->input('language');
        $salesCompany->street_name = $request->input('street_name');
        $salesCompany->street_number = $request->input('street_number');
        $salesCompany->zip_code = $request->input('zip_code');
        $salesCompany->city = $request->input('city');
        $salesCompany->country = $request->input('country');
        $salesCompany->contact_person_first_name = $request->input('contact_person_first_name');
        $salesCompany->contact_person_last_name = $request->input('contact_person_last_name');
        $salesCompany->contact_person_email = $request->input('contact_person_email');
        // $salesCompany->contact_person_phone_number = $request->input('contact_person_phone_number');
        $salesCompany->contact_person_phone_number = $contact_number;
        $salesCompany->is_api_lock_connection = $request->input('is_api_lock_connection') ? 1 : 0;
        $salesCompany->is_push_notification = $request->input('is_push_notification') ? 1 : 0;
        $salesCompany->is_feedback_option = $request->input('is_feedback_option') ? 1 : 0;
        $salesCompany->accepted_payment_methods = $request->input('accepted_payment_methods');
        $salesCompany->status = 1;

        if($request->hasFile('photo')){
            $path = "uploads/company-logo/";
            $prefix = $salesCompany->company_id;
            $_companyLogo = $request->file('photo');
            $mimeType = $_companyLogo->getClientMimeType();

            if (!in_array($mimeType, ['image/jpg','image/jpeg','image/png']))
                return redirect()->back()->with('error', 'Invalid file. Only JPG, JPEG and PNG files are allowed!');

            if(!file_exists($path))
                mkdir($path, 0777, true);

            $fileName = trim(sprintf("%s", uniqid($prefix, true))) .'.'.$_companyLogo->getClientOriginalExtension();
            $_companyLogo->move($path, $fileName);
            $salesCompany->company_logo = $fileName;

        }
        $salesCompany->save();
        return redirect(route('admin.sales-companies.index'))
                ->with('flash_success','Sales company was successfully created.');
    }

    public function show($id)
    {
        $data['company_details'] = DB::table('sales_companies as sc')
                                    ->join('languages as lang', 'lang.id', 'sc.language')
                                    ->join('countries as contr', 'contr.country_code', 'sc.country')
                                    ->where('sc.id', $id)
                                    ->where('sc.status', 1)
                                    ->select(
                                        'sc.company_logo',
                                        'sc.company_id',
                                        'sc.company_name',
                                        'lang.language_name',
                                        'sc.street_name',
                                        'sc.street_number',
                                        'sc.zip_code',
                                        'sc.city',
                                        'contr.country_name',
                                        'sc.contact_person_first_name',
                                        'sc.contact_person_last_name',
                                        'sc.contact_person_email',
                                        'sc.contact_person_phone_number',
                                        'sc.is_api_lock_connection',
                                        'sc.is_push_notification',
                                        'sc.is_feedback_option',
                                        'sc.accepted_payment_methods',
                                        'sc.created_at'
                                    )
                                    ->first();
        $data['paymentMethods'] = PaymentMethod::pluck('name', 'id');

        return view("backend.sales-companies.show", $data);
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
