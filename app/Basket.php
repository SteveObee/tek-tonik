<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
  protected $table = 'basket';

  public function basketItems()
  {
    return $this->hasMany('App\BasketItem');
  }

  public function basketOptions()
  {
    return $this->hasManyThrough('App\BasketItemOption', 'App\BasketItem', 'basket_id', 'basket_items_id');
  }
}
