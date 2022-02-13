<?php

namespace Database\Factories;

use App\Image;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
  public function definition()
  {
    return [
      'url' => 'https://source.unsplash.com/random/400x400',
      'sort_order' => 1
    ];
  }
}
