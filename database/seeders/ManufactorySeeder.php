<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manufactory;

class ManufactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manufactory::factory(2)->create();
    }
}
