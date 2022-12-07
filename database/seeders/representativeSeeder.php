<?php

namespace Database\Seeders;

use App\Models\Representative;
use Illuminate\Database\Seeder;

class representativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Representative::factory(5)->create();
    }
}
