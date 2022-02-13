<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Address;

class AddressFactory extends Factory
{
    public function definition()
    {
        return [
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'county' => $this->faker->state,
            'postcode' => $this->faker->postcode
          ];
    }
}