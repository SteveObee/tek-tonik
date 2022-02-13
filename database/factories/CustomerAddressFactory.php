<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\CustomerAddress;
use App\User;
use App\Address;

class CustomerAddressFactory extends Factory 
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'address_id' => Address::factory()
        ];
    }    
}
