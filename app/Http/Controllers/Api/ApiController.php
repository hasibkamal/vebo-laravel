<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use function config;

class ApiController extends Controller
{
    protected $statusCode = 200;

    /**
     * Get the status code
     *
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * Set the Status Code
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function checkApiRequest($request)
    {
        if ($request->input('app_key') == null
            || $request->input('app_secret') == null
            || $request->input('application') == null)
        {
            throw new Exception('You have to provide all credentials!');
        }
        if ($request->input('app_key') != config('misc.app.app_key')) {
            throw new Exception('Invalid app key!');
        }
        if ($request->input('app_secret') != config('misc.app.app_secret')) {
            throw new Exception('Invalid app secret!');
        }
        if ($request->input('application') != config('misc.app.application')) {
            throw new Exception('Invalid application request!');
        }
    }
}
