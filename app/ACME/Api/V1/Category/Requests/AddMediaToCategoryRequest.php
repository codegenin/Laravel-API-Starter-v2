<?php

namespace App\ACME\Api\V1\Category\Requests;

use Dingo\Api\Http\FormRequest;

class AddMediaToCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required',
            'title'       => 'required',
            'location'    => 'required',
            'file'        => 'required|mimes:jpeg',
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
    
    public function authorize()
    {
        return true;
    }
}
