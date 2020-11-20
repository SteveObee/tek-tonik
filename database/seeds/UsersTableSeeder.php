<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $createdDate = Carbon::now();

    $steve = factory(App\User::class)->create([
      'name' => 'Steve',
      'email' => 'stephenobee1@gmail.com',
      'email_verified_at' => now(),
      'password' => Hash::make('K7hMjjJSmVARsH7f'),
      'remember_token' => Str::random(10),
      'created_at' => $createdDate,
      'updated_at' => $createdDate
    ]);

    for ($i = 1; $i <= 9; $i++) {
      $steve->addresses()->attach($i);
    }

    $brad = factory(App\User::class)->create([
      'name' => 'Brad',
      'email' => 'brad@brad.com',
      'email_verified_at' => now(),
      'password' => Hash::make('12345678'),
      'remember_token' => Str::random(10),
      'created_at' => $createdDate,
      'updated_at' => $createdDate
    ]);
  }
}
