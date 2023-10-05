<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Room-Breakfast-60 mins oil massage per night",
            "status" => rand(0,1),
            'price' => 10000000,
            'description' => "No charge for cancellation/amendment made more than 03 days prior to the arrival date. Any cancellation/amendment made less than 03 days prior to arrival date or no-show, 100% of the full length of stay will be charged.",
            'quantity' => 3,
            'area' => 30,
            'view' => "ocean view frame",
            'room_type_id' => RoomType::factory(),
            'hotel_id' => Hotel::factory(),
        ];
    }
}
