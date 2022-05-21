<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id'           => 'bail|required|numeric',
            'borrower_id'       => 'bail|required|numeric',
            'book_id'           => 'bail|required|numeric',
            'checked_out_time'  => 'bail|required|date',
            'checked_in_time'   => 'sometimes|date|nullable',
        ];
    }
}
