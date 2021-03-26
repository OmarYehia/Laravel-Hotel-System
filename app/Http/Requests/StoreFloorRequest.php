<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFloorRequest extends FormRequest
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
            'floor_name' => 'required|min:3',
            'created_by' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'floor_name.required' => 'Floor name is required',
            'floor_name.min' => 'Floor name should be atleast 3 characters',
            'created_by.required' => 'The creator of the floor is required',
            'created_by.exists' => 'The creator must exists in the database',
        ];
    }
}
