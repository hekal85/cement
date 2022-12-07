<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ItineraryDetails;
use App\Models\Person;
use App\Models\Representative;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'id' => Person::factory()->create()->id,
            'representative_id'   => Representative::all()->random()->id,
            'itinerary_details_id' => ItineraryDetails::all()->random()->id,
        ];
    }
}
