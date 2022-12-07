<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Manufactory;
use App\Models\Person;
use App\Models\Shipment;
use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'manufactory_id' => Manufactory::all()->random()->id,
            'transportation_id' => Transportation::all()->random()->id,
            'driver' => Person::all()->random()->id,
            'payload' => $this->faker->numberBetween(0, 9999),
            'cost' => $this->faker->numberBetween(0, 9999999),
            'trans' => $this->faker->numberBetween(0, 140000),
            'total' => $this->faker->numberBetween(0, 9999999),
            'remaining' => $this->faker->numberBetween(0, 999),
            'done' => $this->faker->numberBetween(0,1),
            'notes' => $this->faker->sentence(1, true),
        ];
    }
}
