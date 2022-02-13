<?php

namespace Database\Factories;

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CategoryFactory extends Factory
{
  public function definition() {
    $dateNow = Carbon::now();

    return [
      'created_at' => $dateNow,
      'updated_at' => $dateNow
    ];
  }
}