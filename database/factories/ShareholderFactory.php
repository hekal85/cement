<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Shareholder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShareholderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shareholder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Person::factory()->create()->id,
        ];
    }
}
