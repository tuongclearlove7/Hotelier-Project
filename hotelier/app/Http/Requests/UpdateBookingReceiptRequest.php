<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingReceiptRequest extends FormRequest
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
           
            'checkout' => 'required|',
            'cancel_time_status' => 'required|min:1|max:20',
            'payment_status' => 'required|min:1|max:20',
            'number_card' => 'required|min:1|max:20',
            'expiry_date' => 'required|',
            'total_money' => 'required|',
            'booking_id' => 'required|exists:App\Models\Booking,id',
            'bank_id' => 'required|exists:App\Models\Bank,id',
    
        ];
    }
}
