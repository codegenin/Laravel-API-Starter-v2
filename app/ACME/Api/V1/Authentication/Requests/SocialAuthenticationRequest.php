<?php

namespace App\ACME\Api\V1\Authentication\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class SocialAuthenticationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'      => 'required',
            'email'     => 'required',
            'social_id' => 'required',
            'provider'  => 'required|in:app,facebook,google',
        ];
    }
    
    public function authorize()
    {
        return true;
    }
}
