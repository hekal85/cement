<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'mobile' => $this->faker->phoneNumber(),
            'phone'  => $this->faker->phoneNumber(),
            'state_id'   => 23,
            'city_id'    => $this->faker->numberBetween(210, 219),
            'address'=> $this->faker->address,
            'email'  => $this->faker->unique()->safeEmail(),
            'cash'   => $this->faker->numberBetween(100, 9000),
            'notes'  => $this->faker->text(10),
        ];
    }
}
