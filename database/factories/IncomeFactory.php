<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\IncomeType;
use App\Models\PaymentType;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'income_type_id' => IncomeType::all()->random()->id,
            'person_id' => Person::all()->random()->id,
            'payment_type_id' => PaymentType::all()->random()->id,
            'bank_id' => Bank::all()->random()->id,
            'paid' => $this->faker->randomDigit(),
            'notes' => $this->faker->paragraph(1),
        ];
    }
}
