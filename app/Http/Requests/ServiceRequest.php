<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServiceRequest extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:services|max:255',
            'description' => 'required',
            'logo' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
        ];
    }


    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));

    }



    public function messages()

    {

        return [

            'name.required' => 'Service name is required.',
            'logo.required' => 'Logo is required.',
            'description.required' => 'Description is required.',
            'image.required' => 'Service image is required.',
            'logo.image' => 'This file cannot support to store.',
            'image.image' => 'This file cannot support to store.',
            'category_id.required' => 'Category is required'
        ];

    }

}
