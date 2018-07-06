<?php

namespace App\ACME\Api\V1\Puchase\Requests;

use Dingo\Api\Http\FormRequest;

class PurchasePointsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'points'   => 'required|numeric'
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}