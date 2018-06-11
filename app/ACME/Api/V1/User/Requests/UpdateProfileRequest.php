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
            'name'     => 'required',
            'birthday' => 'nullable|date',
            'website'  => 'nullable|url',
            'file'     => 'nullable|mimes:jpeg'
        ];
    }
}
