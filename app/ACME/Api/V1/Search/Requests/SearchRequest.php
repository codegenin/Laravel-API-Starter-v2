<?php

namespace App\ACME\Api\V1\Search\Requests;

use Dingo\Api\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules()
    {
        return [
            'term' => 'required',
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}