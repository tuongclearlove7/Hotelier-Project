<?php

namespace Database\Factories;

use App\Models\BookingDetail;
use App\Models\Promotion;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "fullname"=> fake()->name(),
            "email"=> fake()->email(),
            "phone"=> fake()->phoneNumber(),
            "address"=> "Lien chieu DaNang",
            "num_guest"=>10,
            "checkin"=> now(),
            "note"=> "khong co gi de ghi chu ca",
            'promotion_id' => Promotion::factory(),
    
        ];
    }
}
