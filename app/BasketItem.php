<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
  protected $table = 'basket_items';

  public function product()
  {
    return $this->belongsTo('App\Product');
  }
}
