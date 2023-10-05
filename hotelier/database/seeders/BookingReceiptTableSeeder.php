<?php

namespace Database\Seeders;

use App\Models\BookingReceipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingReceiptTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingReceipt::factory(10)->create();
    }
}
