<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'addresses';

  public function users()
  {
    return $this->belongsToMany('App\User', 'customer_addresses', 'address_id', 'user_id')->using('App\CustomerAddress')->withPivot(['address_id', 'user_id', 'ref_address_type_id']);
  }
}
