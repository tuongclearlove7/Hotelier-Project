<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\HotelType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>'Muong Thanh Hotel',
            'image'=>'hotel.jpeg',
            'address'=>'DaNang',
            'description'=>'Muong Thanh Hotel DaNang VietNam',
            'city_id' => City::factory(),
            'hotel_type_id' => HotelType::factory(),

        ];
    }
}
