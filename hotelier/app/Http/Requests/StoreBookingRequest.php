<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|max:50',
            'email' => 'required|email|max:55',
            'phone' => 'required|max:55',
            'address' => 'required|max:55',
            'num_guest' => 'required|numeric', 
            'checkout' => 'required|numeric', 
            'checkin' => 'required|date_format:m/d/Y g:i A',  
        ];
    }
}
