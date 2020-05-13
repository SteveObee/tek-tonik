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
    return $this->belongsToMany('App\User', 'customer_addresses', 'address_id', 'user_id')->using('App\CustomerAddress')->withPivot(['address_id', 'user_id'])->withTimestamps();
  }

  public function userIdPresent($id)
  {
    return $this->users()->wherePivot('user_id', $id)->select('id');
  }

  public function findAddress($addressLine, $postcode)
  {
    return $this->where('address_line_1', $addressLine)
      ->where('postcode', $postcode)
      ->select('id', 'address_line_1', 'address_line_2', 'city', 'county', 'postcode');
  }

  protected $fillable = [
    'address_line_1', 'address_line_2', 'city', 'county', 'postcode'
  ];
}
