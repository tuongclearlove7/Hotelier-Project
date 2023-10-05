<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'room_id' => Room::factory(),
            'service_id' => Service::factory(),
            'booking_id' => Booking::factory(),
        ];
    }
}
