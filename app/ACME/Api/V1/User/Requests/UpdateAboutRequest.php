<?php

namespace App\ACME\Api\V1\User\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'about' => 'required'
        ];
    }
}
