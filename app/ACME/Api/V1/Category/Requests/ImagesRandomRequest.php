<?php

namespace App\ACME\Api\V1\Category\Requests;

use Dingo\Api\Http\FormRequest;

class ImagesRandomRequest extends FormRequest
{
    public function rules()
    {
        return [
            'page'    => 'required'
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
