<?php

namespace Database\Seeders;

use App\Models\Shareholder;
use Illuminate\Database\Seeder;

class ShareholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shareholder::factory(2)->create();
    }
}
