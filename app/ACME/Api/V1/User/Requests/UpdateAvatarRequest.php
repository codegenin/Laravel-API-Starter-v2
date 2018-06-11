<?php

namespace App\ACME\Api\V1\User\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'file' => 'required|mimes:jpeg'
        ];
    }
    
    /**
     * Display custom validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file.mimes' => trans('common.file.ext.error')
        ];
    }
}
