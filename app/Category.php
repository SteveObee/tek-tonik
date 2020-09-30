<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';

  public function parent()
  {
    return $this->belongsTo('App\Category', 'category_id');
  }

  public function children()
  {
    return $this->hasMany('App\Category', 'category_id');
  }

  public function subCategories()
  {
    return $this->children()->with('subCategories')->where('id', '>', 1)->select('id', 'name', 'category_id');
  }

  public function recursiveCategoryIds()
  {
    return $this->children()->with('recursiveCategoryIds')->where('id', '>', 1)->select('id', 'category_id');
  }

  public function products()
  {
    return $this->hasMany('App\Product')->select('id', 'name', 'brand_id', 'model', 'price', 'thumbnail', 'stock');
  }
}
