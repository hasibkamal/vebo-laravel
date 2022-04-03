<?php

namespace App\Api\Transformers;

use App\Api\Transformers\Transformer;

class MobileAppUserTransformer extends Transformer
{

    /**
     * MobileAppUserTransformer constructor.
     */
    public function __construct()
    {
        //
    }

    public function transform($mobileAppUserData) {

        return [
            'field1'              => $mobileAppUserData->id,
        ];
    }

}
