<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerAddress extends Pivot
{
  protected $table = 'customer_addresses';
}
