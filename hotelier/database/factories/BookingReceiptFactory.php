<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "checkout"=> now(),
            "cancel_time_status"=>rand(0,1),
            "payment_status"=>rand(0,1),
            'number_card'=>"12002323243",
            'expiry_date'=>now(),
            'total_money'=>100000000,
            'booking_id' => Booking::factory(),
            'bank_id' => Bank::factory(),
        ];
    }
}
