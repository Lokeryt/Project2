<?php

namespace App\Http\Validate;
use Validator;

class ValidateXml
{
    public function validate($value)
    {
        $validate = Validator::make((array)$value,
            [
                'post' => 'required|string',
                'type' => 'required|string',
                'salary' => 'required|int|min:0',
                'amount' => 'required|int|min:0',
                'external_id' => 'required|int|min:0'
            ]);
        return $validate;
    }
}
