<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name(),
            'director'=> $this->faker->name(),
            'email'   => $this->faker->unique()->freeEmail,
            'mobile'  => $this->faker->e164PhoneNumber,
            'phone'   => $this->faker->e164PhoneNumber,
            'state_id'=> 23,
            'city_id' => $this->faker->numberBetween(210, 219),
            'address' => $this->faker->address,
            'cash'    => $this->faker->randomNumber(NULL, false),
            'notes'   => $this->faker->paragraph(2, true),
        ];
    }
}
