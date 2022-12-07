<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Itinerary;
use App\Models\ItineraryDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItineraryDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'itinerary_id' => Itinerary::all()->random()->id,
            'city_id' => City::all()->random()->id,
        ];
    }
}
