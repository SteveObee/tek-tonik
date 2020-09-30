<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Order;
use Illuminate\Http\Request;

class SpaController extends Controller
{
  public function index()
  {
    /* $order = Order::findOrFail(2);
    $order->address;
    $order->orderItems;
    $order->user; */
    return view('spa');
    // return view('emails.orders.placed', ['order' => $order]);
  }
}
