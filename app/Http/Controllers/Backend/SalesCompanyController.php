<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SalesCompaniesDataTable;
use App\Models\Country;
use App\Models\Language;
use App\Models\SalesCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        $prefix = 'SC';
        $data['companyId'] = DB::select("SELECT CONCAT('$prefix',LPAD(IFNULL(MAX(SUBSTR(table2.company_id,-5,5) )+1,1),5,'0')) AS company_id FROM (SELECT * FROM sales_companies ) AS table2 WHERE table2.company_id LIKE '$prefix%'")[0]->company_id;
        $data['languages'] = Language::pluck('language_name','language_code');
        $data['countries'] = Country::pluck('country_name','country_code');
        return view('backend.sales-companies.create',$data);
    }

    public function store(Request $request){

        $request->validate([
            'company_id'           => 'required',
            'company_name'           => 'required',
//            'language'           => 'required',
//            'street_name'           => 'required',
//            'street_number'           => 'required',
            'contact_person_first_name'           => 'required',

        ],
            [
                'contact_person_first_name.required'           => 'Contact person first name field is required',
            ]
        );

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
        $salesCompany->contact_person_phone_number = $request->input('contact_person_phone_number');
        $salesCompany->is_api_lock_connection = $request->input('is_api_lock_connection') ? 1 : 0;
        $salesCompany->is_push_notification = $request->input('is_push_notification') ? 1 : 0;
        $salesCompany->is_feedback_option = $request->input('is_feedback_option') ? 1 : 0;
        $salesCompany->accepted_payment_methods = $request->input('accepted_payment_methods');
        $salesCompany->status = 1;
        if($request->hasFile('photo')){
            $path = "uploads/company-logo/";
            $prefix = $salesCompany->company_id;
            $_companyLogo = $request->file('company_logo');
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
        return redirect(route('admin.sales-companies.index'))->with('success','Sales company created successfully!');
    }
}
