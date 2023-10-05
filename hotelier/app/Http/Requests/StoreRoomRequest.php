<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'status' => 'required|',
            'price' => 'required|',
            'description' => 'required|max:5120',
            'quantity' => 'required|',
            'area' => 'required|',
            'view' => 'required|max:255',
            'room_type_id' => 'required|exists:App\Models\RoomType,id',
            'hotel_id' => 'required|exists:App\Models\Hotel,id',
        ];
    }
}
