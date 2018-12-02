<?php

namespace App\ACME\Admin\Media\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required',
            'description' => 'required',
            'location'    => 'required',
            #'tags'        => 'required',
            'file'        => 'nullable|mimes:jpeg,png',
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
            'file.mimes' => 'Only .jpg image extension is allowed!'
        ];
    }
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
}
