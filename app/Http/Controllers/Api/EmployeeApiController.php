<?php

namespace App\Http\Controllers\Api;


use App\Api\Transformers\EmployeeTransformer;
use App\Domains\Auth\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function response;

class EmployeeApiController extends ApiController
{
    protected $employeeTransformer;

    public function __construct(EmployeeTransformer $employeeTransformer) {
        $this->employeeTransformer = $employeeTransformer;
    }


    /**
     * route:: /last-company-id
     * Method:: GET
     * generate new company id based on last company id
     */
    public function lastEmployeeNumber(Request $request)
    {
        $data = array();
        try{
            $this->checkApiRequest($request);
            $employeeNumber = employeeNumber();

            $data['status']             =   'success';
            $data['status_code']        =   $this->getStatusCode();
            $data['employee_number']    =   $employeeNumber;

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


    public function registration(Request $request)
    {
        try{
            $this->checkApiRequest($request);

            if ($request->input('language') == null)
            {
                throw new \Exception(__('validation.required',['attribute'=>'language']));
            }

            if ($request->input('employee_number') == null)
            {
                throw new \Exception(__('validation.required',['attribute'=>'employee number']));
            }

            if ($request->input('first_name') == null)
            {
                throw new \Exception(__('validation.required',['attribute'=>'first name']));
            }

            if ($request->input('last_name') == null)
            {
                throw new \Exception(__('validation.required',['attribute'=>'last name']));
            }

            if ($request->input('user_medium') == null)
            {
                throw new \Exception(__('validation.required',['attribute'=>'user medium']));
            }

            if($request->input('user_medium') == 'email'){
                if ($request->input('email') == null)
                {
                    throw new \Exception(__('validation.required',['attribute'=>'email']));
                }

                $user = User::where('email',$request->input('email'))->first();
                if($user){ //Email address existence checking in user table
                    throw new \Exception('The email address is already exist!');
                }
            }
            else if($request->input('user_medium') == 'phone') {
                if ($request->input('cell_phone_country_code') == null) {
                    throw new \Exception(__('validation.required', ['attribute' => 'cell phone country code']));
                }
                if ($request->input('cell_phone_number') == null) {
                    throw new \Exception(__('validation.required', ['attribute' => 'cell phone number']));
                }

                $cellPhoneCountryCode = $request->input('cell_phone_country_code');
                $cellPhoneNumber = $request->input('cell_phone_number');
                $phoneNumber = $cellPhoneCountryCode.$cellPhoneNumber;
                $user = User::where('phone',$phoneNumber)->first();
                if($user){ //Cell phone number existence checking in user table
                    throw new \Exception('The cell phone number is already exist!');
                }

            }else{
                throw new \Exception('Invalid user medium!');
            }

            if($request->input('user_medium') == 'email'){
                $user = User::firstOrNew(['email'=>$request->input('email')]);
                $user->email = $request->input('email');
            }else{
                $cellPhoneCountryCode = $request->input('cell_phone_country_code');
                $cellPhoneNumber = $request->input('cell_phone_number');
                $phoneNumber = $cellPhoneCountryCode.$cellPhoneNumber;
                $user = User::firstOrNew(['phone'=>$phoneNumber]);
                $user->phone = $phoneNumber;
            }

            $user->type = 'employee';
            $user->name = $request->input('first_name') .' '. $request->input('last_name');
            $user->password = Hash::make(123456);
            $user->save();

            $employee = Employee::firstOrNew(['user_id'=>$user->id]);
            $employee->employee_number = $employee->employee_number ?? employeeNumber();
            $employee->language = $request->input('language');
            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->user_medium = $request->input('user_medium');
            $employee->email = $request->input('email');
            $employee->cell_phone_number = $request->input('cell_phone_number');
            $employee->status = 1;
            $employee->save();

            $data['employee']       = $this->employeeTransformer->transform($employee);
            $data['status']         = 'success';
            $data['status_code']    = $this->getStatusCode();

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
