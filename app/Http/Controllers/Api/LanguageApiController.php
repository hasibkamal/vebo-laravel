<?php

namespace App\Http\Controllers\Api;

use App\Api\Transformers\LanguageTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function config;
use function response;

class LanguageApiController extends ApiController
{
    protected $languageTransformer;

    public function __construct(LanguageTransformer $languageTransformer) {
        $this->languageTransformer                  =   $languageTransformer;
    }

    /**
     * route:: /language-list
     * Method:: GET
     * Get language list
     */
    public function getLanguageList(Request $request)
    {
        $data = array();
        try{

            $this->checkApiRequest($request);

            $languages = DB::table('languages')
                            ->select('id', 'language_code', 'language_name')
                            ->orderBy('id', 'ASC')
                            ->get();

            $data['language_list']  =   $languages;
            $data['status']         =   'success';
            $data['status_code']    =   '200';
            $data['message']        =   'Data found';

        } catch (\Exception $e) {
            $data['status_code']    = 500;
            $data['status']         = "error";
            $data['message']        = $e->getMessage();
            $logMessage             = exceptionMessage($e);
            writeToLog($logMessage, 'error');
        } finally {
            return response()->json($data);
        }
    }
}
