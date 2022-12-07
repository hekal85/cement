<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Representative;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class ItineraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'day1' => $this->faker->dayOfWeek(),
            'representative_id' => Representative::all()->random()->id,
            'day2' => $this->faker->dayOfWeek(),
        ];
    }
}
