<?php

namespace App\ACME\Api\V1\Collection\Requests;

use Dingo\Api\Http\FormRequest;

class IncrementDecrementScoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'media_id' => 'required',
            'score'    => 'required|numeric|between:1,10',
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
