<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'name' => "required|min:3|max:55|regex:/^[\pL\-]+\s?[\pL\-]*$/",
            'make' =>  'required',
            'model' => 'required',
            'year' => 'required',
            'part_number' => 'required|min:3|max:55',
            'image' => 'required',
        ];
    }
}
