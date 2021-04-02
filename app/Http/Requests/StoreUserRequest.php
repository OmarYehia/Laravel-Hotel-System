<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'password' => 'required|min:6',
            'national_id' => 'integer|unique:users,national_id,'.$this->id,
        ];

        if (Auth::guard('user')->user()->can('manage managers') or Auth::guard('user')->user()->can('manage receptionists')) {
            $rules['password'] = '';
        }

        return $rules;
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
            'national_id.unique' => 'This national ID has already been registered in the system',
            'created_by.exists' => "The creator doesn't exist in the databasa",
        ];
    }
}
