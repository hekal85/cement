<?php

namespace Database\Seeders;

use App\Models\ItineraryDetails;
use Illuminate\Database\Seeder;

class ItineraryDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItineraryDetails::factory(20)->create();
    }
}
