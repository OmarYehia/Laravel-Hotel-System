<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'room_number' => 'required|digits:4|integer',
            'room_price' => 'required|integer|min:100',
            'room_capacity' => 'required|integer',
            'floor_id' => 'required|exists:floors,id',
            'created_by' => 'required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'room_number.required' => 'Room number is required',
            'room_number.digits' => 'Room number must be more than 4 digits',
            'room_number.integer' => 'Room number must be an integer',
            'room_price.required' => 'Room price is required',
            'room_price.integer' => 'Room price must be an integer',
            'room_capacity.required' => 'Room capacity is required',
            'room_capacity.integer' => 'Room capacity must be an integer',
            'floor_id.required' => 'Floor in which the room resides must be entered',
            'floor_id.exists' => 'Floor must exist in the database',
            'created_by.required' => 'The creator of the floor is required',
            'created_by.exists' => 'The creator of the room must be a valid user in the database',
        ];
    }
}
