<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'name', 'price', 'description', 'weight', 'image', 'stock'
  ];

  public function options()
  {
    return $this->belongsToMany('App\Option', 'product_options');
  }

  public function optionValues()
  {
    return $this->belongsToMany('App\OptionValue', 'product_options');
  }
}
