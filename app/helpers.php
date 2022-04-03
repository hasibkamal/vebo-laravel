<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

/*
 * Global helpers file with misc functions.
 */
if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('timezone')) {
    /**
     * Access the timezone helper.
     */
    function timezone()
    {
        return resolve(Timezone::class);
    }
}

if (! function_exists('camelcase_to_word')) {

    /**
     * @param $str
     *
     * @return string
     */
    function camelcase_to_word($str)
    {
        return implode(' ', preg_split('/
          (?<=[a-z])
          (?=[A-Z])
        | (?<=[A-Z])
          (?=[A-Z][a-z])
        /x', $str));
    }
}

if (! function_exists('exceptionMessage')) {

    /**
     * Write custom messages to Log
     *
     * @param $exception
     * @return \Illuminate\Config\Repository|mixed
     */
    function exceptionMessage($exception)
    {
        try {
            return 'File : '. $exception->getFile().' Line Number : '.$exception->getLine(). 'Message : '.$exception->getMessage();
        } catch (Exception $e) {
            return "Something went wrong!";
        }
    }
}
if (! function_exists('writeToLog')) {

    /**
     * Write custom messages to Log
     *
     * @param $logMessage
     * @param string $logType
     * @return \Illuminate\Config\Repository|mixed
     */
    function writeToLog($logMessage, $logType = 'error')
    {
        try {
            $allLogTypes = ['alert', 'critical', 'debug', 'emergency', 'error', 'info','notice'];

            $logType = strtolower($logType);

            if (in_array($logType, $allLogTypes)) {
                \Log::$logType($logMessage);
            }
        } catch (Exception $exception) {
            //
        }
    }
}


if (! function_exists('employeeNumber')) {

    /**
     * Write custom messages to Log
     *
     * @param $logMessage
     * @param string $logType
     * @return \Illuminate\Config\Repository|mixed
     */
    function employeeNumber()
    {
        $prefix = 'MU';
        return DB::select("SELECT CONCAT('$prefix',LPAD(IFNULL(MAX(SUBSTR(table2.employee_number,-5,5) )+1,1),5,'0')) AS employee_number FROM (SELECT * FROM employees ) AS table2 WHERE table2.employee_number LIKE '$prefix%'")[0]->employee_number;

    }
}


