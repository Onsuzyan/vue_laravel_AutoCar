<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'name' => 'required|alpha|min:3',
            'phone' => 'required',
            'address'=> 'required|min:10|alpha_dash',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }
}
