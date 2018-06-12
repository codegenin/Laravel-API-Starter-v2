<?php

namespace App\ACME\Api\V1\Collection\Requests;

use Dingo\Api\Http\FormRequest;

class CreateCollectionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required',
            'title'       => 'required',
            'year_start'  => 'required|date_format:Y',
            'year_end'    => 'required|date_format:Y'
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
