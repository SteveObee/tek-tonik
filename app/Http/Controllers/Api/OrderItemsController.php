<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\OrderItem;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
  public function store(Request $request)
  {
    try {
      $orderItem = new OrderItem;

      $orderItem->order_id = $request->orderId;
      $orderItem->product_id = $request->productId;
      $orderItem->name = $request->name;
      $orderItem->price_then = $request->price;
      $orderItem->quantity = $request->quantity;
      $orderItem->description_then = $request->description;

      $orderItem->save();

      return response()->json([
        'success' => true
      ]);
    } catch (\Throwable $th) {
      return $th;
    }
  }
}
