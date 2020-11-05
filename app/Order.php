<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = 'orders';

  public function orderItems()
  {
    return $this->hasMany('App\OrderItem');
  }

  public function deleteOrderItems()
  {
    return $this->orderItems()->delete();
  }

  public function shippingAddress()
  {
    return $this->belongsTo('App\Address', 'shipping_id');
  }

  public function status()
  {
    return $this->belongsTo('App\OrderStatusCode', 'ref_order_status_code_id')->select('description', 'id');
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  protected $casts = [
    'created_at' => 'datetime:Y-m-d',
  ];
}
