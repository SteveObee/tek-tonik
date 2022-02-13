<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

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

        $steve = User::factory()->create([
            'name' => 'Steve',
            'email' => env('MASTER_EMAIL'),
            'email_verified_at' => now(),
            'password' => Hash::make(env('MASTER_PASSWORD')),
            'remember_token' => Str::random(10),
            'created_at' => $createdDate,
            'updated_at' => $createdDate
        ]);

        for ($i = 1; $i <= 9; $i++) {
            $steve->addresses()->attach($i);
        }

        $brad = User::factory()->create([
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
