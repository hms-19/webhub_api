<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'image' => 'image:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'duration' => 'nullable'
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

            'title.required' => 'Blog title is required.',
            'author.required' => 'Author Name is required.',
            'description.required' => 'Description is required.',
            'image.required' => 'Blog image is required.',
            'image.image' => 'This file cannot support to store.',
            'category_id.required' => 'Category is required'
        ];

    }
}
