<?php

namespace App\ACME\Api\V1\Media\Requests;

use Dingo\Api\Http\FormRequest;

class AddMediaUserPointRequest extends FormRequest
{
    public function rules()
    {
        return [
            'media_id' => 'required',
            'amount'   => 'required|numeric'
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}