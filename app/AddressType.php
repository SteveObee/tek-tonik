<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
  protected $table = 'ref_address_types';

  public function customerAddresses()
  {
    return $this->hasMany('App\CustomerAddress', 'ref_address_type_id');
  }
}
