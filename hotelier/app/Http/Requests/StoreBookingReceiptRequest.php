<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingReceiptRequest extends FormRequest
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
           
            'number_card' => 'required|max:50',
            'expiry_date' => 'required|date_format:Y-m-d',    
            'total_money' => 'required|numeric', 
            'bank_id' => 'required|numeric', 
        ];
    }
}
