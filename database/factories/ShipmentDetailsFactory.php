<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Representative;
use App\Models\Shipment;
use App\Models\ShipmentDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShipmentDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payload' => $this->faker->numberBetween(0, 9999),
            'cost' => $this->faker->numberBetween(0, 9999999),
            'discount' => $this->faker->numberBetween(0, 1000),
            'total' => $this->faker->numberBetween(0, 9999999),
            'paid' => $this->faker->numberBetween(0, 9999999),
            'owed' => $this->faker->numberBetween(0, 999),
            'transportation' => $this->faker->numberBetween(0, 5000),
            'notes' => $this->faker->paragraph(1, true),
            'shipment_id' => Shipment::all()->random()->id,
            'client_id' => Client::all()->random()->id,
            'representative_id' => Representative::all()->random()->id,
        ];
    }
}
