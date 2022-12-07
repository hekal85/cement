<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Person;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expense_type_id' => ExpenseType::all()->random()->id,
            'person_id' => Person::all()->random()->id,
            'company_id' => Company::all()->random()->id,
            'paid'   => $this->faker->numberBetween(100, 9000),
            'notes'  => $this->faker->text(10),
        ];
    }
}
