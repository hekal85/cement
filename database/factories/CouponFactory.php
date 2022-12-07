<?php

namespace Database\Factories;

use App\Models\CementType;
use App\Models\Coupon;
use App\Models\Manufactory;
use App\Models\Shipment;
use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (isset(Transportation::all()->random()->id)) {
            return [
                'coupon' => $this->faker->numberBetween(1000000, 9999999),
                'value' => $this->faker->randomElement([10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
                'manufactory_id' => Manufactory::all()->random()->id,
                'transportation_id' => Transportation::all()->random()->id,
                'shipment_id' => Shipment::all()->random()->id,
                'cement_type_id' => CementType::all()->random()->id,
                'cost' => $this->faker->numberBetween(1000, 9999999),
                'used' => $this->faker->boolean,
                'packed' => $this->faker->boolean,
                'notes' => $this->faker->paragraph(2, true),
            ];
        }
    }
}
