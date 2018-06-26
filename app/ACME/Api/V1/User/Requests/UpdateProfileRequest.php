<?php

namespace App\ACME\Api\V1\User\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name'          => 'required',
            'password'      => 'nullable|min:6',
            'contact_email' => 'nullable|email',
            'location'      => 'required',
            'birthday'      => 'nullable|date',
            'website'       => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
    }
}
