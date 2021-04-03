<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:clients',
            'phone_number' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'password' => 'required|min:6',
            'avatar_image' => 'image|mimes:jpeg,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the name of the user',
            'email.required' => 'The email address is required',
            'email.unique' => 'This email is already registered',
            'email.email' => 'Please neter a valid email address',
            'password.required' => 'Please enter the password',
            'password.min' => 'Password should be at least 6 characters in length',
            'country.required' => 'Please choose your country',
        ];
    }
}
