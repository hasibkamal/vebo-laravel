<?php

namespace App\Http\Controllers\Api;

use App\Api\Transformers\CountryTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function config;
use function response;

class CountryApiController extends ApiController
{
    protected $countryTransformer;

    public function __construct(CountryTransformer $countryTransformer) {
        $this->countryTransformer                  =   $countryTransformer;
    }


    /**
     * route:: /country-list
     * Method:: GET
     * Get country list
     */
    public function getCountryList(Request $request)
    {
        $data = array();
        try{

            $this->checkApiRequest($request);

            $countries = DB::table('countries')
                            ->orderBy('id', 'ASC')
                            ->get();

            $data['country_list']   =   $countries;
            $data['status']         =   'success';
            $data['status_code']    =   $this->getStatusCode();
            $data['message']        =   'Data found';

        } catch (\Exception $e) {
            $this->setStatusCode(500);
            $data['status_code']    = $this->getStatusCode();
            $data['status']         = "error";
            $data['message']        = $e->getMessage();
            $logMessage             = exceptionMessage($e);
            writeToLog($logMessage, 'error');
        } finally {
            return response()->json($data);
        }
    }
}
