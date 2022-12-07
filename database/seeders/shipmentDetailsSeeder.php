<?php

namespace Database\Seeders;

use App\Models\ShipmentDetails;
use Illuminate\Database\Seeder;

class shipmentDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipmentDetails::factory(30)->create();
    }
}
