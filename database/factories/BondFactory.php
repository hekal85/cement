<?php

namespace Database\Factories;

use App\Models\Bond;
use App\Models\Person;
use App\Models\Shareholder;
use Illuminate\Database\Eloquent\Factories\Factory;

class BondFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bond::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'person_id' => Shareholder::all()->random()->id,
            'amount' => $this->faker->numberBetween(25000, 1000000),
            'days' => $this->faker->numberBetween(0, 366),
            'created_at' => $this->faker->dateTimeBetween('-11 month', '-1 month'),
        ];
    }
}
