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
            'about'    => 'required',
            'birthday' => 'required|date',
            'location' => 'required',
            'website'  => 'required|url',
            'file' => 'nullable|mimes:jpeg'
        ];
    }
}
