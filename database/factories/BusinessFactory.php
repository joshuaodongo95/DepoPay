<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'name' => $this->faker->company,
        'registration_number' => $this->faker->numerify('##########'),
        'address' => $this->faker->address,
        'phone' => $this->faker->phoneNumber,
        'email' => $this->faker->email,
        'website' => $this->faker->url,
    ];
    }
}
