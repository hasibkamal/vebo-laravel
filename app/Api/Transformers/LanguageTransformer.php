<?php

namespace App\Api\Transformers;

use App\Api\Transformers\Transformer;

class LanguageTransformer extends Transformer
{

    /**
     * LanguageTransformer constructor.
     */
    public function __construct()
    {
        //
    }

    public function transform($langData) {

        return [
            'field1'              => $langData->id,
        ];
    }

}
