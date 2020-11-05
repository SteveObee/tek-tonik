<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Mail\OrderPlaced;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
  public function index(Request $request)
  {
    return OrderResource::collection(Order::all());
  }

  public function store(Request $request)
  {
    try {
      $order = new Order;

      $order->user_id = $request->userId;
      $order->shipping_id = $request->shippingId;
      $order->billing_id = $request->billingId;
      $order->price_total = $request->total;

      $order->save();

      return response()->json([
        'success' => true,
        'orderId' => $order->id
      ]);
    } catch (Exception $e) {
      return response($e, 500);
    }
  }

  public function update(Order $order, Request $request)
  {
    try {
      if ($order->user_id == Auth::id()) {
        # Set order status code
        $order->ref_order_status_code_id = $request->status_code;

        # Save model
        $order->save();

        return response()->json([
          'success' => true
        ], 200);
      } else {
        return response()->json([
          'success' => false
        ], 401);
      }
    } catch (\Throwable $th) {
      return response($th, 500);
    }
  }

  public function placed(Request $request, $orderId)
  {
    try {
      $order = Order::findOrFail($orderId);

      Mail::to($request->user())->send(new OrderPlaced($order));

      return $request->user();
    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function destroy(Order $order)
  {
    try {
      # Delete Order items
      $order->deleteOrderItems();

      # Delete Order
      $order->delete();

      return response(null, 204);
    } catch (\Throwable $th) {
      return response($th, 500);
    }
  }

  public function stripeKey()
  {
    $stripeKey = env('STRIPE_KEY', false);

    return $stripeKey;
  }
}
