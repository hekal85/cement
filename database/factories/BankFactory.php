<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $banks = ['Ahly', 'Misr', 'Cairo', 'CIB', 'QNB'];
        return [
            'name' => $this->faker->randomElement($banks),
            'account' => $this->faker->numberBetween(1000000000, 9999999999),
            'balance' => $this->faker->numberBetween(100000, 100000000),
            'company_id' => Company::factory()->create()->id,
        ];
    }
}
