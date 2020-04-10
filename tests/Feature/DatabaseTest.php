<?php

namespace Tests\Feature;

use AddressTypeSeeder;
use CustomerAddressSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
  use RefreshDatabase;

  public function testAddress()
  {
    $this->seed();

    $table = 'users';
    $data = [
      'id' => 10
    ];

    $this->assertDatabaseHas($table, $data);
  }
}
