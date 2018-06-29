<?php

namespace App\ACME\Api\V1\Collection\Requests;

use Dingo\Api\Http\FormRequest;

class AddMediaToCollectionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'collection_id' => 'required',
            'title'         => 'required',
            'year'          => 'required|date_format:Y',
            'location'      => 'required',
            'file'          => 'required|mimes:jpeg,png',
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
