<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'client_id' => 'required|exists:clients',
            'room_id' => 'required|exists:rooms',
            'paid_price' => 'required|integer',
            'accompany_number' => 'required|integer',
            'reservation_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'The client ID is required',
            'client_id.exists' => "This client doesn't exist in the database",
            'room_id.required' => 'Room ID is required',
            'room_id.exists' => "This room doesn't exist in the database",
            'paid_price.required' => 'The paid price for the room is required',
            'paid_price.integer' => 'The paid price must be an integer',
            'accompany_number.required' => 'Accompany number is required',
            'accompany_number.integer' => 'Accompany number must be an integer',
            'reservation_date.required' => 'Reservation date is required',
            'reservation_date.date' => 'Reservation date must be a valid date',

        ];
    }
}
