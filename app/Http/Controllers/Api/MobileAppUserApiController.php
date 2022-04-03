<?php

namespace App\Http\Controllers\Api;


use App\Models\MobileAppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function response;

class MobileAppUserApiController extends ApiController
{
    protected $mobileAppUserTransformer;

    // constructor => MobileAppUserTransformer $mobileAppUserTransformer

    public function __construct() {
        // $this->mobileAppUserTransformer                  =   $mobileAppUserTransformer;
    }


    /**
     * route:: /last-company-id
     * Method:: GET
     * generate new company id based on last company id
     */
    public function lastMobileAppUserId(Request $request)
    {
        $data = array();
        try{
            $this->checkApiRequest($request);
            $prefix = 'MU';
            // $user_id = DB::select("SELECT CONCAT('$prefix',LPAD(IFNULL(MAX(SUBSTR(table2.user_id,-6,6) )+1,0),6,'0')) AS user_id FROM (SELECT * FROM mobile_app_users ) AS table2 WHERE table2.user_id LIKE '$prefix%'")[0]->user_id;
            $result = DB::table('mobile_app_users')
                    ->where('user_id', 'like', '%' . $prefix . '%')
                    ->select("user_id")
                    ->orderBy('id','desc')
                    ->first();

            $data['status']         =   'success';
            $data['status_code']    =   $this->getStatusCode();
            $data['user_id']        =   (isset($result->user_id))?$result->user_id:'00000';

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
