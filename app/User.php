<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, Notifiable;

  public function addresses()
  {
    return $this->belongsToMany('App\Address', 'customer_addresses', 'user_id', 'address_id')->using('App\CustomerAddress')->withPivot(['user_id', 'address_id', 'is_shipping', 'is_billing']);
  }

  public function deleteAddresses()
  {
    return $this->addresses()->delete();
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'created_at' => 'datetime:d-m-Y',
  ];
}
