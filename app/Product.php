<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'name', 'price', 'description', 'weight', 'image', 'stock'
  ];

  public function brand()
  {
    return $this->belongsTo('App\Brand');
  }

  public function images()
  {
    return $this->hasMany('App\Image', 'product_id')->select('id', 'url', 'sort_order');
  }

  public function colors()
  {
    return $this->belongsToMany('App\OptionValue', 'product_options')->wherePivot('option_id', 1)->select('id', 'value');
  }

  public function options()
  {
    return $this->belongsToMany('App\Option', 'product_options')->select('id', 'name');
  }

  public function optionValues()
  {
    return $this->belongsToMany('App\OptionValue', 'product_options')->select('id', 'value');
  }

  protected $casts = [
    'created_at' => 'datetime:Y-m-d',
  ];
}
