<?php

namespace Database\Factories;

use App\Models\Itinerary;
use App\Models\Person;
use App\Models\Representative;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepresentativeFactory extends Factory
{

    protected $model = Representative::class;

    public function definition()
    {
        return [
            'id' => Person::factory()->create()->id,
        ];
    }
}
