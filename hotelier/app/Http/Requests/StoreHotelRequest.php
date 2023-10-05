<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
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
            'name' => 'required|max:55',
            'image' => 'required|max:5120',
            'address' => 'required|max:255',
            'description' => 'required|max:5120',
            'city_id' => 'required|exists:App\Models\City,id',
            'hotel_type_id' => 'required|exists:App\Models\HotelType,id',
        ];
    }
}
