<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Person::factory()->create()->id,
            'transportation_id'   => Transportation::all()->random()->id,
        ];
    }
}
