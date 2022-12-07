<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\manufactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManufactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = manufactory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Company::factory()->create()->id,
        ];
    }
}
