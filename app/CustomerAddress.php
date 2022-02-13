<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerAddress extends Pivot
{
  use HasFactory;

  protected $table = 'customer_addresses';
}
