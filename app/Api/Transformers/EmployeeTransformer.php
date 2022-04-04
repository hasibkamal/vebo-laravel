<?php

namespace App\Api\Transformers;

use App\Api\Transformers\Transformer;

class EmployeeTransformer extends Transformer
{

    /**
     * SalesCompanyTransformer constructor.
     */
    public function __construct()
    {
        //
    }

    public function transform($data) {

        return [
            'id'                => $data->id,
            'employee_number'   => $data->employee_number,
            'language'          => $data->language,
            'first_name'        => $data->first_name,
            'last_name'         => $data->last_name,
            'user_medium'       => $data->user_medium,
            'email'             => $data->email,
            'cell_phone_number' => $data->cell_phone_number,
        ];
    }

}
